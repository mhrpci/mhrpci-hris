@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Cash Advance Status</h1>
    <form action="{{ route('cash_advances.update', $cashAdvance) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="active" {{ $cashAdvance->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="complete" {{ $cashAdvance->status == 'complete' ? 'selected' : '' }}>Complete</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection

