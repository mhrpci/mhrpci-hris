@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content_header')
    <h1>All Notifications</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Notifications</h3>
        </div>
        <div class="card-body">
            @if(isset($allNotifications) && count($allNotifications) > 0)
                @foreach($allNotifications as $category => $notifications)
                    @if($category !== 'leave_requests' || Auth::user()->hasRole(['Super Admin', 'Admin']))
                        <h4 class="mt-4"><i class="fas fa-bell mr-2"></i>{{ ucfirst(str_replace('_', ' ', $category)) }}</h4>
                        @if(is_array($notifications) && isset($notifications['today']))
                            <h5 class="mt-3"><i class="fas fa-calendar-day mr-2"></i>Today</h5>
                            @if(count($notifications['today']) > 0)
                                @foreach($notifications['today'] as $notification)
                                    @include('partials.notification-item', ['notification' => $notification])
                                @endforeach
                            @else
                                <p class="text-muted">
                                    @if($category === 'birthdays')
                                        No birthdays today.
                                    @elseif($category === 'holidays')
                                        No holidays today.
                                    @elseif($category === 'leave_requests')
                                        No leave requests today.
                                    @elseif($category === 'posts')
                                        No posts today.
                                    @endif
                                </p>
                            @endif

                            @if(isset($notifications['upcoming']) && count($notifications['upcoming']) > 0)
                                <h5 class="mt-3"><i class="fas fa-calendar-alt mr-2"></i>Upcoming</h5>
                                @foreach($notifications['upcoming'] as $notification)
                                    @include('partials.notification-item', ['notification' => $notification])
                                @endforeach
                            @endif
                        @else
                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                    @include('partials.notification-item', ['notification' => $notification])
                                @endforeach
                            @else
                                <p class="text-muted">
                                    @if($category === 'birthdays')
                                        No birthdays.
                                    @elseif($category === 'holidays')
                                        No holidays.
                                    @elseif($category === 'leave_requests')
                                        No leave requests.
                                    @elseif($category === 'posts')
                                        No posts.
                                    @endif
                                </p>
                            @endif
                        @endif
                        <hr class="my-4">
                    @endif
                @endforeach
            @else
                <p class="text-muted">No notifications available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
