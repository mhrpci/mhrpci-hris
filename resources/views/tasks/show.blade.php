@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
    <h1>{{ $task->title }}</h1>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Employee:</strong> {{ $task->employee->company_id }} {{ $task->employee->last_name }}, {{ $task->employee->first_name }} {{ $task->employee->middle_name }}</p>
    <p><strong>Status:</strong> {{ $task->status }}</p>
    
    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
    @if(Auth::user()->hasRole('Employee'))
        <a href="{{ route('tasks.myTasks') }}" class="btn btn-secondary">Back to My Tasks</a>
    @else
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
    @endif
@endsection
