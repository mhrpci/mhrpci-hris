@extends('layouts.app')

@section('content')
    <h1>Database Backups</h1>
    <a href="{{ route('backups.create') }}" class="btn btn-primary">Create New Backup</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Filename</th>
                <th>Size</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($backups as $backup)
                <tr>
                    <td>{{ $backup->filename }}</td>
                    <td>{{ $backup->formatted_size }}</td>
                    <td>{{ $backup->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('backups.download', $backup) }}" class="btn btn-sm btn-info">Download</a>
                        <form action="{{ route('backups.destroy', $backup) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $backups->links() }}
@endsection
