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
        background-color: #8e44ad;
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
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">SSS Contribution Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="employee-info mb-4">
                        <h4 class="text-primary">{{ $sss->employee->last_name }}, {{ $sss->employee->first_name }} {{ $sss->employee->middle_name ?? '' }} {{ $sss->employee->suffix ?? '' }}</h4>
                        <p class="text-muted">Employee ID: {{ $sss->employee->company_id }}</p>
                    </div>
                    <div class="contribution-details">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Contribution Date</span>
                                    <span class="detail-value">{{ $sss->contribution_date->format('F j, Y') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Monthly Salary Credit</span>
                                    <span class="detail-value">₱{{ number_format($sss->monthly_salary_credit, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Employee Contribution</span>
                                    <span class="detail-value">₱{{ number_format($sss->employee_contribution, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Employer Contribution</span>
                                    <span class="detail-value">₱{{ number_format($sss->employer_contribution, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Total Contribution</span>
                                    <span class="detail-value font-weight-bold">₱{{ number_format($sss->total_contribution, 2) }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">EC Contribution</span>
                                    <span class="detail-value">₱{{ number_format($sss->ec_contribution, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <img src="{{ asset('vendor/adminlte/dist/img/sss.png') }}" alt="SSS Logo" class="img-fluid mt-4" style="opacity: 0.7;">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('sss.index') }}" class="btn btn-primary">
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
