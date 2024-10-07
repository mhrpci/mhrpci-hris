@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title mb-2 mb-sm-0">My Tasks</h3>
                <div class="mt-2 mt-sm-0">
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
                                <td colspan="6" class="text-center">No tasks assigned to you.</td>
                            </tr>
                        @else
                            @foreach($tasks as $task)
                                <tr>
                                    <td data-label="Title">{{ $task->title }}</td>
                                    <td data-label="Description">{{ $task->description }}</td>
                                    <td data-label="Status">
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
                                    <td data-label="Assigned To">{{ $task->employee->first_name }} {{ $task->employee->last_name }}</td>
                                    <td data-label="Read">
                                        @if($task->is_read)
                                            <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Read</span>
                                        @else
                                            <span class="badge badge-info"><i class="fas fa-bell mr-1"></i> New</span>
                                        @endif
                                    </td>
                                    <td data-label="Action">
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

@push('styles')
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

    @media screen and (max-width: 767px) {
        #tasksTable thead {
            display: none;
        }

        #tasksTable, #tasksTable tbody, #tasksTable tr, #tasksTable td {
            display: block;
            width: 100%;
        }

        #tasksTable tr {
            margin-bottom: 15px;
        }

        #tasksTable td {
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        #tasksTable td::before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
        }
    }
</style>
@endpush

@push('scripts')
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
            ],
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });

        // Add custom filtering for read/unread
        $('#readFilter').on('change', function() {
            var selected = $(this).val();
            table.column(4).search(selected).draw();
        });
    });
</script>
@endpush
