<!-- resources/views/philhealth/show.blade.php -->
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
                    @can('philhealth-delete')
                       <form action="{{ route('philhealth.destroy', $philhealth->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger float-right" onclick="return confirm('Are you sure you want to delete this philhealth?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                      </form>
                    @endcan
                    @can('philhealth-edit')
                      <a href="{{ route('philhealth.edit',$philhealth->id) }}" class="btn btn-sm btn-secondary float-right" style ="margin-right:5px;"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                    @endcan         
                    <h5>PHILHEALTH Contribution Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">PHILHEALTH ID</label>
                        <p>{{ $philhealth->employee->phil_no }}</p>
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Employee ID:</label>
                        <p>{{ $philhealth->employee->company_id }} {{ $philhealth->employee->last_name }} {{ $philhealth->employee->first_name }}, {{ $philhealth->employee->middle_name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <p>&#8369;{{  number_format($philhealth->philhealth_contribution, 2)}}</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <p>{{ $philhealth->date }}</p>
                    </div>
                    <a href="{{ route('philhealth.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
