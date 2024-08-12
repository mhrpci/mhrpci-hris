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
                    <h3 class="card-title">TIN Contribution List</h3>
                    <div class="card-tools">
                        @can('tin-create')
                            <a href="{{ route('tin.create') }}" class="btn btn-primary btn-sm">Create New TIN</a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="tin-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>TIN No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tin as $tin)
                                <tr>
                                    <td>{{ $tin->employee->tin_no }}</td>
                                    <td>{{ $tin->employee->company_id }} {{ $tin->employee->last_name }} {{ $tin->employee->first_name }}, {{ $tin->employee->middle_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tin->date)->format('F j, Y') }}</td>
                                    <td>&#8369;{{ number_format($tin->tin_contribution, 2) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('tin.show',$tin->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('tin-edit')
                                                        <a class="dropdown-item" href="{{ route('tin.edit',$tin->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('tin-delete')
                                                        <form action="{{ route('tin.destroy', $tin->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this tin?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                        </form>
                                                    @endcan
                                                </div>
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
        $('#tin-table').DataTable();
    });
</script>
@endsection
