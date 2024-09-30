@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
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

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">User Details</h2>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="profile-img img-fluid rounded-circle mb-3" style="height: 150px; width: 150px;">
                        </div>
                        <div class="col-md-9">
                            <h4 class="text-primary">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->suffix }}</h4>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Roles:</strong>
                                @forelse($user->getRoleNames() as $role)
                                    <span class="badge badge-secondary">{{ $role }}</span>
                                @empty
                                    <span class="badge badge-secondary">No roles assigned</span>
                                @endforelse
                            </p>
                            <p><strong>Bio:</strong> {{ $user->bio }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    Personal Information
                                </div>
                                <div class="card-body">
                                    <p><strong>First Name:</strong> {{ $user->first_name }}</p>
                                    <p><strong>Middle Name:</strong> {{ $user->middle_name ?? 'N/A' }}</p>
                                    <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
                                    <p><strong>Suffix:</strong> {{ $user->suffix ?: 'N/A'}}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    Additional Details
                                </div>
                                <div class="card-body">
                                    <p><strong>Bio:</strong> {{ $user->bio }}</p>
                                    <p><strong>Roles:</strong>
                                        @forelse($user->getRoleNames() as $role)
                                            <span class="badge badge-secondary">{{ $role }}</span>
                                        @empty
                                            <span class="badge badge-secondary">No roles assigned</span>
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
