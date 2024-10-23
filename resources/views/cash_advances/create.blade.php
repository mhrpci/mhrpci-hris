@extends('layouts.app')

@section('content')
<br>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <i class="fas fa-info-circle fa-2x mr-3"></i>
        <div>
            <h5 class="alert-heading mb-1">Important Notice</h5>
            <p class="mb-0">Eligibility for cash advances is restricted to employees with a minimum of one year of service.</p>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Apply for Cash Advance</h3>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cash_advances.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee <span class="text-danger">*</span></label>
                                    <select name="employee_id" id="employee_id" class="form-control select2 @error('employee_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name ?? '' }} {{ $employee->suffix ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cash_advance_amount">Cash Advance Amount (PHP) <span class="text-danger">*</span></label>
                                    <input type="number" name="cash_advance_amount" id="cash_advance_amount" class="form-control @error('cash_advance_amount') is-invalid @enderror" required>
                                    @error('cash_advance_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="repayment_term">Repayment Term (Months) <span class="text-danger">*</span></label>
                                    <input type="number" name="repayment_term" id="repayment_term" class="form-control @error('repayment_term') is-invalid @enderror" min="1" max="24" required>
                                    @error('repayment_term')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monthly_repayment">Estimated Monthly Repayment (PHP)</label>
                                    <input type="text" id="monthly_repayment" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><small><span class="text-danger">*</span> Required fields</small></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group" role="group" aria-label="Button group">
                                    <button type="submit" class="btn btn-primary">Submit Application</button>&nbsp;&nbsp;
                                    <a href="{{ route('cash_advances.index') }}" class="btn btn-info">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('select').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            // Calculate monthly repayment
            function calculateMonthlyRepayment() {
                const amount = parseFloat($('#cash_advance_amount').val()) || 0;
                const term = parseInt($('#repayment_term').val()) || 1;
                const monthlyRepayment = amount / term;
                $('#monthly_repayment').val(monthlyRepayment.toFixed(2));
            }

            // Attach event listeners
            $('#cash_advance_amount, #repayment_term').on('input', calculateMonthlyRepayment);

            // Initial calculation
            calculateMonthlyRepayment();
        });
    </script>
@stop
