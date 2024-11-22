<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Leave extends Model
{
    use HasFactory;

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
        // First check if employee is REGULAR
        if ($this->employee->employment_status !== 'REGULAR') {
            return 'Without Pay';
        }

        // Get the total hours for this leave request
        $diffHours = $this->diffhours;
        $requestedHours = $diffHours['hours'] + ($diffHours['minutes'] / 60);

        // Check available leave balance based on leave type
        $availableHours = match ($this->type->name) {
            'Sick Leave' => $this->employee->sick_leave,
            'Vacation Leave' => $this->employee->vacation_leave,
            'Emergency Leave' => $this->employee->emergency_leave,
            default => 0
        };

        // If requested hours are within or equal to available balance
        return $requestedHours <= $availableHours ? 'With Pay' : 'Without Pay';
    }

    public function getDiffdaysAttribute()
    {
        return Carbon::parse($this->date_from)->diffInDays(Carbon::parse($this->date_to));
    }

}
