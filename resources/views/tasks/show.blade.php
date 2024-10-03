@extends('layouts.app')

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
