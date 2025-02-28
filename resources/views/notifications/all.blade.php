@extends('layouts.app')

@section('title', 'All Notifications')

@section('content_header')
    <h1>All Notifications</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @forelse($allNotifications as $date => $notifications)
                        <h5 class="text-muted mb-3">{{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</h5>
                        @foreach($notifications as $notification)
                            <div class="notification-item mb-4 p-3 border rounded {{ $notification['is_read'] ? 'bg-light' : 'bg-white' }}"
                                 data-notification-id="{{ $notification['data']['id'] ?? '' }}"
                                 data-notification-type="{{ $notification['type'] }}">
                                <div class="d-flex align-items-start">
                                    <div class="notification-icon mr-3">
                                        <i class="{{ $notification['icon'] }} fa-2x text-primary"></i>
                                    </div>
                                    <div class="notification-content flex-grow-1">
                                        <h5 class="notification-title mb-1">{{ $notification['title'] }}</h5>
                                        <p class="notification-text mb-2">{{ $notification['text'] }}</p>
                                        <div class="notification-details">
                                            @foreach($notification['details'] as $key => $value)
                                                <div class="row mb-1">
                                                    <div class="col-md-3 text-muted">{{ $key }}:</div>
                                                    <div class="col-md-9">{{ $value }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">{{ $notification['time_human'] }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No notifications found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .notification-item {
        transition: background-color 0.3s ease;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-icon {
        width: 40px;
        text-align: center;
    }

    .notification-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .notification-text {
        color: #6c757d;
    }

    .notification-details {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-top: 0.5rem;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Mark notification as read when clicked
        $('.notification-item').click(function() {
            const notificationId = $(this).data('notification-id');
            const notificationType = $(this).data('notification-type');
            
            if (notificationId && notificationType) {
                markNotificationAsRead(notificationId, notificationType);
            }
        });
    });
</script>
@stop