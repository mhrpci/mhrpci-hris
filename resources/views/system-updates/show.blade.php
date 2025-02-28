@extends('layouts.app')

@section('title', $systemUpdate->title)

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">System Update Details</h5>
            </div>
            <div class="col text-end">
                <div class="btn-group" role="group">
                    <a href="{{ route('system-updates.edit', $systemUpdate) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('system-updates.destroy', $systemUpdate) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this update?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-1">Title</h6>
                <p class="mb-0">{{ $systemUpdate->title }}</p>
            </div>
            <div class="col-md-3">
                <h6 class="text-muted mb-1">Status</h6>
                <p class="mb-0">
                    @if($systemUpdate->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
            </div>
            <div class="col-md-3">
                <h6 class="text-muted mb-1">Published At</h6>
                <p class="mb-0">{{ $systemUpdate->published_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="mb-4">
            <h6 class="text-muted mb-1">Description</h6>
            <div class="card bg-light">
                <div class="card-body">
                    {!! nl2br(e($systemUpdate->description)) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted mb-1">Created At</h6>
                <p class="mb-0">{{ $systemUpdate->created_at->format('M d, Y H:i:s') }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-1">Last Updated</h6>
                <p class="mb-0">{{ $systemUpdate->updated_at->format('M d, Y H:i:s') }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('system-updates.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection 