@extends('layouts.app')

@section('css')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Management</h3>
                        <div class="card-tools d-flex flex-wrap justify-content-end">
                            @can('employee-create')
                            <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm rounded-pill mr-2 mb-2">
                                Add Employee <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                            <div class="dropdown mr-2 mb-2">
                                <button class="btn btn-warning btn-sm dropdown-toggle rounded-pill" type="button" id="employeeStatusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Employee Status <i class="fas fa-user-clock"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="employeeStatusDropdown">
                                    <a class="dropdown-item" href="{{ route('employees.resigned') }}">
                                        <i class="fas fa-sign-out-alt"></i> Resigned Employees
                                    </a>
                                    <a class="dropdown-item" href="{{ route('employees.terminated') }}">
                                        <i class="fas fa-user-times"></i> Terminated Employees
                                    </a>
                                </div>
                            </div>
                            @if(Auth::user()->hasRole(['Super Admin', 'Admin']))
                            <button class="btn btn-primary btn-sm rounded-pill mr-2 mb-2" data-toggle="modal" data-target="#importModal">
                                Import Employees <i class="fas fa-file-import"></i>
                            </button>
                            <form action="{{ route('employees.export') }}" method="POST" target="_blank" class="mr-2 mb-2">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm rounded-pill">Export Employees <i class="fas fa-file-export"></i></button>
                            </form>
                            @endcan
                            @canany(['super-admin', 'admin', 'hrcompliance'])
                            <form action="{{ route('employees.createBulkUsers') }}" method="POST" class="d-inline mr-2 mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm rounded-pill create-bulk-users-btn">
                                        Create All User Accounts <i class="fas fa-users"></i>
                                    </button>
                            </form>
                            @endcan
                            <div class="dropdown mr-2 mb-2">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter <i class="fas fa-filter"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#monthModal">Month</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#yearModal">Year</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusModal">Status</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#departmentModal">Department</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rankModal">Rank</a>
                                </div>
                            </div>                    
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
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Rank</th>
                                    <th>Joined Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->company_id }}</td>
                                        <td>{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }} {{ $employee->suffix }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                        <td align="center" style="color: {{ $employee->employee_status === 'Active' ? 'green' : 'red' }}; font-weight: bold;">
                                            {{ $employee->employee_status }}
                                        </td>
                                        <td align="center" style="color: {{ $employee->rank === 'Rank File' ? 'green' : 'blue' }}; font-weight: bold;">
                                            {{ $employee->rank }}
                                        </td>
                                        <td>{{ $employee->date_hired ? \Carbon\Carbon::parse($employee->date_hired)->format('F j, Y') : '' }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{ route('employees.show', $employee->slug) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                                    @if($employee->employee_status !== 'Resigned')
                                                            @if ($employee->rank !== 'Rank File' && (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Finance')))
                                                                <a class="dropdown-item" href="{{ route('employees.edit', $employee->slug) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                            @elseif ($employee->rank === 'Rank File' && (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('HR Compliance') || Auth::user()->hasRole('Finance')))
                                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->slug) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                            @endif
                                                        @if(!$employee->email_address || !App\Models\User::where('email', $employee->email_address)->exists())
                                                            @can('user-create')
                                                                <form action="{{ route('employees.createUser', $employee->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item create-user-btn">
                                                                    <i class="fas fa-user-plus"></i>&nbsp;Create User
                                                                </button>
                                                                </form>
                                                            @elsecan('hrcompliance')
                                                                <form action="{{ route('employees.createUser', $employee->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item create-user-btn">
                                                                    <i class="fas fa-user-plus"></i>&nbsp;Create User
                                                                </button>
                                                                </form>
                                                            @endcan
                                                        @else
                                                            <button class="dropdown-item" disabled>
                                                                <i class="fas fa-check"></i>&nbsp;User Account Exists
                                                            </button>
                                                        @endif
                                                        <button class="dropdown-item" data-toggle="modal"
                                                                data-target="#additionalDetailsModal"
                                                                data-employee-name="{{ $employee->last_name }} {{ $employee->first_name }}"
                                                                data-employee-id="{{ $employee->company_id }}"
                                                                data-position="{{ $employee->position->name }}"
                                                                data-sick-leave="{{ $employee->sick_leave }}"
                                                                data-vacation-leave="{{ $employee->vacation_leave }}"
                                                                data-emergency-leave="{{ $employee->emergency_leave }}">
                                                            <i class="fas fa-balance-scale"></i>&nbsp;Leave Balance
                                                        </button>
                                                        @canany(['super-admin', 'admin', 'hrcompliance'])
                                                                <form action="{{ route('employees.disable', $employee->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="dropdown-item resign-btn">
                                                                        <i class="fas fa-sign-out-alt"></i>&nbsp;Resigned
                                                                    </button>
                                                                </form>
                                                            @endcanany
                                                        @endif
                                                        @can('super-admin')
                                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item delete-btn">
                                                                <i class="fas fa-trash"></i>&nbsp;Delete
                                                            </button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                            <!-- Enhanced Leave Balance Modal -->
                                            <div class="modal fade" id="additionalDetailsModal" tabindex="-1" role="dialog" aria-labelledby="additionalDetailsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="additionalDetailsModalLabel">
                                                                <i class="fas fa-calendar-check"></i> Employee Leave Balance
                                                            </h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="employee-info mb-3">
                                                                <h6 class="font-weight-bold" id="employeeName"></h6>
                                                                <small class="text-muted" id="employeeDetails"></small>
                                                            </div>
                                                            <div class="row">
                                                                <!-- Sick Leave Card -->
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="card border-left-danger h-100 py-2">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">
                                                                                <div class="col mr-2">
                                                                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                                                        Sick Leave Balance</div>
                                                                                    <div class="row no-gutters align-items-center">
                                                                                        <div class="col-auto">
                                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                                                {{ number_format($employee->sick_leave, 2) }} Hours
                                                                                            </div>
                                                                                            <small class="text-muted">
                                                                                                Equivalent to {{ number_format($employee->sick_leave / 24, 2) }} Days
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <i class="fas fa-hospital text-gray-300 fa-2x"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Vacation Leave Card -->
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="card border-left-primary h-100 py-2">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">
                                                                                <div class="col mr-2">
                                                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                                        Vacation Leave Balance</div>
                                                                                    <div class="row no-gutters align-items-center">
                                                                                        <div class="col-auto">
                                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                                                {{ number_format($employee->vacation_leave, 2) }} Hours
                                                                                            </div>
                                                                                            <small class="text-muted">
                                                                                                Equivalent to {{ number_format($employee->vacation_leave / 24, 2) }} Days
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <i class="fas fa-umbrella-beach text-gray-300 fa-2x"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Emergency Leave Card -->
                                                                <div class="col-md-12">
                                                                    <div class="card border-left-warning h-100 py-2">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">
                                                                                <div class="col mr-2">
                                                                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                                                        Emergency Leave Balance</div>
                                                                                    <div class="row no-gutters align-items-center">
                                                                                        <div class="col-auto">
                                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                                                {{ number_format($employee->emergency_leave, 2) }} Hours
                                                                                            </div>
                                                                                            <small class="text-muted">
                                                                                                Equivalent to {{ number_format($employee->emergency_leave / 24, 2) }} Days
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <i class="fas fa-exclamation-circle text-gray-300 fa-2x"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                <i class="fas fa-times"></i> Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

            <!-- Month Modal -->
            <div class="modal fade" id="monthModal" tabindex="-1" role="dialog" aria-labelledby="monthModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="monthModalLabel">Filter by Month</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="monthForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <input type="month" class="form-control" id="month" name="month" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Year Modal -->
            <div class="modal fade" id="yearModal" tabindex="-1" role="dialog" aria-labelledby="yearModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="yearModalLabel">Filter by Year</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="yearForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" id="year" name="year" min="1900" max="2099" step="1" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Status Modal -->
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="statusModalLabel">Filter by Employment Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="statusForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="employee_status">Employment Status</label>
                                    <select class="form-control" id="employee_status" name="employee_status" required>
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Resigned">Resigned</option>
                                        <option value="Terminated">Terminated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Department Modal -->
            <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="departmentModalLabel">Filter by Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="departmentForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="department" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->name }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Rank Modal -->
            <div class="modal fade" id="rankModal" tabindex="-1" role="dialog" aria-labelledby="rankModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="rankModalLabel">Filter by Rank</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="rankForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                                <select class="form-control" id="rank" name="rank" required>
                                    <option value="">Select Rank</option>
                                    <option value="Rank File">Rank File</option>
                                    <option value="Managerial">Managerial</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@section('js')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
       $(document).ready(function () {
    let table = $('#employees-table').DataTable({
        columnDefs: [
            {
                targets: 6, // Targeting the "Joined Date" column (0-based index)
                type: 'date'
            }
        ],
        order: [
            [4, 'asc'], // Sort by status column (index 4) in ascending order to put 'Active' last
            [1, 'asc']  // Then sort by name as secondary sort
        ]
    });

    // Enhanced showToast function with green background and white text
    function showToast(message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#28a745', // Green background
            color: '#ffffff',      // White text
            customClass: {
                popup: 'colored-toast',
                title: 'toast-title',
                timerProgressBar: 'toast-progress'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: 'success',
            iconColor: '#ffffff', // White icon
            title: message,
            padding: '10px 20px'
        });
    }

    // Enhanced success alert
    function showSuccessAlert(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: message,
            timer: 3000,
            showConfirmButton: false,
            customClass: {
                popup: 'alert-popup',
                title: 'alert-title',
                content: 'alert-content'
            },
            backdrop: `rgba(0,0,0,0.4)`
        });
    }

    // Enhanced error alert
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: message,
            timer: 3000,
            showConfirmButton: false,
            customClass: {
                popup: 'alert-popup',
                title: 'alert-title',
                content: 'alert-content'
            },
            backdrop: `rgba(0,0,0,0.4)`
        });
    }

    // Import form submission with enhanced alerts
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
                $('#importModal').modal('hide');
                showSuccessAlert('Import completed successfully');
                setTimeout(() => location.reload(), 2000);
            },
            error: function(data) {
                showErrorAlert('Import failed. Please try again.');
            }
        });
    });

    // Prevent form submission and show SweetAlert2 confirmation
    $(document).on('click', '.create-user-btn', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Create User Account',
            text: 'Are you sure you want to create a user account for this employee?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, create it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $(document).on('click', '.resign-btn', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Mark as Resigned',
            text: 'Are you sure that this employee has resigned?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Delete Employee',
            text: 'Are you sure you want to delete this employee? This action cannot be undone.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Replace session alerts with SweetAlert2
    @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ Session::get('success') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ Session::get('error') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    // Status Filter
    $('#statusForm').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        $('#statusModal').modal('hide');
        showToast('Employment Status filter applied successfully!');
        $(this).trigger('reset'); // Clear the filter form fields
    });

    // Month Filter
    $('#monthForm').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        $('#monthModal').modal('hide');
        showToast('Month filter applied successfully!');
        $(this).trigger('reset'); // Clear the filter form fields
    });

    // Year Filter
    $('#yearForm').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        $('#yearModal').modal('hide');
        showToast('Year filter applied successfully!');
        $(this).trigger('reset'); // Clear the filter form fields
    });

    // Department Filter
    $('#departmentForm').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        $('#departmentModal').modal('hide');
        showToast('Department filter applied successfully!');
        $(this).trigger('reset'); // Clear the filter form fields
    });

    // Rank Filter
    $('#rankForm').on('submit', function (e) {
        e.preventDefault();
        table.draw();
        $('#rankModal').modal('hide');
        showToast('Rank filter applied successfully!');
        $(this).trigger('reset'); // Clear the filter form fields
    });

    // Custom filtering function
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            let dateHiredStr = data[6]; // Get the "Joined Date" value from the 7th column (0-based index)
            let employeeStatus = data[4]; // Get the "Employment Status" value from the 5th column
            let department = data[2]; // Assuming department is in the 3rd column
            let rank = data[5]; // Get the "Rank" value from the 6th column (0-based index)
            if (!dateHiredStr) return true; // If no date, include the row

            let dateHiredObj = new Date(dateHiredStr);

            // Get the month, year, status, department, and rank from the form inputs
            let selectedMonth = $('#month').val();
            let selectedYear = $('#year').val();
            let selectedStatus = $('#employee_status').val();
            let selectedDepartment = $('#department').val();
            let selectedRank = $('#rank').val();

            // Convert selectedMonth to date object if it exists
            let filterMonth = selectedMonth ? new Date(selectedMonth) : null;
            let filterYear = selectedYear ? parseInt(selectedYear) : null;

            // Date, status, department, and rank filter logic
            if (filterMonth || filterYear || selectedStatus || selectedDepartment || selectedRank) {
                // Apply month and year filters if they exist
                if (filterMonth && filterYear) {
                    if (dateHiredObj.getMonth() !== filterMonth.getMonth() || dateHiredObj.getFullYear() !== filterYear) {
                        return false;
                    }
                } else if (filterMonth && !filterYear) {
                    if (dateHiredObj.getMonth() !== filterMonth.getMonth()) {
                        return false;
                    }
                } else if (!filterMonth && filterYear) {
                    if (dateHiredObj.getFullYear() !== filterYear) {
                        return false;
                    }
                }

                // Apply employment status filter if it exists
                if (selectedStatus && employeeStatus !== selectedStatus) {
                    return false;
                }

                // Apply department filter if it exists
                if (selectedDepartment && department !== selectedDepartment) {
                    return false;
                }

                // Apply rank filter if it exists
                if (selectedRank && rank.trim() !== selectedRank) {
                    return false;
                }
            }
            return true;
        }
    );

    // Handle leave balance modal
    $('#additionalDetailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);

        // Get data from button
        var employeeName = button.data('employee-name');
        var employeeId = button.data('employee-id');
        var position = button.data('position');
        var sickLeave = button.data('sick-leave');
        var vacationLeave = button.data('vacation-leave');
        var emergencyLeave = button.data('emergency-leave');

        // Update modal content
        modal.find('#employeeName').text(employeeName);
        modal.find('#employeeDetails').text(employeeId + ' - ' + position);

        // Update leave balances
        modal.find('.sick-leave-hours').text(Number(sickLeave).toFixed(2) + ' Hours');
        modal.find('.sick-leave-days').text('Equivalent to ' + (Number(sickLeave) / 24).toFixed(2) + ' Days');

        modal.find('.vacation-leave-hours').text(Number(vacationLeave).toFixed(2) + ' Hours');
        modal.find('.vacation-leave-days').text('Equivalent to ' + (Number(vacationLeave) / 24).toFixed(2) + ' Days');

        modal.find('.emergency-leave-hours').text(Number(emergencyLeave).toFixed(2) + ' Hours');
        modal.find('.emergency-leave-days').text('Equivalent to ' + (Number(emergencyLeave) / 24).toFixed(2) + ' Days');
    });

    // Handle bulk user creation confirmation
    $(document).on('click', '.create-bulk-users-btn', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Create User Accounts',
            text: 'Are you sure you want to create user accounts for all active employees?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, create them!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

    </script>
@endsection
