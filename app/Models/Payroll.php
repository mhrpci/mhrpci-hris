<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Carbon\Carbon;

class Payroll extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'basic_salary',
        'gross_salary',
        'net_salary',
        'sss_contribution',
        'pagibig_contribution',
        'philhealth_contribution',
        'sss_loan_deduction',
        'pagibig_loan_deduction',
        'cash_advance_deduction',
        'overtime_pay',
        'attendance_deduction',
        'total_deductions',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculatePayroll()
    {
        $this->calculateBasicSalary();
        $this->calculateContributions();
        $this->calculateLoanDeductions();
        $this->calculateAttendanceDeduction();
        $this->calculateOvertimePay();
        $this->calculateTotalDeductions();
        $this->calculateGrossAndNetSalary();
    }

    private function calculateBasicSalary()
    {
        $workDays = $this->getWorkDays();
        $daysInPeriod = Carbon::parse($this->end_date)->diffInDays(Carbon::parse($this->start_date)) + 1;
        $this->basic_salary = ($this->employee->salary / 30) * $workDays;
    }

    private function calculateContributions()
    {
        // Assuming you have a method or model to fetch the latest contribution rates
        $this->sss_contribution = $this->calculateSssContribution();
        $this->pagibig_contribution = $this->calculatePagibigContribution();
        $this->philhealth_contribution = $this->calculatePhilhealthContribution();
    }

    private function calculateLoanDeductions()
    {
        // Retrieve loan details from the database
        $latestSssLoan = $this->employee->sssLoan()->latest()->first();
        $latestPagibigLoan = $this->employee->pagibigLoan()->latest()->first();
        $latestCashAdvance = $this->employee->cashAdvance()->latest()->first();

        $this->sss_loan_deduction = $latestSssLoan ? $latestSssLoan->sss_loan : 0;
        $this->pagibig_loan_deduction = $latestPagibigLoan ? $latestPagibigLoan->pagibig_loan : 0;
        $this->cash_advance_deduction = $latestCashAdvance ? $latestCashAdvance->cash_advance : 0;
    }

    private function calculateAttendanceDeduction()
    {
        $deduction = 0;
        $attendances = $this->employee->attendance()
            ->whereBetween('date_attended', [$this->start_date, $this->end_date])
            ->get();

        foreach ($attendances as $attendance) {
            if (in_array($attendance->remarks, ['LATE', 'UNDERTIME'])) {
                $deduction += $this->calculateLateUndertimeDeduction($attendance);
            }
        }

        $this->attendance_deduction = $deduction;
    }

    private function calculateOvertimePay()
    {
        $overtimeHours = 0;
        $attendances = $this->employee->attendance()
            ->whereBetween('date_attended', [$this->start_date, $this->end_date])
            ->where('time_out', '>=', '18:00:00')
            ->get();

        foreach ($attendances as $attendance) {
            $overtimeHours += $this->calculateOvertimeHours($attendance);
        }

        $overtimeRate = ($this->employee->salary / 2 / 13 / 8) * 1.25;
        $this->overtime_pay = $overtimeHours * $overtimeRate;
    }

    private function calculateTotalDeductions()
    {
        $this->total_deductions =
            $this->sss_contribution +
            $this->pagibig_contribution +
            $this->philhealth_contribution +
            $this->sss_loan_deduction +
            $this->pagibig_loan_deduction +
            $this->cash_advance_deduction +
            $this->attendance_deduction;
    }

    private function calculateGrossAndNetSalary()
    {
        $this->gross_salary = $this->basic_salary + $this->overtime_pay;
        $this->net_salary = $this->gross_salary - $this->total_deductions;
    }

    private function getWorkDays()
    {
        return $this->employee->attendance()
            ->whereBetween('date_attended', [Carbon::parse($this->start_date), Carbon::parse($this->end_date)])
            ->whereIn('remarks', ['PRESENT', 'LATE', 'UNDERTIME', 'SATURDAY', 'HOLIDAY'])
            ->orWhere(function ($query) {
                $query->where('remarks', 'LEAVE')
                    ->where('leave_payment_status', 'With Pay');
            })
            ->count();
    }

    private function calculateSssContribution()
    {
        // Fetch SSS contribution rate from the database or configuration
        $sssRate = $this->fetchSssRate(); // Replace with actual method to get the rate
        return $this->basic_salary * $sssRate;
    }

    private function calculatePagibigContribution()
    {
        // Fetch Pag-IBIG contribution rate from the database or configuration
        $pagibigRate = $this->fetchPagibigRate(); // Replace with actual method to get the rate
        return min($this->basic_salary * $pagibigRate, 100); // Max of 100
    }

    private function calculatePhilhealthContribution()
    {
        // Fetch PhilHealth contribution rate from the database or configuration
        $philhealthRate = $this->fetchPhilhealthRate(); // Replace with actual method to get the rate
        return min($this->basic_salary * $philhealthRate, 1800); // Max of 1800
    }

    private function calculateLateUndertimeDeduction($attendance)
    {
        $hourlyRate = $this->employee->salary / 30 / 8;
        $hoursWorked = strtotime($attendance->hours_worked) - strtotime('00:00:00');
        $hoursWorked = $hoursWorked / 3600; // Convert to hours
        $deduction = (8 - $hoursWorked) * $hourlyRate;
        return max($deduction, 0);
    }

    private function calculateOvertimeHours($attendance)
    {
        $timeOut = strtotime($attendance->time_out);
        $overtimeStart = strtotime('18:00:00');
        $overtimeHours = ($timeOut - $overtimeStart) / 3600; // Convert to hours
        return max($overtimeHours, 0);
    }

    // Placeholder methods for fetching contribution rates
    private function fetchSssRate()
    {
        // Implement actual logic to fetch SSS rate from database or configuration
        return 0.0363; // Placeholder value
    }

    private function fetchPagibigRate()
    {
        // Implement actual logic to fetch Pag-IBIG rate from database or configuration
        return 0.02; // Placeholder value
    }

    private function fetchPhilhealthRate()
    {
        // Implement actual logic to fetch PhilHealth rate from database or configuration
        return 0.03; // Placeholder value
    }
}
