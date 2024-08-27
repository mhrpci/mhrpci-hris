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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $task->title }}</h2>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Assigned To</span>
                                    <span class="info-box-number">{{ $task->employee->company_id }} {{ $task->employee->last_name }}, {{ $task->employee->first_name }} {{ $task->employee->middle_name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-tasks"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Status</span>
                                    <span class="info-box-number">{{ $task->status }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5>Description</h5>
                        <p>{{ $task->description }}</p>
                    </div>
                    <div class="mt-4">
                        @if(Auth::user()->hasRole('Employee'))
                            <a href="{{ route('myTasks') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to My Tasks
                            </a>
                        @else
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Tasks
                            </a>
                        @endif
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
