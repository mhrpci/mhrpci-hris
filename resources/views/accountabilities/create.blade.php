@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Create Accountability</h1>
    <form action="{{ route('accountabilities.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="it_inventory_ids">IT Inventories</label>
            <select name="it_inventory_ids[]" id="it_inventory_ids" class="form-control" multiple required>
                @foreach($itInventories as $inventory)
                    <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="documents">Documents</label>
            <input type="file" name="documents[]" id="documents" class="form-control-file" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Create Accountability</button>
    </form>
</div>
@endsection
