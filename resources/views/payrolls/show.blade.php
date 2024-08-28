@extends('adminlte::page')

@section('title', 'Payroll Details')

@section('content_header')
    <h1 class="m-0 text-dark">Payroll Details</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payroll Information</h3>
                    <div class="card-tools">
                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Employee:</strong> {{ $payroll->employee->first_name }}</p>
                            <p><strong>Start Date:</strong> {{ $payroll->start_date->format('M d, Y') }}</p>
                            <p><strong>End Date:</strong> {{ $payroll->end_date->format('M d, Y') }}</p>
                            <p><strong>Days Worked:</strong> {{ $payroll->days_worked }}</p>
                            <p><strong>Overtime Hours:</strong> {{ $payroll->overtime_hours }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Gross Pay:</strong> {{ number_format($payroll->gross_pay, 2) }}</p>
                            <p><strong>Net Pay:</strong> {{ number_format($payroll->net_pay, 2) }}</p>
                            <p><strong>Overtime Pay:</strong> {{ number_format($payroll->overtime_pay, 2) }}</p>
                        </div>
                    </div>
                    <hr>
                    <h4>Deductions</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>SSS Contribution:</strong> {{ number_format($payroll->sssContribution->amount, 2) }}</p>
                            <p><strong>PhilHealth Contribution:</strong> {{ number_format($payroll->philhealthContribution->amount, 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Pag-IBIG Contribution:</strong> {{ number_format($payroll->pagibigContribution->amount, 2) }}</p>
                            <p><strong>SSS Loan Payment:</strong> {{ number_format($payroll->sssLoanPayment->amount, 2) }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Pag-IBIG Loan Payment:</strong> {{ number_format($payroll->pagibigLoanPayment->amount, 2) }}</p>
                            <p><strong>Cash Advance Deduction:</strong> {{ number_format($payroll->cashAdvanceDeduction->amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
