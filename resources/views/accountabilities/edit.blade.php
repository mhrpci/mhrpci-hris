@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Accountability</h1>
    <form action="{{ route('accountabilities.update', $accountability) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $accountability->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="it_inventory_ids">IT Inventories</label>
            <select name="it_inventory_ids[]" id="it_inventory_ids" class="form-control" multiple required>
                @foreach($itInventories as $inventory)
                    <option value="{{ $inventory->id }}" {{ in_array($inventory->id, json_decode($accountability->it_inventory_ids)) ? 'selected' : '' }}>
                        {{ $inventory->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="documents">Add New Documents</label>
            <input type="file" name="documents[]" id="documents" class="form-control-file" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Update Accountability</button>
    </form>
</div>
@endsection
