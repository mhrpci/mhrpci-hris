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
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">PHILHEALTH Contribution Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="employee-info mb-4">
                        <h4 class="text-primary">{{ $philhealth->employee->last_name }}, {{ $philhealth->employee->first_name }} {{ $philhealth->employee->middle_name ?? '' }} {{ $philhealth->employee->suffix ?? '' }}</h4>
                        <p class="text-muted">Employee ID: {{ $philhealth->employee->company_id }}</p>
                    </div>
                    <div class="contribution-details">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Contribution Date</span>
                                    <span class="detail-value">{{ $philhealth->contribution_date->format('F Y') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Employee Contribution</span>
                                    <span class="detail-value">₱{{ number_format($philhealth->employee_contribution, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Employer Contribution</span>
                                    <span class="detail-value">₱{{ number_format($philhealth->employer_contribution, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Total Contribution</span>
                                    <span class="detail-value font-weight-bold">₱{{ number_format($philhealth->total_contribution, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <img src="{{ asset('vendor/adminlte/dist/img/philhealth.png') }}" alt="philhealth Logo" class="img-fluid mt-4" style="opacity: 0.7;">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('philhealth.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header {
        border-bottom: none;
        padding: 1.5rem;
    }
    .card-body {
        padding: 2rem;
    }
    .employee-info h4 {
        margin-bottom: 0.5rem;
    }
    .detail-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        height: 100%;
    }
    .detail-label {
        display: block;
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }
    .detail-value {
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
    }
</style>
@endsection
