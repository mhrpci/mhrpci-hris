@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Payrolls</h1>
    <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3">Generate New Payroll</a>
    <a href="{{ route('payrolls.generate-all') }}" class="btn btn-success mb-3">Generate All Payrolls</a>

    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Period</th>
                <th>Gross Salary</th>
                <th>Net Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr>
                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                <td>{{ $payroll->start_date->format('M d, Y') }} - {{ $payroll->end_date->format('M d, Y') }}</td>
                <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                <td>{{ number_format($payroll->net_salary, 2) }}</td>
                <td>
                    <a href="{{ route('payrolls.show', $payroll) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('payrolls.payslip', $payroll) }}" class="btn btn-sm btn-primary">Payslip</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $payrolls->links() }}
</div>
@endsection
