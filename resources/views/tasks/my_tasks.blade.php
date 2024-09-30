@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
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

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@stop
@section('content')
<br>
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Tasks</h3>
            <div class="float-right">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                    </div>
                    <select id="readFilter" class="form-control form-control-sm">
                        <option value="">All</option>
                        <option value="read">Read</option>
                        <option value="new">Unread</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tasksTable" class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Read</th>
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
                                        @if($task->is_read)
                                            <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Read</span>
                                        @else
                                            <span class="badge badge-info"><i class="fas fa-bell mr-1"></i> New</span>
                                        @endif
                                    </td>
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

    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        margin-bottom: 1rem;
    }

    .card-header {
        background-color: rgba(0,0,0,.03);
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: .75rem 1.25rem;
    }

    .card-title {
        margin-bottom: 0;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }

    #readFilter {
        border-left: none;
    }

    .input-group-sm > .input-group-prepend > .input-group-text {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var table = $('#tasksTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [
                { "orderable": false, "targets": 5 } // Disable ordering on the Action column (now index 5)
            ]
        });

        // Add custom filtering for read/unread
        $('#readFilter').on('change', function() {
            var selected = $(this).val();
            table.column(4).search(selected).draw();
        });
    });
</script>
@endsection
