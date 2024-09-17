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
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title text-primary">
                <i class="fas fa-bell mr-2"></i>Notifications
            </h3>
        </div>
        <div class="card-body">
            @if(isset($allNotifications) && is_array($allNotifications))
                <div class="row">
                    @foreach($allNotifications as $category => $notifications)
                        @if(($category !== 'leave_requests' || Auth::user()->hasRole(['Super Admin', 'Admin'])) &&
                            ($category !== 'job_applications' || Auth::user()->hasRole('HR Hiring')))
                            <div class="col-md-6 mb-4">
                                <div class="notification-item h-100 border rounded p-3">
                                    <h4 class="d-flex align-items-center mb-3">
                                        @if($category === 'birthdays')
                                            <i class="fas fa-birthday-cake text-warning mr-2"></i>
                                        @elseif($category === 'posts')
                                            <i class="fas fa-bullhorn text-info mr-2"></i>
                                        @elseif($category === 'holidays')
                                            <i class="fas fa-calendar-day text-success mr-2"></i>
                                        @elseif($category === 'leave_requests')
                                            <i class="fas fa-calendar-times text-danger mr-2"></i>
                                        @elseif($category === 'tasks')
                                            <i class="fas fa-tasks text-primary mr-2"></i>
                                        @elseif($category === 'job_applications')
                                            <i class="fas fa-file-alt text-secondary mr-2"></i>
                                        @endif
                                        {{ ucfirst(str_replace('_', ' ', $category)) }}
                                    </h4>
                                    @if(empty($notifications))
                                        <p class="text-muted">No available {{ str_replace('_', ' ', $category) }}.</p>
                                    @else
                                        <ul class="list-unstyled">
                                            @foreach($notifications as $notification)
                                                <li class="mb-2">
                                                    <span class="text-dark">{{ $notification['text'] }}</span>
                                                    <small class="text-muted d-block">{{ $notification['time'] }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if(Auth::user()->hasRole(['Super Admin', 'Admin']) ||
                                       (Auth::user()->hasRole('HR Hiring') && $category === 'job_applications') ||
                                       (Auth::user()->hasRole('Employee') && $category === 'tasks'))
                                        <div class="text-right mt-3">
                                            @if($category === 'birthdays')
                                                <a href="{{ route('employees.birthdays') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'leave_requests')
                                                <a href="{{ route('leaves.index') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'job_applications')
                                                <a href="{{ route('careers.all') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'tasks')
                                                <a href="{{ route('tasks.myTasks') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @else
                                                <a href="{{ route($category . '.index') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-muted">No notifications available.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
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
    }

    .card {
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #e3e6f0;
    }

    .notification-item {
        transition: all 0.3s ease;
    }

    .notification-item:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .notification-item h4 {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .notification-item ul li {
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 0.5rem;
    }

    .notification-item ul li:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .card-header h3 {
            font-size: 1.25rem;
        }
    }
</style>
@endpush
