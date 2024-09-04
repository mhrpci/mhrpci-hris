@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Payroll</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('payroll.update', $payroll->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Select Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="" disabled>Select an Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $payroll->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $payroll->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $payroll->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Payroll</button>
    </form>
</div>
@endsection
