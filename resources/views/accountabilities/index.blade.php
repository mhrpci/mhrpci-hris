@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Accountabilities</h1>
    <a href="{{ route('accountabilities.create') }}" class="btn btn-primary mb-3">Create New Accountability</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>IT Inventories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accountabilities as $accountability)
            <tr>
                <td>{{ $accountability->id }}</td>
                <td>{{ $accountability->employee->name }}</td>
                <td>{{ $accountability->itInventories->pluck('name')->implode(', ') }}</td>
                <td>
                    <a href="{{ route('accountabilities.show', $accountability) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('accountabilities.edit', $accountability) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $accountabilities->links() }}
</div>
@endsection
