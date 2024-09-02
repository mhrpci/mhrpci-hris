@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Payroll Details</h2>

        <table class="table table-bordered">
            <tr>
                <th>Employee Name</th>
                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td>{{ $payroll->start_date }}</td>
            </tr>
            <tr>
                <th>End Date</th>
                <td>{{ $payroll->end_date }}</td>
            </tr>
            <tr>
                <th>Basic Salary</th>
                <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
            </tr>
            <tr>
                <th>Total Days Worked</th>
                <td>{{ $payroll->total_days_worked }}</td>
            </tr>
            <tr>
                <th>Attendance Pay</th>
                <td>₱{{ number_format($payroll->attendance_pay, 2) }}</td>
            </tr>
            <tr>
                <th>Overtime Pay</th>
                <td>₱{{ number_format($payroll->overtime_pay, 2) }}</td>
            </tr>
            <tr>
                <th>Total Deductions</th>
                <td>₱{{ number_format($payroll->total_deductions, 2) }}</td>
            </tr>
            <tr>
                <th>Net Salary</th>
                <td>₱{{ number_format($payroll->net_salary, 2) }}</td>
            </tr>
        </table>

        <a href="{{ route('payroll.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
