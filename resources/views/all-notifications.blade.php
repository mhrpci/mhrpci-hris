@extends('layouts.app')

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
                            ($category !== 'job_applications' || Auth::user()->hasRole(['HR Hiring', 'Super Admin'])) &&
                            ($category !== 'leave_status' || Auth::user()->hasRole(['Employee'])) &&
                            ($category !== 'cash_advances' || Auth::user()->hasRole(['Super Admin', 'Admin', 'Employee'])))
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
                                        @elseif($category === 'leave_status')
                                            <i class="fas fa-user-clock text-warning mr-2"></i>
                                        @elseif($category === 'cash_advances')
                                            <i class="fas fa-money-bill-wave text-success mr-2"></i>
                                        @endif
                                        {{ ucfirst(str_replace('_', ' ', $category)) }}
                                        @if(count($notifications) > 1)
                                            <span class="badge badge-pill badge-danger ml-2">{{ count($notifications) }}+</span>
                                        @endif
                                    </h4>
                                    @if(empty($notifications))
                                        <p class="text-muted">No available {{ str_replace('_', ' ', $category) }}.</p>
                                    @else
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <span class="text-dark">{{ $notifications[0]['text'] }}</span>
                                                <small class="text-muted d-block">{{ $notifications[0]['time'] }}</small>
                                                @if(isset($notifications[0]['details']))
                                                    <small class="text-muted d-block">{{ $notifications[0]['details'] }}</small>
                                                @endif
                                                @if($category === 'posts' && !Auth::user()->hasRole(['Super Admin', 'Admin']) && isset($notifications[0]['id']))
                                                    <a href="{{ route('posts.showById', $notifications[0]['id']) }}" class="btn btn-outline-info btn-sm mt-1">View Post</a>
                                                @endif
                                            </li>
                                        </ul>
                                    @endif
                                    @if(Auth::user()->hasRole(['Super Admin', 'Admin']) ||
                                       (Auth::user()->hasRole(['HR Hiring','Super Admin', 'Admin']) && $category === 'job_applications') ||
                                       (Auth::user()->hasRole('Employee') && $category === 'tasks') ||
                                       (Auth::user()->hasRole('Employee') && $category === 'leave_status'))
                                        <div class="text-right mt-3">
                                            @if($category === 'birthdays')
                                                <a href="{{ route('birthdays') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'leave_requests')
                                                <a href="{{ route('leaves.index') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'leave_status')
                                                <a href="{{ route('leaves.my_leave_sheet') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'job_applications')
                                                <a href="{{ route('careers.all') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'tasks')
                                                <a href="{{ route('tasks.myTasks') }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            @elseif($category === 'cash_advances')
                                                <a href="{{ route('cash_advances.index') }}" class="btn btn-outline-primary btn-sm">View Details</a>
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

    .badge-danger {
        background-color: #dc3545;
        color: white;
        font-size: 0.75rem;
    }

    .badge-pill {
        padding-right: 0.6em;
        padding-left: 0.6em;
        border-radius: 10rem;
    }
</style>
@endpush
