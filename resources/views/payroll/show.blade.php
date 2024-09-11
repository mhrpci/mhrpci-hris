@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 0.5s ease-out;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
</style>
@stop
@section('content')
<br>
<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-body p-0">
            <!-- Payslip Header -->
            <div class="row p-5 bg-light">
                <div class="col-md-4">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="img-fluid mb-3" style="max-height: 80px;">
                    <h4 class="text-uppercase text-muted">MHR Property Conglomerates, Inc.</h4>
                    <p class="mb-1">MHR Building: Jose L. Briones St., North Reclamation Area, Cebu City, Cebu, Philippines 6000</p>
                    <p class="mb-1">Phone: (032) 238-1887</p>
                    <p>Email: info@mhrpci.ph</p>
                </div>
                <div class="col-md-4 text-center">
                    <h1 class="text-uppercase text-primary mb-0">Payslip</h1>
                    <p class="mb-0">For the period</p>
                    <h5 class="mb-0">{{ $payroll->start_date }} - {{ $payroll->end_date }}</h5>
                </div>
                <div class="col-md-4 text-right">
                    <h5 class="mb-2">Employee Details</h5>
                    <p class="mb-1"><strong>ID #:</strong> {{ $payroll->employee->company_id }}</p>
                    <p class="mb-1"><strong>Name:</strong> {{ $payroll->employee->last_name }} {{ $payroll->employee->first_name }}, {{ $payroll->employee->middle_name ?? ' ' }} {{ $payroll->employee->suffix ?? ' ' }}</p>
                    <p class="mb-1"><strong>Department:</strong> {{ $payroll->employee->department->name }}</p>
                    <p><strong>Position:</strong> {{ $payroll->employee->position->name }}</p>
                </div>
            </div>

            <!-- Payslip Body -->
            <div class="row p-5">
                <div class="col-md-6">
                    <h5 class="text-uppercase text-primary mb-3">Earnings</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="text-right">₱{{ number_format($payroll->gross_salary, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Overtime Pay</td>
                            <td class="text-right">₱{{ number_format($payroll->overtime_pay, 2) }}</td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Total Earnings</td>
                            <td class="text-right">₱{{ number_format($payroll->gross_salary + $payroll->overtime_pay, 2) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="text-uppercase text-primary mb-3">Deductions</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        <tr>
                            <td>Late Deduction</td>
                            <td class="text-right">₱{{ number_format($payroll->late_deduction, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Undertime Deduction</td>
                            <td class="text-right">₱{{ number_format($payroll->undertime_deduction, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Absent Deduction</td>
                            <td class="text-right">₱{{ number_format($payroll->absent_deduction, 2) }}</td>
                        </tr>
                        <tr>
                            <td>SSS Contribution</td>
                            <td class="text-right">₱{{ number_format($payroll->sss_contribution, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Pag-IBIG Contribution</td>
                            <td class="text-right">₱{{ number_format($payroll->pagibig_contribution, 2) }}</td>
                        </tr>
                        <tr>
                            <td>PhilHealth Contribution</td>
                            <td class="text-right">₱{{ number_format($payroll->philhealth_contribution, 2) }}</td>
                        </tr>
                        <tr>
                            <td>TIN Contribution</td>
                            <td class="text-right">₱{{ number_format($payroll->tin_contribution, 2) }}</td>
                        </tr>
                        <tr>
                            <td>SSS Loan</td>
                            <td class="text-right">₱{{ number_format($payroll->sss_loan, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Pag-IBIG Loan</td>
                            <td class="text-right">₱{{ number_format($payroll->pagibig_loan, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Cash Advance</td>
                            <td class="text-right">₱{{ number_format($payroll->cash_advance, 2) }}</td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Total Deductions</td>
                            <td class="text-right">₱{{ number_format(
                                $payroll->late_deduction + $payroll->undertime_deduction + $payroll->absent_deduction +
                                $payroll->sss_contribution + $payroll->pagibig_contribution + $payroll->philhealth_contribution +
                                $payroll->tin_contribution + $payroll->sss_loan + $payroll->pagibig_loan + $payroll->cash_advance, 2) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Net Pay -->
            <div class="row p-5 bg-light">
                <div class="col-md-6">
                    <h5 class="text-uppercase">Net Pay</h5>
                    <h1 class="text-primary">₱{{ number_format($payroll->net_salary, 2) }}</h1>
                </div>
                <div class="col-md-6 text-right">
                    @php
                    $endDate = \Carbon\Carbon::parse($payroll->end_date);
                    $payoutDate = null;

                    if ($endDate->day <= 10) {
                        // Payout on the 15th of the same month
                        $payoutDate = $endDate->copy()->day(15);
                    } else {
                        // Payout at the end of the month (30th or 31st depending on the month)
                        $payoutDate = $endDate->copy()->lastOfMonth();
                    }
                @endphp

                    <p class="mb-1"><strong>Pay Date:</strong> {{ $payoutDate->format('F d, Y') }}</p>
                    <p><strong>Payment Method:</strong> Direct Deposit</p>
                </div>
            </div>
        </div>

        <!-- Payslip Footer -->
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <button onclick="window.print()" class="btn btn-outline-primary">
                    <i class="fas fa-print mr-2"></i>Print Payslip
                </button>
                <a href="{{ route('payroll.download-pdf', $payroll->id) }}" class="btn btn-primary">
                    <i class="fas fa-download mr-2"></i>Download PDF
                </a>
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('HR ComBen'))
                <a href="{{ route('payroll.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Payroll List
                </a>
                @else
                <button onclick="showLoaderAndGoBack()" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .card-footer, .main-header, .main-sidebar { display: none !important; }
        .content-wrapper { margin-left: 0 !important; }
        .card { border: none !important; }
    }
    .table td, .table th { padding: 0.5rem; }
</style>

<script>
function showLoaderAndGoBack() {
    document.getElementById('loader').style.display = 'flex';
    setTimeout(() => {
        history.back();
    }, 500); // Adjust the delay as needed
}
</script>

@endsection
