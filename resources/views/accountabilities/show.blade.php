@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Accountability Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Employee: {{ $accountability->employee->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">IT Inventories:</h6>
            <ul>
                @foreach($accountability->itInventories as $inventory)
                    <li>{{ $inventory->name }}</li>
                @endforeach
            </ul>
            <h6 class="card-subtitle mb-2 text-muted">Documents:</h6>
            <ul>
                @foreach(json_decode($accountability->documents) as $document)
                    <li><a href="{{ Storage::url($document) }}" target="_blank">View Document</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('accountabilities.edit', $accountability) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('accountabilities.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
