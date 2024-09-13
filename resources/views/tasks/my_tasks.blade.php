@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }
</style>
@stop

@section('content')
<br>
<div class="container-fluid">
    <h1 class="mb-4">My Tasks</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="table-responsive">
        <table id="tasksTable" class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($tasks->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No tasks assigned to you.</td>
                    </tr>
                @else
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if($task->status === 'Pending')
                                    <i class="fas fa-hourglass-half text-secondary"></i> Pending
                                @elseif($task->status === 'On Progress')
                                    <i class="fas fa-cog text-warning rotating"></i> On Progress
                                @elseif($task->status === 'Done')
                                    <i class="fas fa-check-circle text-success"></i> Done
                                @elseif($task->status === 'Abandoned')
                                    <i class="fas fa-times-circle text-danger"></i> Abandoned
                                @endif
                            </td>
                            <td>{{ $task->employee->first_name }} {{ $task->employee->last_name }}</td>
                            <td>
                                <div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('tasks.show',$task->id) }}">
                                                <i class="fas fa-eye"></i>&nbsp;Preview
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<style>
    .rotating {
        animation: rotate 2s infinite linear;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#tasksTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [
                { "orderable": false, "targets": 4 } // Disable ordering on the Action column
            ]
        });
    });
</script>
@endsection
