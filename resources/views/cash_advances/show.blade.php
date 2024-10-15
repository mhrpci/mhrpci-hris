@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cash Advance Details</h1>
    <dl class="row">
        <dt class="col-sm-3">Employee</dt>
        <dd class="col-sm-9">{{ $cashAdvance->employee->name }}</dd>

        <dt class="col-sm-3">Amount</dt>
        <dd class="col-sm-9">{{ number_format($cashAdvance->cash_advance_amount, 2) }}</dd>

        <dt class="col-sm-3">Repayment Term</dt>
        <dd class="col-sm-9">{{ $cashAdvance->repayment_term }} months</dd>

        <dt class="col-sm-3">Monthly Amortization</dt>
        <dd class="col-sm-9">{{ number_format($cashAdvance->monthly_amortization, 2) }}</dd>

        <dt class="col-sm-3">Total Repayment</dt>
        <dd class="col-sm-9">{{ number_format($cashAdvance->total_repayment, 2) }}</dd>

        <dt class="col-sm-3">Status</dt>
        <dd class="col-sm-9">{{ ucfirst($cashAdvance->status) }}</dd>
    </dl>
    <a href="{{ route('cash_advances.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('cash_advances.edit', $cashAdvance) }}" class="btn btn-primary">Edit</a>
</div>
@endsection

