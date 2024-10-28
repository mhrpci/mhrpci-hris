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
                    <h3 class="card-title">Apply for Company Loan</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
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

                    @if ($employees->isEmpty())
                        <div class="ineligible-message text-center py-5">
                            <div class="marker-icon mb-4">
                                <div class="icon-wrapper">
                                    <div class="marker"></div>
                                    <div class="paper"></div>
                                    <div class="signature"></div>
                                </div>
                            </div>
                            <h2 class="mb-3" style="font-size: 1.75rem; font-weight: 600;">
                                Thank you for your interest<br>
                                in Company Loan!
                            </h2>
                            <p class="text-muted mb-5" style="font-size: 1.1rem;">
                                You are currently not eligible for Company Loan.<br>
                                Keep working and we'll let you know when you can apply again.
                            </p>
                        </div>
                    @else
                        <form action="{{ route('cash_advances.store') }}" method="POST" id="cashAdvanceForm">
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
                                        <label for="cash_advance_amount">Amount (PHP) <span class="text-danger">*</span></label>
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
                                        @if(auth()->user()->hasRole('Employee'))
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agreementModal">Submit Application</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Submit Application</button>
                                        @endif
                                        &nbsp;&nbsp;
                                        @if(!auth()->user()->hasRole('Employee'))
                                        <a href="{{ route('cash_advances.index') }}" class="btn btn-info">Back</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="signature" id="signature">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <style>
        .terms-list {
            padding-left: 20px;
        }

        .terms-list li {
            margin-bottom: 15px;
        }

        .terms-list ul {
            padding-left: 20px;
            margin-top: 5px;
        }

        .terms-list ul li {
            margin-bottom: 5px;
            list-style-type: disc;
        }

        .agreement-content {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .signature-container {
            background-color: #fff;
            position: relative;
            width: 100%;
            min-height: 200px;
        }

        #signaturePad {
            position: absolute;
            left: 0;
            top: 0;
            touch-action: none;
            width: 100%;
            height: 100%;
        }

        .signature-container::after {
            content: '';
            position: absolute;
            bottom: 50px;
            left: 20px;
            right: 20px;
            border-bottom: 1px dashed #ccc;
        }

        .ineligible-message {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }

        .icon-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .marker {
            position: absolute;
            top: 20%;
            left: 15%;
            width: 30px;
            height: 80px;
            background: #6c63ff;
            border-radius: 4px;
            transform: rotate(-45deg);
        }

        .marker::after {
            content: '';
            position: absolute;
            top: -8px;
            left: 0;
            width: 30px;
            height: 16px;
            background: #5753d0;
            border-radius: 4px;
        }

        .paper {
            position: absolute;
            top: 30%;
            left: 35%;
            width: 60px;
            height: 70px;
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            transform: rotate(15deg);
        }

        .signature {
            position: absolute;
            top: 50%;
            left: 40%;
            width: 40px;
            height: 2px;
            background: #6c63ff;
            transform: rotate(15deg);
        }

        .signature::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 5px;
            width: 30px;
            height: 2px;
            background: #6c63ff;
        }

        .signature::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 10px;
            width: 20px;
            height: 2px;
            background: #6c63ff;
        }

        @media (max-width: 768px) {
            .ineligible-message {
                padding: 1rem;
            }

            .ineligible-message h2 {
                font-size: 1.5rem !important;
            }

            .ineligible-message p {
                font-size: 1rem !important;
            }

            .icon-wrapper {
                width: 100px;
                height: 100px;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            // Initialize signature pad
            let signaturePad = null;

            function initSignaturePad() {
                const canvas = document.querySelector('#signaturePad');
                if (!canvas) return;

                // Set canvas dimensions
                const containerWidth = canvas.parentElement.clientWidth;
                canvas.width = containerWidth - 40;
                canvas.height = 200;

                // Initialize signature pad
                signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgb(255, 255, 255)'
                });
            }

            // Calculate monthly repayment
            function calculateMonthlyRepayment() {
                const amount = parseFloat($('#cash_advance_amount').val()) || 0;
                const term = parseInt($('#repayment_term').val()) || 1;
                const monthlyRepayment = amount / term;
                $('#monthly_repayment').val(monthlyRepayment.toFixed(2));
            }

            // Attach event listeners for calculation
            $('#cash_advance_amount, #repayment_term').on('input', calculateMonthlyRepayment);

            // Initialize calculation
            calculateMonthlyRepayment();

            // Modal events
            $('#agreementModal').on('shown.bs.modal', function() {
                initSignaturePad();
            });

            // Clear signature
            $('#clearSignature').click(function(e) {
                e.preventDefault();
                if (signaturePad) {
                    signaturePad.clear();
                }
            });

            // Handle form submission
            $('#confirmSubmit').click(function(e) {
                e.preventDefault();

                if (!$('#agreementCheckbox').is(':checked')) {
                    alert('Please accept the terms and conditions.');
                    return;
                }

                if (signaturePad && signaturePad.isEmpty()) {
                    alert('Please provide your signature before submitting.');
                    return;
                }

                // Get signature data
                if (signaturePad) {
                    const signatureData = signaturePad.toDataURL('image/png');
                    $('#signature').val(signatureData);
                }

                // Submit the form
                $('#cashAdvanceForm').submit();
            });

            // Agreement checkbox
            $('#agreementCheckbox').change(function() {
                $('#confirmSubmit').prop('disabled', !$(this).is(':checked'));
            });

            // Update modal content
            $('#agreementModal').on('show.bs.modal', function(e) {
                if (!$('#cashAdvanceForm')[0].checkValidity()) {
                    e.preventDefault();
                    $('#cashAdvanceForm')[0].reportValidity();
                    return;
                }

                const selectedOption = $('#employee_id option:selected');
                const employeeName = selectedOption.text();
                // Extract company_id from the option text (it's the first part before the name)
                const companyId = selectedOption.text().split(' ')[0];
                const amount = parseFloat($('#cash_advance_amount').val()) || 0;
                const term = parseInt($('#repayment_term').val()) || 1;
                const monthlyRepayment = amount / term;
                const totalRepayment = amount;

                // Generate reference number
                const date = new Date();
                const dateString = date.getFullYear() +
                    String(date.getMonth() + 1).padStart(2, '0') +
                    String(date.getDate()).padStart(2, '0');
                const randomNum = String(Math.floor(Math.random() * 9999) + 1).padStart(4, '0');
                const referenceNumber = `CA-${dateString}-${randomNum}`;

                $('#modal-employee-name, #modal-employee-name-confirm').text(employeeName);
                $('#modal-employee-id').text(companyId);  // Use company_id instead of employee ID
                $('#modal-advance-amount').text(amount.toFixed(2));
                $('#modal-repayment-term, #modal-term-text').text(term);
                $('#modal-monthly-repayment, #modal-payment-text').text(monthlyRepayment.toFixed(2));
                $('#modal-total-repayment, #modal-total-text').text(totalRepayment.toFixed(2));

                $('#modal-reference-number').text(referenceNumber);

                // Add hidden input for reference number
                if (!$('#reference_number').length) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'reference_number',
                        name: 'reference_number',
                        value: referenceNumber
                    }).appendTo('#cashAdvanceForm');
                } else {
                    $('#reference_number').val(referenceNumber);
                }

                $('#agreementCheckbox').prop('checked', false);
                $('#confirmSubmit').prop('disabled', true);
            });
        });
    </script>
@stop

<!-- Agreement Modal -->
<div class="modal fade" id="agreementModal" tabindex="-1" role="dialog" aria-labelledby="agreementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="agreementModalLabel">
                    <i class="fas fa-file-contract mr-2"></i>
                    {{ config('app.company_name') }} Company Loan Agreement
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Reference Number Section -->
                <div class="text-right mb-3">
                    <p class="mb-1"><strong>Reference Number:</strong> <span id="modal-reference-number">-</span></p>
                    <p class="mb-0"><strong>Date of Application:</strong> {{ now()->format('F d, Y') }}</p>
                </div>

                <!-- Loan Details Section -->
                <div class="loan-details mb-4">
                    <h6 class="font-weight-bold border-bottom pb-2 text-primary">
                        <i class="fas fa-info-circle mr-2"></i>Application Details
                    </h6>
                    <div class="card">
                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td><strong>Employee Name:</strong></td>
                                            <td><span id="modal-employee-name">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Employee ID:</strong></td>
                                            <td><span id="modal-employee-id">-</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Department:</strong></td>
                                            <td><span id="modal-department">-</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td><strong>Loan Amount:</strong></td>
                                            <td>₱<span id="modal-advance-amount">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Term Length:</strong></td>
                                            <td><span id="modal-repayment-term">0</span> months</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Monthly Payment:</strong></td>
                                            <td>₱<span id="modal-monthly-repayment">0.00</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agreement Content -->
                <div class="agreement-content">
                    <h6 class="font-weight-bold border-bottom pb-2 text-primary">
                        <i class="fas fa-file-alt mr-2"></i>Terms and Conditions
                    </h6>

                    <div class="card">
                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                            <p class="font-weight-bold">This Cash Advance Agreement (the "Agreement") is entered into on {{ now()->format('F d, Y') }} by and between:</p>

                            <div class="mb-4 pl-4">
                                <p><strong>Company:</strong><br>
                                {{ config('app.company_name') }}<br>
                                {{ config('app.company_address') }},{{ config('app.company_city') }}, {{ config('app.company_zip') }}</p>

                                <p><strong>Employee:</strong><br>
                                <span id="modal-employee-name">-</span><br>
                                Employee ID: <span id="modal-employee-id">-</span></p>
                            </div>

                            <h6 class="font-weight-bold">WHEREAS:</h6>
                            <div class="mb-4 pl-4">
                                <p>1. The Employee has requested a cash advance from the Company;</p>
                                <p>2. The Company has agreed to provide the cash advance subject to the terms and conditions set forth herein.</p>
                            </div>

                            <h6 class="font-weight-bold">NOW THEREFORE, the parties agree as follows:</h6>

                            <ol class="terms-list">
                                <li><strong>Loan Amount and Repayment:</strong>
                                    <ul>
                                        <li>Principal Amount: ₱<span id="modal-advance-amount">0.00</span></li>
                                        <li>Repayment Period: <span id="modal-term-text">0</span> months</li>
                                        <li>Monthly Installment: ₱<span id="modal-payment-text">0.00</span></li>
                                        <li>Total Repayment Amount: ₱<span id="modal-total-text">0.00</span></li>
                                    </ul>
                                </li>

                                <li><strong>Repayment Method:</strong>
                                    <ul>
                                        <li>Monthly installments will be automatically deducted from my salary</li>
                                        <li>Deductions will commence from the next salary payment after the cash advance is disbursed</li>
                                        <li>I authorize the company to make these regular deductions</li>
                                    </ul>
                                </li>

                                <li><strong>Early Repayment:</strong>
                                    <ul>
                                        <li>I may make early repayments without penalty</li>
                                        <li>Partial or full settlement of the remaining balance is permitted</li>
                                    </ul>
                                </li>

                                <li><strong>Default and Consequences:</strong>
                                    <ul>
                                        <li>Failure to maintain employment will result in immediate repayment of the remaining balance</li>
                                        <li>The company reserves the right to deduct the outstanding amount from final settlement, benefits, or incentives</li>
                                        <li>Legal action may be pursued for unpaid balances</li>
                                    </ul>
                                </li>

                                <li><strong>Declarations:</strong>
                                    <ul>
                                        <li>I confirm all information provided is true and accurate</li>
                                        <li>I am not under any other loan agreement that would affect my ability to repay</li>
                                        <li>I understand this cash advance is subject to management approval</li>
                                    </ul>
                                </li>
                            </ol>

                            <p class="mt-3"><strong>Note:</strong> This agreement is legally binding upon acceptance. Please read carefully before proceeding.</p>
                        </div>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="signature-section mt-4">
                    <h6 class="font-weight-bold border-bottom pb-2 text-primary">
                        <i class="fas fa-pen-alt mr-2"></i>Digital Signature
                    </h6>
                    <div class="card">
                        <div class="card-body">
                            <label class="font-weight-bold">Please sign below <span class="text-danger">*</span></label>
                            <div class="signature-container border rounded p-3">
                                <canvas id="signaturePad"></canvas>
                            </div>
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-secondary" id="clearSignature">
                                    <i class="fas fa-eraser"></i> Clear Signature
                                </button>
                                <small class="text-muted"><i class="fas fa-info-circle"></i> Use your mouse or touch screen to sign</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acknowledgment -->
                <div class="acknowledgment mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreementCheckbox">
                                <label class="form-check-label" for="agreementCheckbox">
                                    I, <span id="modal-employee-name-confirm">-</span>, hereby acknowledge that I have read,
                                    understood, and agree to be bound by the terms and conditions of this cash advance agreement.
                                    I confirm that all information provided is true and accurate to the best of my knowledge.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-primary" id="confirmSubmit" disabled>
                    <i class="fas fa-check mr-1"></i>Confirm and Submit
                </button>
            </div>
        </div>
    </div>
</div>

