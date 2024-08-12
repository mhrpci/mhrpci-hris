<!-- resources/views/loanpagibig/show.blade.php -->
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
                @can('loanpagibig-delete')
                       <form action="{{ route('loanpagibig.destroy', $loanpagibig->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger float-right" onclick="return confirm('Are you sure you want to delete this loan?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                      </form>
                    @endcan
                    @can('loanpagibig-edit')
                      <a href="{{ route('loanpagibig.edit',$loanpagibig->id) }}" class="btn btn-sm btn-secondary float-right" style ="margin-right:5px;"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                    @endcan
                    <h5>Pagibig Loan Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id">Pagibig ID</label>
                        <p>{{ $loanpagibig->employee->pagibig_no }}</p>
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Employee ID:</label>
                        <p>{{ $loanpagibig->employee->company_id }}</p>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <p>&#8369;{{ number_format($loanpagibig->pagibig_loan, 2) }}</p>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <p>{{ $loanpagibig->date_repayment }}</p>
                    </div>
                    <a href="{{ route('loanpagibig.index') }}" class="btn btn-primary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
