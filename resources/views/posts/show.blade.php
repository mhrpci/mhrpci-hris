@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="post-header bg-primary text-white p-4 rounded-top">
                <h3 class="post-title mb-0">{{ $post->title }}</h3>
            </div>
            <div class="post-content p-4 bg-white rounded-bottom shadow-sm">
                <div class="post-meta mb-4">
                    <p class="text-muted mb-0">Posted on {{ $post->created_at->format('M d, Y') }}</p>
                </div>
                <div class="post-body mb-4">
                    <p>{!! nl2br(e($post->content)) !!}</p>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>Start Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($post->date_start)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>End Date:</strong>
                            <p>{{ \Carbon\Carbon::parse($post->date_end)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="post-info">
                            <strong>Author:</strong>
                            <p>{{ $post->user->first_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('posts.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .post-header {
        background-color: #007bff;
        color: white;
        padding: 1rem 1.5rem;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .post-title {
        margin: 0;
    }

    .post-content {
        background-color: white;
        padding: 2rem;
        border-bottom-left-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .post-meta {
        font-size: 0.875rem;
    }

    .post-body p {
        margin-bottom: 1rem;
    }

    .post-info {
        margin-bottom: 1rem;
    }

    .post-info strong {
        display: block;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
</style>
