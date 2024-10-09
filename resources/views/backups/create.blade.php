@extends('layouts.app')

@section('content')
    <h1>Create New Backup</h1>

    <p>Click the button below to create a new database backup.</p>

    <form action="{{ route('backups.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Create Backup</button>
    </form>
@endsection
