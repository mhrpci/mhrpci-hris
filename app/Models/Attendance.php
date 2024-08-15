<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory, Loggable;
    
    protected const REMARKS = [
        'SUNDAY' => 'Sunday',
        'SATURDAY' => 'Saturday',
        'HOLIDAY' => 'Holiday',
        'ON_LEAVE' => 'On Leave',
        'ABSENT' => 'Absent',
        'LATE' => 'Late',
        'UNDERTIME' => 'UnderTime',
        'OVERTIME' => 'Overtime',
        'PRESENT' => 'Present',
        'NO_CLOCK_OUT' => 'No Clock Out'
    ];

    public static function getRemarks()
    {
        return self::REMARKS;
    }

    protected $fillable = [
        'employee_id',
        'date_attended',
        'time_stamp1',
        'time_stamp2',
        'time_in',
        'time_out',
        'remarks',
        'hours_worked',
        'leave_payment_status',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function calculateRemarksAndHoursWorked()
    {
        $dateAttended = Carbon::parse($this->date_attended);
        $dayOfWeek = $dateAttended->dayOfWeek;
        $isHoliday = Holiday::whereDate('date', $dateAttended)->exists();
        $leave = Leave::where('employee_id', $this->employee_id)
                      ->whereDate('date_from', '<=', $dateAttended)
                      ->whereDate('date_to', '>=', $dateAttended)
                      ->where('status', 'approved')
                      ->first();

        // Check for Sunday
        if ($dayOfWeek == Carbon::SUNDAY) {
            $this->setNoWorkDay('Sunday');
            return;
        }

        if ($dayOfWeek == Carbon::SATURDAY) {
            $this->remarks = 'Saturday';
            $this->hours_worked = $this->getHoursWorkedAttribute();
            return;
        }

        if ($isHoliday) {
            $this->setHolidayAttendance();
            return;
        }

        if ($leave) {
            $this->setLeaveAttendance($leave);
            return;
        }

        // Regular work day
        $this->setRegularWorkDay();
    }

    private function setNoWorkDay($reason)
    {
        $this->time_in = null;
        $this->time_out = null;
        $this->remarks = $reason;
        $this->hours_worked = '00:00:00';
        $this->leave_payment_status = null;
    }

    private function setHolidayAttendance()
    {
        $this->time_in = '08:00:00';
        $this->time_out = '17:00:00';
        $this->remarks = 'Holiday';
        $this->hours_worked = '08:00:00';
        $this->leave_payment_status = 'With Pay';
    }

    private function setLeaveAttendance($leave)
    {
        $leavePaymentStatus = $leave->getLeavePaymentStatus();
        
        if ($leavePaymentStatus === 'With Pay') {
            $this->time_in = '08:00:00';
            $this->time_out = '17:00:00';
            $this->hours_worked = '08:00:00';
        } else {
            $this->time_in = null;
            $this->time_out = null;
            $this->hours_worked = '00:00:00';
        }
        
        $this->remarks = 'On Leave';
        $this->leave_payment_status = $leavePaymentStatus;
    }

    private function setRegularWorkDay()
    {
        $shiftStart = Carbon::parse('08:00:00');
        $shiftEnd = Carbon::parse('17:00:00');

        $timeIn = $this->time_in ? Carbon::parse($this->time_in) : null;
        $timeOut = $this->time_out ? Carbon::parse($this->time_out) : null;

        if (!$timeIn && !$timeOut) {
            $this->setNoWorkDay('Absent');
            return;
        }

        if ($timeIn && $timeIn->gt($shiftStart)) {
            $this->remarks = 'Late';
        } elseif ($timeOut && $timeOut->lt($shiftEnd)) {
            $this->remarks = 'UnderTime';
        } elseif ($this->isOvertime()) {
            $this->remarks = 'Overtime';
        } else {
            $this->remarks = 'Present';
        }

        if (!$timeOut) {
            $this->remarks = 'No Clock Out';
        }

        $this->hours_worked = $this->getHoursWorkedAttribute();
        $this->leave_payment_status = 'With Pay'; // Assuming regular work days are always with pay
    }

    public function isOvertime(): bool
    {
        $shiftEnd = Carbon::parse('18:00:00'); // 06:00 PM
        $timeOut = $this->time_out ? Carbon::parse($this->time_out) : null;

        return $timeOut && $timeOut->gte($shiftEnd);
    }

    public function getHoursWorkedAttribute(): string
    {
        if (is_null($this->time_in) || is_null($this->time_out)) {
            return '00:00:00';
        }

        $shiftStart = Carbon::parse('08:00:00');
        $timeIn = Carbon::parse($this->time_in);
        $timeOut = Carbon::parse($this->time_out);

        if ($timeIn->lt($shiftStart)) {
            $timeIn = $shiftStart;
        }

        if ($timeOut->greaterThanOrEqualTo(Carbon::createFromTime(13, 0))) {
            $timeOut = $timeOut->subHours(1);
        }

        $hoursWorked = $timeIn->diff($timeOut);

        return $hoursWorked->format('%H:%I:%S');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->calculateRemarksAndHoursWorked();
        });
    }
    private function calculateHoursWorked($timeIn, $timeOut)
{
    if ($timeIn && $timeOut) {
        $start = \Carbon\Carbon::createFromFormat('H:i', $timeIn);
        $end = \Carbon\Carbon::createFromFormat('H:i', $timeOut);
        return $end->diffInHours($start);
    }
    return null;
}

}