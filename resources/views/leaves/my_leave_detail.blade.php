@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
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

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@stop

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0">My Leave Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Employee Information</h6>
                            <p><strong>Name:</strong> {{ $leave->employee->company_id }} {{ $leave->employee->last_name }} {{ $leave->employee->first_name }} {{ $leave->employee->middle_name ?? ' '}} {{ $leave->employee->suffix ?? ' ' }}</p>
                            <p><strong>Type:</strong> {{ $leave->leave_type }}</p>
                            <p><strong>Date Range:</strong> {{ \Carbon\Carbon::parse($leave->date_from)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($leave->date_to)->format('F d, Y') }}</p> <!-- Updated format -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Leave Status</h6>
                            <p><strong>Status:</strong> <span class="badge bg-{{ $leave->status == 'approved' ? 'success' : ($leave->status == 'pending' ? 'warning' : 'danger') }}">{{ $leave->status }}</span></p>
                            <p><strong>Approved By:</strong> {{ $leave->approvedByUser ? $leave->approvedByUser->first_name  : 'N/A' }} {{ $leave->approvedByUser ? $leave->approvedByUser->last_name  : 'N/A' }}</p>
                            <p><strong>Payment Status:</strong> <span class="badge bg-{{ $leave->payment_status == 'With Pay' ? 'success' : 'secondary' }}">{{ $leave->payment_status }}</span></p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="text-muted">Reason for Leave</h6>
                        <p>{{ $leave->reason_to_leave }}</p>
                    </div>
                    <div class="mt-4">
                        <h6 class="text-muted">Leave Type</h6>
                        <p>{{ $leave->type->name }}</p>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <small class="text-muted">Date Filed: {{ $leave->created_at->format('F d, Y h:i A') }}</small> <!-- Updated format -->
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">Last Updated: {{ $leave->updated_at->format('F d, Y h:i A') }}</small> <!-- Updated format -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-start mt-4"> <!-- Changed from text-center to text-start -->
                <a href="{{ route('leaves.my_leave_sheet') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Leave Sheet
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .container-fluid {
        max-width: 100%; /* Adjust this value as needed */
    }
    .card {
        transition: box-shadow 0.3s ease-in-out;
        width: 100%;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .badge {
        font-size: 0.875em;
    }
</style>
@endpush
