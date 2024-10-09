@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Backups</h1>
        <a href="{{ route('backups.create') }}" class="btn btn-primary mb-3">Create Backup</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Last Modified</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($backups as $backup)
                    <tr>
                        <td>{{ basename($backup['file_name']) }}</td>
                        <td>{{ round($backup['file_size'] / 1048576, 2) }} MB</td>
                        <td>{{ \Carbon\Carbon::createFromTimestamp($backup['last_modified'])->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('backups.download', basename($backup['file_name'])) }}" class="btn btn-sm btn-info">Download</a>
                            <form action="{{ route('backups.delete', basename($backup['file_name'])) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
