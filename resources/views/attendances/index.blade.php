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
                    <h3 class="card-title">Attendance Management</h3>
                    <div class="card-tools">
                        @can('attendance-create')
                        <a href="{{ route('attendances.create') }}" class="btn btn-success btn-sm rounded-pill">
                            Add Attendance <i class="fas fa-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    
                    <!-- Date range filter form -->
                    <form id="date-range-form" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table id="attendances-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->employee->company_id }} {{ $attendance->employee->last_name }} {{ $attendance->employee->first_name }},{{ $attendance->employee->middle_name}}</td>
                                    <td data-sort="{{ date('Y-m-d', strtotime($attendance->date_attended)) }}">
                                        {{ date('F d, Y', strtotime($attendance->date_attended)) }}
                                    </td>
                                    <td>{{ $attendance->time_in ? date('h:i A', strtotime($attendance->time_in)) : '--:-- --' }}</td>
                                    <td>
                                        {{ $attendance->time_out ? date('h:i A', strtotime($attendance->time_out)) : '--:-- --' }}
                                    </td>
                                    <td>{{ $attendance->remarks }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('attendances.show',$attendance->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                @can('attendance-edit')
                                                    <a class="dropdown-item" href="{{ route('attendances.edit',$attendance->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                @endcan
                                                @can('attendance-delete')
                                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this attendance?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
        var table = $('#attendances-table').DataTable({
            "order": [[1, "desc"]], // Sort by date column (index 1) in descending order
            "columnDefs": [
                {
                    "targets": 1, // Target the date column (index 1)
                    "render": function(data, type, row) {
                        // Convert the date to YYYY-MM-DD format for sorting and filtering
                        var date = new Date(data);
                        return date.getFullYear() + '-' + 
                               ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                               ('0' + date.getDate()).slice(-2);
                    }
                }
            ]
        });

        // Date range filter
        $('#date-range-form').on('submit', function(e) {
            e.preventDefault();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            // Custom filtering function
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var date = data[1]; // Use index 1 for the date column (now in YYYY-MM-DD format)

                if (
                    (startDate === "" && endDate === "") ||
                    (startDate === "" && date <= endDate) ||
                    (startDate <= date && endDate === "") ||
                    (startDate <= date && date <= endDate)
                ) {
                    return true;
                }
                return false;
            });

            table.draw(); // Redraw the table with the filter applied

            // Clear the custom filter
            $.fn.dataTable.ext.search.pop();
        });
    });
</script>
@endsection