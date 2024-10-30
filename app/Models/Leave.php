<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Carbon\Carbon;

class Leave extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'employee_id',
        'date_from',
        'date_to',
        'type_id',
        'reason_to_leave',
        'approved_by',
        'status',
        'payment_status',
        'signature',
        'approved_by_signature',
        'validated_by_signature',
    ];

    protected $primaryKey = 'id'; // This is already the default, but just to be explicit

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getDiffhoursAttribute()
    {
        $dateFrom = Carbon::parse($this->date_from);
        $dateTo = Carbon::parse($this->date_to);
        $diffInMinutes = $dateFrom->diffInMinutes($dateTo); // Get difference in minutes

        // Calculate hours and minutes
        $hours = floor($diffInMinutes / 60);
        $minutes = $diffInMinutes % 60;

        return compact('hours', 'minutes');
    }

    public function updateLeaveType()
    {
        $employee = $this->employee;
        $diffHours = $this->diffhours;

        if ($this->status === 'approved') {
            $totalHours = $diffHours['hours'] + ($diffHours['minutes'] / 60); // Convert minutes to fraction of hours

            switch ($this->type->name) {
                case 'Sick Leave':
                    $employee->sick_leave -= $totalHours;
                    break;
                case 'Emergency Leave':
                    $employee->emergency_leave -= $totalHours;
                    break;
                case 'Vacation Leave':
                    $employee->vacation_leave -= $totalHours;
                    break;
                // Add cases for other leave types if needed
            }
            $employee->save();
        }
    }

    protected static function booted()
    {
        static::updated(function ($leave) {
            // Check if status is updated
            if ($leave->isDirty('status')) {
                $leave->updateLeaveType();
            }
        });
    }

    public function getLeavePaymentStatus()
    {
        $employmentStatus = $this->employee->employment_status;

        if ($employmentStatus === 'REGULAR') {
            return $this->payment_status === 'With Pay' ? 'With Pay' : 'Without Pay';
        } elseif ($employmentStatus === 'PROBATIONARY' || $employmentStatus === 'TRAINEE') {
            return $this->payment_status === 'Without Pay' ? 'Without Pay' : 'With Pay';
        }

        return null; // In case of unexpected status
    }

    public function getDiffdaysAttribute()
    {
        return Carbon::parse($this->date_from)->diffInDays(Carbon::parse($this->date_to)) + 1;
    }

}
