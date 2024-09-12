<?php

namespace App\Services;

use App\Models\Contribution;
use App\Models\Loan;
use App\Models\Attendance;
use App\Models\OvertimePay;
use App\Models\Payroll;
use App\Models\Employee;
use Carbon\Carbon;

class PayrollService
{
    public function calculatePayroll($employee_id, $start_date, $end_date)
    {
        // Fetch employee data
    $employee = Employee::find($employee_id);
    if (!$employee) {
        return null; // Employee not found
    }

    // Initialize the start and end date
    $start = Carbon::parse($start_date);
    $end = Carbon::parse($end_date);

    // Check if start date is the 26th and the month has 31 days
    if ($start->day == 26 && $start->daysInMonth == 31) {
        // Adjust the end date by subtracting one day
        $end->subDay();
    }

    // Calculate Daily Salary
    $daily_salary = $employee->salary / 26;

    // Calculate Working Days Excluding Sundays
    $working_days = 0;
    $current_date = $start->copy();

    while ($current_date->lte($end)) {
        if (!$current_date->isSunday()) {
            $working_days++;
        }
        $current_date->addDay();
    }

    // Calculate Gross Salary (without Sunday Deduction)
    $gross_salary = $daily_salary * $working_days;

        // Fetch contributions and loans
        $contributions = Contribution::where('employee_id', $employee_id)
                    ->whereBetween('date', [$start, $end])
                    ->first();

        $loans = Loan::where('employee_id', $employee_id)
                    ->whereBetween('date', [$start, $end])
                    ->first();

        // Fetch attendance records within the date range
        $attendances = Attendance::where('employee_id', $employee_id)
                        ->whereBetween('date_attended', [$start, $end])
                        ->get();

        // Initialize deductions
        $total_deductions = 0;
        $absent_deduction = 0;
        $late_deduction = 0;
        $undertime_deduction = 0;
        $overtime_pay = 0;

        foreach ($attendances as $attendance) {
            $remarks = $attendance->remarks;

            // Calculate late and undertime deductions
            if ($remarks === 'Late') {
                $standard_start = Carbon::parse('08:00:00');
                $time_in = Carbon::parse($attendance->time_in);

                if ($time_in && $time_in->gt($standard_start)) {
                    $late_minutes = $time_in->diffInMinutes($standard_start);
                    $late_deduction += $late_minutes * 0.02;
                }
            }

            if ($remarks === 'Undertime') {
                $standard_end = Carbon::parse('17:00:00');
                $time_out = Carbon::parse($attendance->time_out);

                if ($time_out && $time_out->lt($standard_end)) {
                    $undertime_minutes = $standard_end->diffInMinutes($time_out);
                    $undertime_deduction += $undertime_minutes * 0.02;
                }
            }

            if ($remarks === 'Absent') {
                $absent_deduction += $daily_salary;
            }
        }

        // Check for dates with no attendance records
        $total_no_attendance_days = $this->calculateNoAttendanceDays($employee_id, $start_date, $end_date);
        $no_attendance_deduction = $total_no_attendance_days * $daily_salary;

        // Fetch Overtime Pay records and calculate total overtime pay
        $overtime_pay_records = OvertimePay::where('employee_id', $employee_id)
            ->whereBetween('date', [$start, $end])
            ->get();

        foreach ($overtime_pay_records as $record) {
            $overtime_pay += $record->calculateOvertimePay();
        }

        // Total deductions include absent, late, undertime deductions, and no attendance deductions
        $total_deductions = $absent_deduction + $late_deduction + $undertime_deduction + $no_attendance_deduction;

        // Deduct Contributions (if within payroll period)
        $contribution_deductions = 0;
        if ($contributions) {
            $contribution_deductions += $contributions->sss_contribution ?? 0;
            $contribution_deductions += $contributions->pagibig_contribution ?? 0;
            $contribution_deductions += $contributions->philhealth_contribution ?? 0;
            $contribution_deductions += $contributions->tin_contribution ?? 0;
        }

        // Deduct Loans (if within payroll period)
        $loan_deductions = 0;
        if ($loans) {
            $loan_deductions += $loans->sss_loan ?? 0;
            $loan_deductions += $loans->pagibig_loan ?? 0;
            $loan_deductions += $loans->cash_advance ?? 0;
        }

        // Calculate Net Salary
        $net_salary = $gross_salary - $total_deductions - $contribution_deductions - $loan_deductions + $overtime_pay;

        // Store payroll record
        $payroll = Payroll::create([
            'employee_id' => $employee_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'gross_salary' => $gross_salary,
            'net_salary' => $net_salary,
            'late_deduction' => $late_deduction,
            'undertime_deduction' => $undertime_deduction,
            'absent_deduction' => $absent_deduction,
            'no_attendance_deduction' => $no_attendance_deduction,
            'sss_contribution' => $contributions->sss_contribution ?? 0,
            'pagibig_contribution' => $contributions->pagibig_contribution ?? 0,
            'philhealth_contribution' => $contributions->philhealth_contribution ?? 0,
            'tin_contribution' => $contributions->tin_contribution ?? 0,
            'sss_loan' => $loans->sss_loan ?? 0,
            'pagibig_loan' => $loans->pagibig_loan ?? 0,
            'cash_advance' => $loans->cash_advance ?? 0,
            'overtime_pay' => $overtime_pay
        ]);

        return $payroll;
    }

    private function calculateNoAttendanceDays($employee_id, $start_date, $end_date)
    {
        // Initialize the start and end date
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);

        // Get all attendance dates within the range
        $attendance_dates = Attendance::where('employee_id', $employee_id)
            ->whereBetween('date_attended', [$start, $end])
            ->pluck('date_attended')
            ->toArray();

        $total_no_attendance_days = 0;
        $current_date = $start->copy();

        while ($current_date->lte($end)) {
            // If the current date is not a Sunday and there's no attendance record, count it as a no attendance day
            if (!$current_date->isSunday() && !in_array($current_date->toDateString(), $attendance_dates)) {
                $total_no_attendance_days++;
            }
            $current_date->addDay();
        }

        return $total_no_attendance_days;
    }
}
