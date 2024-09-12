<!-- resources/views/contributions/show.blade.php -->
@extends('adminlte::page')

@section('title', 'Contribution Details')

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

    /* Info Box Overlay */
    .info-box {
        position: relative;
        overflow: hidden;
        height: 120px; /* Set a consistent height for info boxes */
    }

    .info-box-overlay {
        position: absolute;
        bottom: 0;
        right: 10px; /* Margin to the right of the box */
        width: 100px; /* Adjust width as needed */
        height: 100px; /* Adjust height as needed */
        z-index: 1;
        opacity: 0.3;
        pointer-events: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .info-box-overlay img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Ensure the image fits within the overlay */
    }
</style>
@stop

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Contribution Information</h3>
                    <div class="card-tools">
                        @can('contribution-edit')
                            <a href="{{ route('contributions.edit', $contribution->id) }}" class="btn btn-sm btn-info mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endcan
                        @can('contribution-delete')
                            <form action="{{ route('contributions.destroy', $contribution->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this contribution?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="far fa-id-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Employee</span>
                                    <span class="info-box-number">{{ $contribution->employee->company_id }} {{ $contribution->employee->last_name }} {{ $contribution->employee->first_name }}, {{ $contribution->employee->middle_name ?? ' '}} {{ $contribution->employee->suffix ?? ' '}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Date</span>
                                    <span class="info-box-number">{{ $contribution->date }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">SSS Contribution</span>
                                    <span class="info-box-number">&#8369; {{ number_format($contribution->sss_contribution, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/sss.png') }}" alt="SSS Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-heartbeat"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">PhilHealth</span>
                                    <span class="info-box-number">&#8369; {{ number_format($contribution->philhealth_contribution, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/philhealth.png') }}" alt="PhilHealth Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-home"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pag-IBIG</span>
                                    <span class="info-box-number">&#8369; {{ number_format($contribution->pagibig_contribution, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/pagibig.png') }}" alt="Pag-IBIG Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">TIN</span>
                                    <span class="info-box-number">&#8369; {{ number_format($contribution->tin_contribution, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/tin.png') }}" alt="TIN Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('contributions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .info-box-number {
        font-size: 1.2rem;
    }
    .info-box-text {
        font-size: 0.9rem;
    }
    .card-title {
        font-size: 1.25rem;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Hide the loader when the page is fully loaded
        $('#loader').fadeOut();
    });
</script>
@stop