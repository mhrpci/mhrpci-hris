@extends('adminlte::page')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Leave Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id">Employee Name:</label>
                                <p>{{ $leave->employee->company_id }} {{ $leave->employee->last_name }} {{ $leave->employee->first_name }}, {{ $leave->employee->middle_name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="type">Leave Type:</label>
                                <p>{{ $leave->type->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="type">Reason:</label>
                                <p>{{ $leave->reason_to_leave }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_from">Date From:</label>
                                <p>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_to">Date To:</label>
                                <p>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="date_to">Status:</label>
                                <p>{{ ucfirst($leave->status) }}</p>
                            </div>
                            <!-- Add more leave details here as needed -->
                        </div>
                    </div>
                    <br>
                    <a href="{{ route('leaves.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
