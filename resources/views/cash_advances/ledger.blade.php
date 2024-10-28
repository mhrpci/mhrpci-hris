@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h2 text-primary mb-0">Cash Advance Ledger: {{ $cashAdvance->employee->last_name }} {{ $cashAdvance->employee->first_name }}, {{ $cashAdvance->employee->middle_name ?? ' ' }} {{ $cashAdvance->employee->suffix ?? ' ' }}</h1>
        </div>
        <div class="col-auto">
            @if(auth()->user()->hasRole('Employee'))
            <a href="{{ route('loans.my-loans') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left mr-2"></i>Back to My Loans
            </a>
            @else
            <a href="{{ route('cash_advances.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Cash Advances
            </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0"><i class="fas fa-info-circle mr-2"></i>Cash Advance Details</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-6 text-muted">Employee ID:</dt>
                        <dd class="col-sm-6">{{ $cashAdvance->employee->company_id }}</dd>
                        <dt class="col-sm-6 text-muted">Cash Advance Amount:</dt>
                        <dd class="col-sm-6">₱{{ number_format($cashAdvance->cash_advance_amount, 2) }}</dd>
                        <dt class="col-sm-6 text-muted">Repayment Term:</dt>
                        <dd class="col-sm-6">{{ $cashAdvance->repayment_term }} months</dd>
                        <dt class="col-sm-6 text-muted">Monthly Amortization:</dt>
                        <dd class="col-sm-6">₱{{ number_format($cashAdvance->monthly_amortization, 2) }}</dd>
                        <dt class="col-sm-6 text-muted">Total Repayment:</dt>
                        <dd class="col-sm-6">₱{{ number_format($cashAdvance->total_repayment, 2) }}</dd>
                        <dt class="col-sm-6 text-muted">Status:</dt>
                        <dd class="col-sm-6">{{ ucfirst($cashAdvance->status) }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h2 class="h5 mb-0"><i class="fas fa-chart-pie mr-2"></i>Repayment Summary</h2>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-6 text-muted">Total Paid:</dt>
                        <dd class="col-sm-6">₱{{ number_format($cashAdvance->payments->sum('amount'), 2) }}</dd>
                        <dt class="col-sm-6 text-muted">Remaining Balance:</dt>
                        <dd class="col-sm-6">₱{{ number_format($cashAdvance->remainingBalance(), 2) }}</dd>
                        <dt class="col-sm-6 text-muted">Repayment Progress:</dt>
                        <dd class="col-sm-6">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($cashAdvance->payments->sum('amount') / $cashAdvance->total_repayment) * 100 }}%"></div>
                            </div>
                            <small class="text-muted">{{ number_format(($cashAdvance->payments->sum('amount') / $cashAdvance->total_repayment) * 100, 1) }}% complete</small>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0"><i class="fas fa-history mr-2"></i>Payment History</h2>
                    <button class="btn btn-sm btn-outline-light" id="exportBtn">
                        <i class="fas fa-download mr-2"></i>Export to Excel
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="paymentsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Amount</th>
                                    <th>Running Balance</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $runningBalance = $cashAdvance->total_repayment; @endphp
                                @forelse ($cashAdvance->payments->sortBy('payment_date') as $payment)
                                    @php $runningBalance -= $payment->amount; @endphp
                                    <tr>
                                        <td>{{ $payment->payment_date instanceof \DateTime ? $payment->payment_date->format('F d, Y') : date('F d, Y', strtotime($payment->payment_date)) }}</td>
                                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                                        <td>₱{{ number_format($runningBalance, 2) }}</td>
                                        <td>{{ $payment->notes ?: 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <i class="fas fa-info-circle mr-2"></i>No payments recorded yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script>
    $(document).ready(function() {
        $('#exportBtn').on('click', function() {
            $('#paymentsTable').tableExport({
                formats: ['xlsx'],
                fileName: 'Cash_Advance_Ledger_{{ $cashAdvance->employee->name }}',
            });
        });
    });
</script>
@endpush
