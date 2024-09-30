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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0 h3">{{ $hiring->position }}</h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-muted">Description</h5>
                        <p class="lead">{{ $hiring->description }}</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-muted">Requirements</h5>
                        <ul class="list-unstyled">
                            @foreach(explode("\n", $hiring->requirements) as $requirement)
                                <li><i class="fas fa-check-circle text-success mr-2"></i>{{ $requirement }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-muted">Location</h5>
                        <p class="lead"><i class="fas fa-map-marker-alt text-danger mr-2"></i>{{ $hiring->location }}</p>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <a href="{{ route('hirings.edit', $hiring) }}" class="btn btn-warning mr-2">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('hirings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                        </div>
                        <form action="{{ route('hirings.destroy', $hiring) }}" method="POST" class="mt-2 mt-sm-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this hiring?')">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
