<?php

namespace App\Services;

use App\Models\Payroll;
use App\Models\Attendance;
use App\Models\CashAdvance;
use App\Models\Pagibig;
use App\Models\PagibigLoan;
use App\Models\Philhealth;
use App\Models\Sss;
use App\Models\SssLoan;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayrollService
{
    public function calculatePayroll($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $this->calculateEmployeePayroll($employee, $startDate, $endDate);
        }
    }

    private function calculateEmployeePayroll(Employee $employee, Carbon $startDate, Carbon $endDate)
    {
        $baseSalary = $this->calculateBaseSalary($employee);
        $attendanceData = $this->calculateAttendanceData($employee, $startDate, $endDate, $baseSalary);
        $deductions = $this->calculateDeductions($employee, $startDate, $endDate);

        $netSalary = $attendanceData['earnedSalary'] + $attendanceData['overtimeSalary'] -
                     $attendanceData['lateDeduction'] - $attendanceData['undertimeDeduction'] -
                     $deductions['totalDeductions'];

        $this->savePayroll($employee, $startDate, $endDate, $attendanceData, $deductions, $netSalary);
    }

    private function calculateBaseSalary(Employee $employee)
    {
        return $employee->salary / 2 / 13; // Daily Salary
    }

    private function calculateAttendanceData(Employee $employee, Carbon $startDate, Carbon $endDate, $baseSalary)
    {
        $overtimeSalary = 0;
        $lateDeduction = 0;
        $undertimeDeduction = 0;
        $totalDaysPresent = 0;

        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date_attended', [$startDate, $endDate])
            ->get();

        foreach ($attendances as $attendance) {
            if ($attendance->remarks == Attendance::getRemarks()['PRESENT'] && $attendance->leave_payment_status == 'With Pay') {
                $totalDaysPresent++;
            }

            $lateMinutes = max(0, $attendance->late_minutes ?? 0);
            $undertimeMinutes = max(0, $attendance->undertime_minutes ?? 0);
            $overtimeHours = max(0, $attendance->overtime_hours ?? 0);

            $lateDeduction += $this->calculateLateDeduction($lateMinutes, $baseSalary);
            $undertimeDeduction += $this->calculateUndertimeDeduction($undertimeMinutes, $baseSalary);
            $overtimeSalary += $this->calculateOvertimeSalary($overtimeHours, $baseSalary);
        }

        $earnedSalary = $baseSalary * $totalDaysPresent;

        return [
            'earnedSalary' => $earnedSalary,
            'overtimeSalary' => $overtimeSalary,
            'lateDeduction' => $lateDeduction,
            'undertimeDeduction' => $undertimeDeduction,
        ];
    }

    private function calculateLateDeduction($lateMinutes, $baseSalary)
    {
        return ($baseSalary / 480) * $lateMinutes; // Assuming 8-hour workday (480 minutes)
    }

    private function calculateUndertimeDeduction($undertimeMinutes, $baseSalary)
    {
        return ($baseSalary / 480) * $undertimeMinutes; // Assuming 8-hour workday (480 minutes)
    }

    private function calculateOvertimeSalary($overtimeHours, $baseSalary)
    {
        return ($baseSalary / 8) * $overtimeHours * 1.25; // 25% overtime premium
    }

    private function calculateDeductions(Employee $employee, Carbon $startDate, Carbon $endDate)
    {
        $sssDeduction = Sss::where('employee_id', $employee->id)
            ->whereBetween('date', [$startDate, $endDate])->sum('sss_contribution');
        $pagibigDeduction = Pagibig::where('employee_id', $employee->id)
            ->whereBetween('date', [$startDate, $endDate])->sum('pagibig_contribution');
        $philhealthDeduction = Philhealth::where('employee_id', $employee->id)
            ->whereBetween('date', [$startDate, $endDate])->sum('philhealth_contribution');
        $pagibigLoanDeduction = PagibigLoan::where('employee_id', $employee->id)
            ->whereBetween('date_repayment', [$startDate, $endDate])->sum('pagibig_loan');
        $sssLoanDeduction = SssLoan::where('employee_id', $employee->id)
            ->whereBetween('date_repayment', [$startDate, $endDate])->sum('sss_loan');
        $cashAdvanceDeduction = CashAdvance::where('employee_id', $employee->id)
            ->whereBetween('date_repayment', [$startDate, $endDate])->sum('cash_advance');

        $totalDeductions = $sssDeduction + $pagibigDeduction + $philhealthDeduction +
                           $pagibigLoanDeduction + $sssLoanDeduction + $cashAdvanceDeduction;

        return [
            'sssDeduction' => $sssDeduction,
            'pagibigDeduction' => $pagibigDeduction,
            'philhealthDeduction' => $philhealthDeduction,
            'pagibigLoanDeduction' => $pagibigLoanDeduction,
            'sssLoanDeduction' => $sssLoanDeduction,
            'cashAdvanceDeduction' => $cashAdvanceDeduction,
            'totalDeductions' => $totalDeductions,
        ];
    }

    private function savePayroll(Employee $employee, Carbon $startDate, Carbon $endDate, array $attendanceData, array $deductions, $netSalary)
    {
        Payroll::updateOrCreate(
            ['employee_id' => $employee->id, 'start_date' => $startDate, 'end_date' => $endDate],
            [
                'base_salary' => $attendanceData['earnedSalary'],
                'overtime_salary' => $attendanceData['overtimeSalary'],
                'late_deduction' => $attendanceData['lateDeduction'],
                'undertime_deduction' => $attendanceData['undertimeDeduction'],
                'sss_deduction' => $deductions['sssDeduction'],
                'pagibig_deduction' => $deductions['pagibigDeduction'],
                'philhealth_deduction' => $deductions['philhealthDeduction'],
                'pagibig_loan_deduction' => $deductions['pagibigLoanDeduction'],
                'sss_loan_deduction' => $deductions['sssLoanDeduction'],
                'cash_advance_deduction' => $deductions['cashAdvanceDeduction'],
                'total_deductions' => $deductions['totalDeductions'],
                'net_salary' => $netSalary
            ]
        );
    }
}
