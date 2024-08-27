@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Payroll Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</h5>
            <p>Period: {{ $payroll->start_date->format('M d, Y') }} - {{ $payroll->end_date->format('M d, Y') }}</p>
            <p>Basic Salary: {{ number_format($payroll->basic_salary, 2) }}</p>
            <p>Gross Salary: {{ number_format($payroll->gross_salary, 2) }}</p>
            <p>Net Salary: {{ number_format($payroll->net_salary, 2) }}</p>
            <h6>Deductions:</h6>
            <ul>
                <li>SSS Contribution: {{ number_format($payroll->sss_contribution, 2) }}</li>
                <li>Pag-IBIG Contribution: {{ number_format($payroll->pagibig_contribution, 2) }}</li>
                <li>PhilHealth Contribution: {{ number_format($payroll->philhealth_contribution, 2) }}</li>
                <li>SSS Loan: {{ number_format($payroll->sss_loan_deduction, 2) }}</li>
                <li>Pag-IBIG Loan: {{ number_format($payroll->pagibig_loan_deduction, 2) }}</li>
                <li>Cash Advance: {{ number_format($payroll->cash_advance_deduction, 2) }}</li>
                <li>Attendance Deduction: {{ number_format($payroll->attendance_deduction, 2) }}</li>
            </ul>
            <p>Overtime Pay: {{ number_format($payroll->overtime_pay, 2) }}</p>
            <p>Total Deductions: {{ number_format($payroll->total_deductions, 2) }}</p>
        </div>
    </div>
    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('payrolls.payslip', $payroll) }}" class="btn btn-primary mt-3">Generate Payslip</a>
</div>
@endsection
