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
                                <div class="notification-item h-100 border rounded p-3 position-relative">
                                    <div class="hover-indicator"></div>
                                    <div class="notification-header d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="d-flex align-items-center mb-0">
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
                                            <span class="category-text">{{ ucfirst(str_replace('_', ' ', $category)) }}</span>
                                            @if(count($notifications) > 1)
                                                <span class="badge badge-pulse badge-danger ml-2">{{ count($notifications) }}+</span>
                                            @endif
                                        </h4>
                                    </div>
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
                                        @if(count($notifications) > 1)
                                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#{{ $category }}Modal">
                                                Show all {{ str_replace('_', ' ', $category) }}...
                                            </button>

                                            <div class="modal fade" id="{{ $category }}Modal" tabindex="-1" role="dialog" aria-labelledby="{{ $category }}ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-0">
                                                        <div class="modal-header bg-light">
                                                            <h5 class="modal-title d-flex align-items-center" id="{{ $category }}ModalLabel">
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
                                                                All {{ ucfirst(str_replace('_', ' ', $category)) }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="notification-list">
                                                                @foreach($notifications as $notification)
                                                                    <div class="notification-item-modal mb-3">
                                                                        <div class="notification-content">
                                                                            <p class="notification-text mb-1">{{ $notification['text'] }}</p>
                                                                            <div class="notification-meta">
                                                                                <small class="text-muted">
                                                                                    <i class="far fa-clock mr-1"></i>
                                                                                    {{ $notification['time'] }}
                                                                                </small>
                                                                                @if(isset($notification['details']))
                                                                                    <small class="text-muted d-block mt-1">
                                                                                        <i class="fas fa-info-circle mr-1"></i>
                                                                                        {{ $notification['details'] }}
                                                                                    </small>
                                                                                @endif
                                                                            </div>
                                                                            @if($category === 'posts' && !Auth::user()->hasRole(['Super Admin', 'Admin']) && isset($notification['id']))
                                                                                <a href="{{ route('posts.showById', $notification['id']) }}" class="btn btn-outline-info btn-sm mt-1">View Post</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
        overflow: hidden;
    }

    .notification-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
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

    .hover-indicator {
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 0;
        background: linear-gradient(to bottom, #007bff, #6610f2);
        transition: height 0.3s ease;
    }

    .notification-item:hover .hover-indicator {
        height: 100%;
    }

    .category-text {
        font-size: 1.1rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    .badge-pulse {
        animation: pulse 2s infinite;
    }

    .notification-item-modal {
        padding: 1rem;
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .notification-item-modal:hover {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .notification-content {
        padding-left: 1rem;
        border-left: 3px solid #007bff;
    }

    .notification-text {
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .notification-meta {
        font-size: 0.85rem;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .modal-header, .modal-footer {
        border: none;
    }

    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }

    .modal-body::-webkit-scrollbar {
        width: 6px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }

    @media (max-width: 768px) {
        .notification-item {
            margin-bottom: 1rem;
        }

        .modal-dialog {
            margin: 0.5rem;
        }
    }
</style>
@endpush
