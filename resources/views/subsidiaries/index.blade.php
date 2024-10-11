@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Subsidiaries</h1>
        <a href="{{ route('subsidiaries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Subsidiary
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($subsidiaries as $subsidiary)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $subsidiary->main_image) }}" class="card-img-top" alt="{{ $subsidiary->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $subsidiary->name }} <span class="badge bg-secondary">{{ $subsidiary->abbr }}</span></h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($subsidiary->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('subsidiaries.show', $subsidiary) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <div class="btn-group" role="group">
                                <a href="{{ route('subsidiaries.edit', $subsidiary) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('subsidiaries.destroy', $subsidiary) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this subsidiary?')">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush
