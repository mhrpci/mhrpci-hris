@extends('layouts.app')

@section('title', 'System Updates')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">System Updates</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('system-updates.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> New Update
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($updates as $update)
                        <tr>
                            <td>{{ $update->title }}</td>
                            <td>{{ Str::limit($update->description, 100) }}</td>
                            <td>
                                @if($update->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($update->published_at)
                                    {{ $update->published_at instanceof \Carbon\Carbon 
                                        ? $update->published_at->format('M d, Y') 
                                        : \Carbon\Carbon::parse($update->published_at)->format('M d, Y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('system-updates.show', $update) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('system-updates.edit', $update) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('system-updates.destroy', $update) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this update?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">No system updates found</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($updates->hasPages())
        <div class="card-footer bg-white">
            {{ $updates->links() }}
        </div>
    @endif
</div>
@endsection 