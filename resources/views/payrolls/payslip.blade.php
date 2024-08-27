@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Payslip</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</h5>
            <p>Period: {{ $payroll->start_date->format('M d, Y') }} - {{ $payroll->end_date->format('M d, Y') }}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Earnings</th>
                        <th>Amount</th>
                        <th>Deductions</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic Salary</td>
                        <td>{{ number_format($payroll->basic_salary, 2) }}</td>
                        <td>SSS Contribution</td>
                        <td>{{ number_format($payroll->sss_contribution, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Overtime Pay</td>
                        <td>{{ number_format($payroll->overtime_pay, 2) }}</td>
                        <td>Pag-IBIG Contribution</td>
                        <td>{{ number_format($payroll->pagibig_contribution, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>PhilHealth Contribution</td>
                        <td>{{ number_format($payroll->philhealth_contribution, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>SSS Loan</td>
                        <td>{{ number_format($payroll->sss_loan_deduction, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Pag-IBIG Loan</td>
                        <td>{{ number_format($payroll->pagibig_loan_deduction, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Cash Advance</td>
                        <td>{{ number_format($payroll->cash_advance_deduction, 2) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Attendance Deduction</td>
                        <td>{{ number_format($payroll->attendance_deduction, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Gross Pay</th>
                        <th>{{ number_format($payroll->gross_salary, 2) }}</th>
                        <th>Total Deductions</th>
                        <th>{{ number_format($payroll->total_deductions, 2) }}</th>
                    </tr>
                    <tr>
                        <th colspan="3">Net Pay</th>
                        <th>{{ number_format($payroll->net_salary, 2) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <button onclick="window.print()" class="btn btn-primary mt-3">Print Payslip</button>
</div>

<style>
@media print {
    .container {
        width: 100%;
        margin: 0;
        padding: 0;
    }
    .card {
        border: none;
        box-shadow: none;
    }
    .btn {
        display: none;
    }
}
</style>
@endsection
