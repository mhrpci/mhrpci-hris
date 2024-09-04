@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Payroll Records</h1>

    <a href="{{ route('payroll.create') }}" class="btn btn-primary mb-3">Create Payroll</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Gross Salary</th>
                <th>Net Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr>
                <td>{{ $payroll->id }}</td>
                <td>{{ $payroll->employee->first_name }}</td>
                <td>{{ $payroll->start_date }}</td>
                <td>{{ $payroll->end_date }}</td>
                <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                <td>{{ number_format($payroll->net_salary, 2) }}</td>
                <td>
                    <a href="{{ route('payroll.show', ['id' => $payroll->id]) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
