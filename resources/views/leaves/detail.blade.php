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
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Leave Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id">Employee Name:</label>
                                <p>{{ $leave->employee->company_id }} {{ $leave->employee->last_name }} {{ $leave->employee->first_name }}, {{ $leave->employee->middle_name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="type">Leave Type:</label>
                                <p>{{ $leave->type->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="type">Reason:</label>
                                <p>{{ $leave->reason_to_leave }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_from">Date From:</label>
                                <p>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_to">Date To:</label>
                                <p>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_to">Status:</label>
                                <p>{{ ucfirst($leave->status) }}</p>
                            </div>
                            <!-- Add more leave details here as needed -->
                        </div>
                    </div>
                    <br>
                    <a href="{{ route('leaves.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
