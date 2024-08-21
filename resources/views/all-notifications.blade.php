@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Notifications</h3>
        </div>
        <div class="card-body">
            @if(isset($allNotifications) && is_array($allNotifications))
                @foreach($allNotifications as $category => $count)
                    @if($category !== 'leave_requests' || Auth::user()->hasRole(['Super Admin', 'Admin']))
                        <div class="notification-item">
                            <h4 class="mt-4">
                                @if($category === 'birthdays')
                                    <i class="fas fa-birthday-cake mr-2"></i>
                                @elseif($category === 'posts')
                                    <i class="fas fa-bullhorn mr-2"></i>
                                @elseif($category === 'holidays')
                                    <i class="fas fa-calendar-day mr-2"></i>
                                @elseif($category === 'leave_requests')
                                    <i class="fas fa-calendar-times mr-2"></i>
                                @endif
                                {{ ucfirst(str_replace('_', ' ', $category)) }}
                            </h4>
                            <p class="mt-2">
                                @if($count > 0)
                                    You have {{ $count }} {{ str_replace('_', ' ', $category) }}.
                                @else
                                    No {{ str_replace('_', ' ', $category) }}.
                                @endif
                            </p>
                            <hr class="my-4">
                        </div>
                    @endif
                @endforeach
            @else
                <p class="text-muted">No notifications available.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .notification-item h4 {
        font-size: 1.25rem;
        font-weight: 500;
    }

    .notification-item p {
        font-size: 1rem;
        color: #6c757d;
    }

    .card {
        border-radius: 0.5rem;
    }

    .card-header {
        border-bottom: 1px solid #dee2e6;
    }

    @media (max-width: 768px) {
        .card-header h3 {
            font-size: 1.5rem;
        }
    }

    @media (min-width: 768px) {
        .container-fluid {
            max-width: 100%;
        }
    }
</style>
@endpush
