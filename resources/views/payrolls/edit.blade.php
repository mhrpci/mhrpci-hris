@extends('adminlte::page')

@section('title', 'Edit Payroll')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Payroll</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->first_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $payroll->start_date->format('Y-m-d') }}" required>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $payroll->end_date->format('Y-m-d') }}" required>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gross_pay">Gross Pay</label>
                            <input type="number" step="0.01" name="gross_pay" id="gross_pay" class="form-control @error('gross_pay') is-invalid @enderror" value="{{ $payroll->gross_pay }}" required>
                            @error('gross_pay')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="net_pay">Net Pay
