@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Payroll List</h2>

        <a href="{{ route('payroll.create') }}" class="btn btn-primary mb-3">Generate Payroll</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Net Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $payroll)
                    <tr>
                        <td>{{ $payroll->id }}</td>
                        <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                        <td>{{ $payroll->start_date }}</td>
                        <td>{{ $payroll->end_date }}</td>
                        <td>₱{{ number_format($payroll->net_salary, 2) }}</td>
                        <td>
                            <a href="{{ route('payroll.show', $payroll->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
