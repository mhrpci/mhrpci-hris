@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Apply for SSS Loan</h2>
    <form action="{{ route('loan_sss.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="" selected disabled>Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="loan_amount">Loan Amount (PHP)</label>
            <input type="number" name="loan_amount" id="loan_amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="repayment_term">Repayment Term (Months)</label>
            <input type="number" name="repayment_term" id="repayment_term" class="form-control" min="1" max="24" required>
        </div>

        <button type="submit" class="btn btn-primary">Apply Loan</button>
    </form>
</div>
@endsection
