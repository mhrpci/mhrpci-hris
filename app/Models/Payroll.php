<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'gross_pay',
        'net_pay',
        'days_worked',
        'overtime_hours',
        'overtime_pay',
        'sss_id',
        'philhealth_id',
        'pagibig_id',
        'sss_loan_id',
        'pagibig_loan_id',
        'cash_advance_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function sssContribution(): BelongsTo
    {
        return $this->belongsTo(Sss::class);
    }

    public function philhealthContribution(): BelongsTo
    {
        return $this->belongsTo(Philhealth::class);
    }

    public function pagibigContribution(): BelongsTo
    {
        return $this->belongsTo(Pagibig::class);
    }

    public function sssLoanPayment(): BelongsTo
    {
        return $this->belongsTo(SssLoan::class, 'sss_loan_id');
    }

    public function pagibigLoanPayment(): BelongsTo
    {
        return $this->belongsTo(PagibigLoan::class, 'pagibig_loan_id');
    }

    public function cashAdvanceDeduction(): BelongsTo
    {
        return $this->belongsTo(CashAdvance::class, 'cash_advance_id');
    }

    public function calculatePayroll(Employee $employee, $startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $dailyRate = $employee->salary / 26;
        $totalPay = 0;
        $daysWorked = 0;
        $overtimeHours = 0;

        $attendanceRecords = $employee->attendance()
            ->whereBetween('date_attended', [$startDate, $endDate])
            ->get();

        foreach ($attendanceRecords as $attendance) {
            $hoursWorked = Carbon::parse($attendance->hours_worked)->diffInHours(Carbon::today());

            if ($hoursWorked >= 8) {
                $totalPay += $dailyRate;
                $daysWorked++;

                if ($hoursWorked > 8) {
                    $overtimeHours += $hoursWorked - 8;
                }
            } else {
                $totalPay += ($dailyRate / 8) * $hoursWorked;
            }
        }

        // Calculate overtime pay (assuming 1.25x regular rate)
        $overtimePay = ($dailyRate / 8) * 1.25 * $overtimeHours;

        // Get contributions and loans
        $sssContribution = $this->getLatestContribution($employee, Sss::class, $endDate);
        $philhealthContribution = $this->getLatestContribution($employee, Philhealth::class, $endDate);
        $pagibigContribution = $this->getLatestContribution($employee, Pagibig::class, $endDate);

        $sssLoanPayment = $this->getLatestLoan($employee, SssLoan::class, $endDate);
        $pagibigLoanPayment = $this->getLatestLoan($employee, PagibigLoan::class, $endDate);
        $cashAdvanceDeduction = $this->getLatestCashAdvance($employee, $endDate);

        $grossPay = $totalPay + $overtimePay;
        $totalDeductions = $sssContribution->amount + $philhealthContribution->amount + $pagibigContribution->amount +
                           $sssLoanPayment->amount + $pagibigLoanPayment->amount + $cashAdvanceDeduction->amount;
        $netPay = $grossPay - $totalDeductions;

        return [
            'employee_id' => $employee->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'gross_pay' => $grossPay,
            'net_pay' => $netPay,
            'days_worked' => $daysWorked,
            'overtime_hours' => $overtimeHours,
            'overtime_pay' => $overtimePay,
            'sss_id' => $sssContribution->id,
            'philhealth_id' => $philhealthContribution->id,
            'pagibig_id' => $pagibigContribution->id,
            'sss_loan_id' => $sssLoanPayment->id,
            'pagibig_loan_id' => $pagibigLoanPayment->id,
            'cash_advance_id' => $cashAdvanceDeduction->id,
        ];
    }

    private function getLatestContribution(Employee $employee, $contributionClass, $endDate)
    {
        return $contributionClass::where('employee_id', $employee->id)
            ->where('date', '<=', $endDate)
            ->latest('date')
            ->firstOrFail();
    }

    private function getLatestLoan(Employee $employee, $loanClass, $endDate)
    {
        return $loanClass::where('employee_id', $employee->id)
            ->where('date', '<=', $endDate)
            ->where('status', 'active')
            ->latest('date')
            ->firstOrFail();
    }

    private function getLatestCashAdvance(Employee $employee, $endDate)
    {
        return CashAdvance::where('employee_id', $employee->id)
            ->where('date', '<=', $endDate)
            ->where('status', 'unpaid')
            ->latest('date')
            ->firstOrFail();
    }

    public static function generatePayroll(Employee $employee, $startDate, $endDate)
    {
        $payroll = new self();
        $payrollData = $payroll->calculatePayroll($employee, $startDate, $endDate);
        return self::create($payrollData);
    }
}
