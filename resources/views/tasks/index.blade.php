@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Task List</h3>
            <div class="card-tools">
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add Task <i class="fas fa-plus-circle"></i>
                        </a>
            </div>
        </div>
        <div class="card-body">
            <table id="tasks-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->employee->company_id }} {{ $task->employee->last_name }}, {{ $task->employee->first_name }} {{ $task->employee->middle_name }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                            @if($task->status === 'Pending')
                                <i class="fas fa-hourglass-half text-gray"></i> Pending
                            @elseif($task->status === 'On Progress')
                                <i class="fas fa-cog text-warning rotating"></i> On Progress
                            @elseif($task->status === 'Done')
                                <i class="fas fa-check-circle text-success"></i> Done
                            @elseif($task->status === 'Abandoned')
                                <i class="fas fa-times-circle text-danger"></i> Abandoned
                            @endif
                        </td>
                            <td>
                                        <div class="btn-group">
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('tasks.show',$task->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('tasks-edit')
                                                        <a class="dropdown-item" href="{{ route('tasks.edit',$task->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('tasks-delete')
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this tasks?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasks-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
@section('css')
<style>
    .rotating {
        animation: rotate 2s infinite linear;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection