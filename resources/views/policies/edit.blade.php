@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Policy</h1>
        <form action="{{ route('policies.update', $policy) }}" method="POST">
            @csrf
            @method('PUT')
            @include('policies.form')
            <button type="submit" class="btn btn-primary">Update Policy</button>
            <a href="{{ route('policies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
