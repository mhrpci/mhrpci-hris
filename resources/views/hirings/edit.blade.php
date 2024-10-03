@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-info text-white">
                    <h2 class="mb-0"><i class="fas fa-edit mr-2"></i>Edit Hiring Position</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('hirings.update', $hiring->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position"><i class="fas fa-briefcase mr-2"></i>Position</label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ $hiring->position }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location"><i class="fas fa-map-marker-alt mr-2"></i>Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ $hiring->location }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description"><i class="fas fa-align-left mr-2"></i>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $hiring->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="requirements"><i class="fas fa-list-ul mr-2"></i>Requirements</label>
                            <textarea class="form-control" id="requirements" name="requirements" rows="4" required>{{ $hiring->requirements }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="benefits"><i class="fas fa-gift mr-2"></i>Benefits</label>
                            <textarea class="form-control" id="benefits" name="benefits" rows="4" required>{{ $hiring->benefits }}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-lg px-5">
                                <i class="fas fa-save mr-2"></i>Update Position
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: 0;
    }
    .form-control {
        border-radius: 10px;
    }
    .form-control:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    }
    .btn-lg {
        border-radius: 25px;
    }
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        transition: all 0.3s ease;
    }
    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
