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
                        <h3 class="card-title">Holiday List</h3>
                        <div class="card-tools">
                            @can('holiday-create')
                            <a href="{{ route('holidays.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add holiday <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="holiday-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Holiday Type</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holidays as $holiday)
                                    <tr>
                                        <td>{{ $holiday->id}}</td>
                                        <td>{{ $holiday->title }}</td>
                                        <td>{{ $holiday->type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <!-- <a class="dropdown-item" href="{{ route('holidays.show',$holiday->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a> -->
                                                    @can('holiday-edit')
                                                        <a class="dropdown-item" href="{{ route('holidays.edit',$holiday->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('holiday-delete')
                                                        <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this holiday?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            $('#holiday-table').DataTable();
        });
    </script>
@endsection
