<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OvertimePay extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'overtime_hours',
        'overtime_rate',
        'overtime_pay',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

/**
 * Calculate the overtime pay based on overtime hours and overtime rate.
 *
 * @return float
 */
public function calculateOvertimePay(): float
{
    // Retrieve the employee's salary based on the employee_id from the current instance
    $employee = Employee::find($this->employee_id);

    if (!$employee) {
        throw new \Exception('Employee not found');
    }

    $dailySalary = $employee->salary / 26; // Daily salary calculation
    $overtimePayRate = $dailySalary / 8; // Hourly rate

    // Calculate the overtime pay for this record
    $overtimePay = $overtimePayRate * $this->overtime_hours * $this->overtime_rate;

    // Update the overtime_pay field
    $this->overtime_pay = $overtimePay;
    $this->save();

    return $overtimePay;
}

/**
 * Get total overtime pay for a specific employee within a date range
 *
 * @param int $employeeId
 * @param string $startDate
 * @param string $endDate
 * @return float
 */
public static function getTotalOvertimePay(int $employeeId, string $startDate, string $endDate): float
{
    return self::where('employee_id', $employeeId)
        ->whereBetween('date', [$startDate, $endDate])
        ->get()
        ->sum(function ($record) {
            return $record->calculateOvertimePay();
        });
}

}