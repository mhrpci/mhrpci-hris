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
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-primary">
                                                <i class="fas fa-filter"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="status-filter">
                                            <option value="">All</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="leave-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr>
                                            <td>{{ $leave->employee->company_id }} {{ $leave->employee->last_name }} {{ $leave->employee->first_name }}, {{ $leave->employee->middle_name }} {{ $leave->employee->suffix }}</td>
                                            <td><strong>From:</strong>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y') }}<br>
                                                <strong>To:</strong> {{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y') }}
                                            </td>
                                            <td>{{ $leave->type->name }}</td>
                                            <td style="text-align: center;">
                                                @if($leave->status == 'approved')
                                                    <i class="fas fa-check-circle" style="color: green;"></i> Approved
                                                @elseif($leave->status == 'rejected')
                                                    <i class="fas fa-times-circle" style="color: red;"></i> Rejected
                                                @else
                                                    <i class="fas fa-hourglass-half" style="color: orange;"></i> Pending
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ route('leaves.show',$leave->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
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
                var table = $('#leave-table').DataTable();

                // Filter by status
                $('#status-filter').on('change', function() {
                    table.column(3).search(this.value).draw();
                });
            });
        </script>
    @endsection