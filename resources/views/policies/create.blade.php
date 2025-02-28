@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Policy</h1>
        <form action="{{ route('policies.store') }}" method="POST">
            @csrf
            @include('policies.form')
            <button type="submit" class="btn btn-primary">Create Policy</button>
            <a href="{{ route('policies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
