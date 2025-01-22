@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-bell text-primary mr-2"></i>
                        Notifications
                    </h5>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" data-filter="all">All</a>
                                <a class="dropdown-item" href="#" data-filter="leave">Leave Requests</a>
                                @if(Auth::user()->hasRole(['Super Admin', 'Admin']))
                                    <a class="dropdown-item" href="#" data-filter="cash_advance">Cash Advances</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-filter="unread">Unread</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($allNotifications->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No notifications from the last 7 days</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($allNotifications as $date => $notifications)
                                <div class="list-group-item bg-light">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
                                    </small>
                                </div>
                                
                                @foreach($notifications as $notification)
                                    @if(isset($notification['time']))
                                    <div class="list-group-item notification-item border-0 {{ !$notification['is_read'] ? 'bg-light' : '' }}" 
                                         data-type="{{ $notification['type'] }}" 
                                         data-read="{{ $notification['is_read'] }}">
                                        <div class="d-flex">
                                            <div class="mr-3">
                                                <span class="notification-icon rounded-circle p-2 {{ $notification['type'] === 'leave' ? 'bg-warning' : 'bg-success' }}">
                                                    <i class="{{ $notification['icon'] }} text-white"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-1">{{ $notification['title'] }}</h6>
                                                    <small class="text-muted">{{ $notification['time_human'] }}</small>
                                                </div>
                                                <p class="mb-1">{{ $notification['text'] }}</p>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge badge-{{ $notification['status'] === 'pending' ? 'warning' : ($notification['status'] === 'approved' ? 'success' : ($notification['status'] === 'active' ? 'success' : 'danger')) }}">
                                                        {{ ucfirst($notification['status']) }}
                                                    </span>
                                                    @if(!$notification['is_read'])
                                                        <span class="badge badge-primary ml-2">New</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Filter functionality
    $('.dropdown-item[data-filter]').click(function(e) {
        e.preventDefault();
        const filter = $(this).data('filter');
        
        // Update active state of filter buttons
        $('.dropdown-item[data-filter]').removeClass('active');
        $(this).addClass('active');
        
        // Show all notifications first
        $('.notification-item').show();
        
        // Apply filters
        switch(filter) {
            case 'leave':
                $('.notification-item[data-type="cash_advance"]').hide();
                break;
            case 'cash_advance':
                $('.notification-item[data-type="leave"]').hide();
                break;
            case 'unread':
                $('.notification-item[data-read="1"]').hide();
                break;
            // 'all' case will show everything (default behavior)
        }
    });
});
</script>
@endpush 