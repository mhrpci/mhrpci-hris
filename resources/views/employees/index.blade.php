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
                        <h3 class="card-title">Employee Management</h3>
                        <div class="card-tools d-flex flex-wrap">
                            @can('employee-create')
                            <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm rounded-pill mr-2 mb-2">
                                Add Employee <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                            <a href="{{ route('employees.birthdays') }}" class="btn btn-info btn-sm rounded-pill mr-2 mb-2">
                                View Birthdays <i class="fas fa-calendar-alt"></i>
                            </a>
                            <button class="btn btn-primary btn-sm rounded-pill mr-2 mb-2" data-toggle="modal" data-target="#importModal">
                                Import Employees <i class="fas fa-file-import"></i>
                            </button>
                            <form action="{{ route('employees.export') }}" method="POST" target="_blank">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm rounded-pill mr-2 mb-2">Export Employees <i class="fas fa-file-export"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endif
                        
                        <table id="employees-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->company_id }}</td>
                                        <td>{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }} {{ $employee->suffix }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                        <td>{{ $employee->employment_status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @can('employee-edit')
                                                        <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('employee-delete')
                                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                        </form>
                                                    @endcan
                                                    @can('user-create')
                                                        <form action="{{ route('employees.createUser', $employee->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to create a user for this employee?')"><i class="fas fa-user-plus"></i>&nbsp;Create User</button>
                                                        </form>
                                                    @endcan
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#additionalDetailsModal"><i class="fas fa-balance-scale"></i>&nbsp;Leave Balance</a>
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

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="importModalLabel"><i class="fas fa-file-import"></i> Import Employees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputGroupFile" class="form-label">Choose file</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon"><i class="fas fa-upload"></i></span>
                                </div>
                                <input type="file" class="form-control" id="inputGroupFile" name="file" required aria-describedby="inputGroupFileAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="progress">
                                <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="form-text text-muted">Please upload a valid CSV or Excel file.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-file-import"></i> Import Employees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Additional Details Modal -->
    <div class="modal fade" id="additionalDetailsModal" tabindex="-1" role="dialog" aria-labelledby="additionalDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="additionalDetailsModalLabel">Leave Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card border-secondary mb-3">
                            <div class="card-body">
                                <p><strong>Sick Leave:</strong> {{$employee->sick_leave}} Hours - is equivalent - {{($employee->sick_leave) / 24}} Day</p>
                                <p><strong>Vacation Leave:</strong> {{$employee->vacation_leave}} Hours - is equivalent - {{($employee->vacation_leave) / 24}} Day</p>
                                <p><strong>Emergency Leave:</strong> {{$employee->emergency_leave}} Hours - is equivalent - {{($employee->emergency_leave) / 24}} Day</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
    $('#employees-table').DataTable();

    // Target only the import form
    $('#importModal form').on('submit', function(e) {
        e.preventDefault();

        let form = this;
        let progressBar = $('#progressBar');
        progressBar.css('width', '0%');
        
        let formData = new FormData(form);
        
        $.ajax({
            xhr: function() {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        let percentComplete = (e.loaded / e.total) * 100;
                        progressBar.css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Import successful');
                $('#importModal').modal('hide');
                // Optionally refresh the page or update the table
                location.reload();
            },
            error: function(data) {
                alert('Import failed');
            }
        });
    });

    // // Handle other form submissions normally
    // $('form:not(#importModal form)').on('submit', function() {
    //     return confirm('Are you sure you want to perform this action?');
    // });
});
    </script>
@endsection
