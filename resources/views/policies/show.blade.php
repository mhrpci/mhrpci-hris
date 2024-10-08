@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $policy->title }}</h1>
    <p><strong>Section:</strong> {{ $policy->section->name }}</p>
    <p><strong>Sort Order:</strong> {{ $policy->sort_order }}</p>
    <div class="policy-content">
        {!! $policy->content !!}
    </div>
    <a href="{{ route('policies.edit', $policy) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('policies.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
