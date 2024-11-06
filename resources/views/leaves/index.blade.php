    @extends('layouts.app')

    @section('content')
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Leave Management</h3>
                            <div class="card-tools">
                                @can('leave-create')
                                <a href="{{ route('leaves.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add Leave <i class="fas fa-plus-circle"></i>
                            </a>
                                @endcan
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">{{ $message }}</div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-primary">
                                                <i class="fas fa-filter"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="status-filter">
                                            <option value="">All Status</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-primary">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="read-filter">
                                            <option value="">All Leaves</option>
                                            <option value="read">Read Leaves</option>
                                            <option value="new">Unread Leaves</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="leave-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                            <tr>
                                                <td data-label="Employee Name">{{ $leave->employee->company_id }} {{ $leave->employee->last_name }} {{ $leave->employee->first_name }}, {{ $leave->employee->middle_name }} {{ $leave->employee->suffix }}</td>
                                                <td data-label="Date">
                                                    <div class="d-flex flex-column">
                                                        <span><strong>From:</strong> {{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y') }}</span>
                                                        <span><strong>To:</strong> {{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y') }}</span>
                                                    </div>
                                                </td>
                                                <td data-label="Type">{{ $leave->type->name }}</td>
                                                <td data-label="Status" class="text-center">
                                                    @if($leave->status == 'approved')
                                                        <span class="d-inline-block">
                                                            <i class="fas fa-check-circle" style="color: green;"></i> Approved
                                                        </span>
                                                    @elseif($leave->status == 'rejected')
                                                        <span class="d-inline-block">
                                                            <i class="fas fa-times-circle" style="color: red;"></i> Rejected
                                                        </span>
                                                    @else
                                                        <span class="d-inline-block">
                                                            <i class="fas fa-hourglass-half" style="color: orange;"></i> Pending
                                                        </span>
                                                    @endif
                                                </td>
                                                <td data-label="Read" class="text-center">
                                                    @if($leave->is_read)
                                                        <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Read</span>
                                                    @else
                                                        <span class="badge badge-info"><i class="fas fa-bell mr-1"></i> New</span>
                                                    @endif
                                                </td>
                                                <td data-label="Action" class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('leaves.show',$leave->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                            @canany(['HR ComBen', 'Admin', 'Super Admin'])
                                                            <a class="dropdown-item" href="{{ route('leaves.edit', $leave->id) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            @endcanany
                                                            @can('leave-delete')
                                                                <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this leave?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
                var table = $('#leave-table').DataTable({
                    responsive: true,
                    scrollX: true,
                    autoWidth: false,
                    language: {
                        searchPlaceholder: "Search records"
                    },
                    // Make DataTables responsive
                    columnDefs: [
                        { responsivePriority: 1, targets: [0, 3, 5] }, // Employee, Status, Action
                        { responsivePriority: 2, targets: [1, 2] },    // Date, Type
                        { responsivePriority: 3, targets: 4 }          // Read
                    ]
                });

                // Filter by status
                $('#status-filter').on('change', function() {
                    table.column(3).search(this.value).draw();
                });

                // Filter by read status
                $('#read-filter').on('change', function() {
                    var searchTerm = this.value === 'read' ? 'Read' : (this.value === 'new' ? 'New' : '');
                    table.column(4).search(searchTerm).draw();
                });
            });
        </script>
    @endsection

    @section('css')
        <style>
            @media screen and (max-width: 768px) {
                .card-tools {
                    margin-top: 10px;
                    display: flex;
                    justify-content: flex-start;
                }

                .table-responsive {
                    margin-bottom: 15px;
                }

                /* Improve dropdown menu on mobile */
                .dropdown-menu {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 200px;
                    margin-top: 0;
                }

                .dropdown-item {
                    padding: 10px 15px;
                }

                /* Improve filter appearance on mobile */
                .input-group {
                    width: 100%;
                }

                /* Add some spacing between table cells on mobile */
                .table td {
                    padding: 12px 8px;
                }
            }

            /* Ensure consistent button styling */
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 0.2rem;
            }
        </style>
    @endsection
