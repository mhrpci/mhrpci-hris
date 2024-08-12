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
                    <h3 class="card-title">Pagibig Contribution List</h3>
                    <div class="card-tools">
                        @can('pagibig-create')
                        <a href="{{ route('pagibig.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add PAGIBIG <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    <table id="pagibig-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Pagibig No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagibig as $pagibigItem)
                                <tr>
                                    <td>{{ $pagibigItem->employee->pagibig_no }}</td>
                                    <td>{{ $pagibigItem->employee->company_id }} {{ $pagibigItem->employee->last_name }} {{ $pagibigItem->employee->first_name }}, {{ $pagibigItem->employee->middle_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pagibigItem->date)->format('F j, Y') }}</td>
                                    <td>&#8369;{{  number_format($pagibigItem->pagibig_contribution, 2)}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm" type="button" id="dropdownMenuButton_{{ $pagibigItem->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $pagibigItem->id }}">
                                                <a class="dropdown-item" href="{{ route('pagibig.show', $pagibigItem->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('pagibig-edit')
                                                    <a class="dropdown-item" href="{{ route('pagibig.edit', $pagibigItem->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('pagibig-delete')
                                                    <form action="{{ route('pagibig.destroy', $pagibigItem->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this pagibig?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        $('#pagibig-table').DataTable();
    });
</script>
@endsection
