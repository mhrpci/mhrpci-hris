@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">PHILHEALTH Contribution List</h3>
                    <div class="card-tools">
                        @can('philhealth-create')
                        <a href="{{ route('philhealth.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add PHILHEALTH <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="philhealth-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
    
                                <th>PHILHEALTH No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($philhealth as $philhealth)
                                <tr>
                         
                                    <td>{{ $philhealth->employee->philhealth_no }}</td>
                                    <td>{{ $philhealth->employee->company_id }} {{ $philhealth->employee->last_name }} {{ $philhealth->employee->first_name }}, {{ $philhealth->employee->middle_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($philhealth->date)->format('F j, Y') }}</td>
                                    <td>&#8369;{{  number_format($philhealth->philhealth_contribution, 2)}}</td>
                                    <!-- Replace the existing 'Action' column in the table with dropdown buttons -->
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('philhealth.show',$philhealth->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('philhealth-edit')
                                                    <a class="dropdown-item" href="{{ route('philhealth.edit',$philhealth->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('philhealth-delete')
                                                    <form action="{{ route('philhealth.destroy', $philhealth->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this philhealth?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#philhealth-table').DataTable();
    });
</script>
@endsection
