@extends('layouts.app')

@section('styles')
<style>
    /* Dashboard Cards */
    .stat-card {
        border-left: 4px solid;
        box-shadow: 0 0.15rem 1.75rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15);
    }

    /* Charts */
    .chart-container {
        height: 300px;
        position: relative;
    }

    /* Cards for Events */
    .event-card {
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
        border: 1px solid rgba(0,0,0,.125);
        transition: all 0.2s ease;
    }
    .event-card:hover {
        background: #f8f9fa;
        border-color: #4e73df;
    }

    /* Loading Overlay */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
</style>
@endsection

@section('navbar-content')
<div class="d-flex align-items-center">
    @if($greeting)
        <div class="alert alert-info py-2 px-3 mb-0 me-3 fade-in">
            <i class="fas fa-birthday-cake me-2"></i>{{ $greeting }}
        </div>
    @endif
    <div class="text-light">
        {{ Carbon\Carbon::now()->format('l, F j, Y') }}
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Stats Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card stat-card h-100" style="border-left-color: #4e73df;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Employees
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $employeeCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card h-100" style="border-left-color: #1cc88a;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Today's Attendance
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $attendanceCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card h-100" style="border-left-color: #36b9cc;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Open Positions
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $careerCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card h-100" style="border-left-color: #f6c23e;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Leaves
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $pendingLeavesCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i>Leave Distribution
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#" onclick="refreshChart('leaveChart')">
                                <i class="fas fa-sync-alt me-2"></i>Refresh
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body position-relative">
                    <div class="chart-container">
                        <canvas id="leaveChart"></canvas>
                        <div class="loading-overlay d-none">
                            <div class="spinner-border text-primary"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ... similar enhancements for other charts ... -->
    </div>

    <!-- Events and Announcements -->
    <div class="row g-3">
        <!-- Today's Posts -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bullhorn me-2"></i>Today's Announcements
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($todayPosts as $post)
                            <div class="list-group-item px-0">
                                <h6 class="mb-1">{{ $post->title }}</h6>
                                <p class="text-muted small mb-0">{{ Str::limit($post->content, 100) }}</p>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3">
                                <i class="fas fa-info-circle mb-2"></i>
                                <p class="mb-0">No announcements for today</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- ... similar enhancements for holidays and birthdays sections ... -->
    </div>
</div>
@endsection

@section('scripts')
<script>
// Enhanced chart configurations
const chartConfigs = {
    leave: {
        type: 'pie',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [{{ $pendingLeavesCount }}, {{ $approvedLeavesCount }}, {{ $rejectedLeavesCount }}],
                backgroundColor: ['#f6c23e', '#1cc88a', '#e74a3b'],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    },
    // ... similar configurations for other charts ...
};

// Initialize charts with loading states
const charts = {};
Object.entries(chartConfigs).forEach(([key, config]) => {
    const ctx = document.getElementById(`${key}Chart`).getContext('2d');
    charts[key] = new Chart(ctx, config);
});

// Refresh chart function
function refreshChart(chartId) {
    const loadingOverlay = document.querySelector(`#${chartId}`).closest('.chart-container').querySelector('.loading-overlay');
    loadingOverlay.classList.remove('d-none');

    // Simulate API call
    setTimeout(() => {
        loadingOverlay.classList.add('d-none');
    }, 1000);
}

// Initialize tooltips
const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>
@endsection
