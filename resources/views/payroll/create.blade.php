@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Create Payroll</h1>

    <form action="{{ route('payroll.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee<span class="text-danger">*</span></label>
            <select id="employee_id" name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->company_id }}  {{ $employee->last_name }}  {{ $employee->first_name }}, {{ $employee->middle_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate Payroll</button>
    </form>
</div>
@endsection
