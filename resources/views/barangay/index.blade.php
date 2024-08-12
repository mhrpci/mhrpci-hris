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
                    <h3 class="card-title">Barangay List</h3>
                    <div class="card-tools">
                        @can('barangay-create')
                        <a href="{{ route('barangay.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add Barangay <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="barangay-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barangay</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangay as $barangay)
                                <tr>
                                    <td>{{ $barangay->id }}</td>
                                    <td>{{ $barangay->name }}</td>
                                    <td>{{ $barangay->city->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('barangay-edit')
                                                    <a class="dropdown-item" href="{{ route('barangay.edit',$barangay->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('barangay-delete')
                                                    <form action="{{ route('barangay.destroy', $barangay->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this barangay?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        $('#barangay-table').DataTable();
    });
</script>
@endsection
