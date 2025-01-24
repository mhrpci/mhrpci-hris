@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i> Departmental User Activities</h5>
                </div>

                <div class="card-body p-4">
                    <div class="alert alert-info shadow-sm" role="alert">
                        <h4 class="alert-heading fw-bold"><i class="fas fa-info-circle me-2"></i> About This Feature</h4>
                        <p class="mb-0 text-justify">
                            This page displays activity logs for users within your department. As a Coordinator or Supervisor,
                            you can monitor and track actions performed by users who share the same department.
                        </p>
                    </div>

                    <div class="text-center py-4">
                        <div class="mb-4 position-relative">
                            <i class="fas fa-tools fa-4x text-primary opacity-75"></i>
                            <i class="fas fa-cog fa-3x text-secondary position-absolute processing-cog"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Feature Coming Soon!</h3>
                        <p class="lead text-justify">
                            We're working hard to bring you detailed activity tracking capabilities including:
                        </p>
                        <div class="row g-4 mt-2">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body p-4">
                                        <i class="fas fa-user-clock fa-2x text-primary mb-3"></i>
                                        <h5 class="fw-bold">Real-time Tracking</h5>
                                        <p class="text-muted mb-0 text-justify">Monitor user actions as they happen within your department</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body p-4">
                                        <i class="fas fa-filter fa-2x text-primary mb-3"></i>
                                        <h5 class="fw-bold">Advanced Filtering</h5>
                                        <p class="text-muted mb-0 text-justify">Filter logs by user, action type, and date range</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body p-4">
                                        <i class="fas fa-chart-line fa-2x text-primary mb-3"></i>
                                        <h5 class="fw-bold">Activity Analytics</h5>
                                        <p class="text-muted mb-0 text-justify">Gain insights through visual activity reports and trends</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    .card-header {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .processing-cog {
        bottom: -10px;
        right: -10px;
        animation: spin 4s linear infinite;
    }
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endpush 