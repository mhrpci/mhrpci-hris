@extends('layouts.app')

@section('content')
    <br>
    <div class="toast-container position-fixed p-3" style="z-index: 9999; right: 0; bottom: 0;">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header bg-primary text-white">
                <strong class="mr-auto">Notification</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body bg-light text-dark">
                Filter applied successfully!
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                            <h3 class="card-title mb-2 mb-md-0">Employee Management</h3>
                            <div class="card-tools d-flex flex-wrap justify-content-center justify-content-md-end">
                                @can('employee-create')
                                <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm rounded-pill m-1">
                                    <i class="fas fa-plus-circle"></i> <span class="d-none d-sm-inline">Add Employee</span>
                                </a>
                                @endcan
                                @if(Auth::user()->hasRole(['Super Admin', 'Admin']))
                                <button class="btn btn-primary btn-sm rounded-pill m-1" data-toggle="modal" data-target="#importModal">
                                    <i class="fas fa-file-import"></i> <span class="d-none d-sm-inline">Import</span>
                                </button>
                                <form action="{{ route('employees.export') }}" method="POST" target="_blank" class="m-1">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm rounded-pill">
                                        <i class="fas fa-file-export"></i> <span class="d-none d-sm-inline">Export</span>
                                    </button>
                                </form>
                                @endif
                                <div class="dropdown m-1">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown">
                                        <i class="fas fa-filter"></i> <span class="d-none d-sm-inline">Filter</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterDropdown">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#monthModal">Month</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#yearModal">Year</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusModal">Status</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#departmentModal">Department</a>
                                        @if(auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'Finance']))
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rankModal">Rank</a>
                                        @endif
                                    </div>
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

                        <div class="table-responsive">
                            <table id="employees-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">ID</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">Dept</th>
                                        <th class="text-nowrap">Position</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Rank</th>
                                        <th class="text-nowrap">Joined</th>
                                        <th class="text-nowrap">Action</th>
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
                                                        <a class="dropdown-item" href="{{ route('employees.show', $employee->slug) }}">
                                                            <i class="fas fa-eye"></i>&nbsp;Preview
                                                        </a>

                                                        @if($employee->employee_status !== 'Resigned')
                                                        @can('employee-edit')
                                                        <a class="dropdown-item" href="{{ route('employees.edit', $employee->slug) }}">
                                                            <i class="fas fa-edit"></i>&nbsp;Edit
                                                        </a>
                                                    @endcan
                                                    @can('user-create')
                                                    <form action="{{ route('employees.createUser', $employee->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to create a user for this employee?')"><i class="fas fa-user-plus"></i>&nbsp;Create User</button>
                                                    </form>
                                                    @elsecan('hrcompliance')
                                                        <form action="{{ route('employees.createUser', $employee->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to create a user for this employee?')"><i class="fas fa-user-plus"></i>&nbsp;Create User</button>
                                                        </form>
                                                    @endcan
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#additionalDetailsModal"><i class="fas fa-balance-scale"></i>&nbsp;Leave Balance</a>
                                                            @canany(['super-admin', 'admin'])
                                                                <form action="{{ route('employees.disable', $employee->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure that this employee is resigned?')"><i class="fas fa-sign-out-alt"></i>&nbsp;Resigned</button>
                                                                </form>
                                                            @endcanany
                                                        @endif
                                                        @can('super-admin')
                                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                        </form>
                                                    @endcan
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
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
    <script>
       $(document).ready(function () {
    let table = $('#employees-table').DataTable({
        responsive: true,
        columnDefs: [
            {
                targets: 6,
                type: 'date'
            }
        ],
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Employee Details: ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        scrollX: true
    });

    $(window).resize(function() {
        table.columns.adjust().responsive.recalc();
    });

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

    // Function to show toast notification
    function showToast(message) {
        $('#toast .toast-body').text(message);
        $('#toast').toast({
            autohide: true,
            delay: 3000
        }).toast('show');
    }

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
    });

    </script>
@endsection

@section('css')
<style>
@media (max-width: 768px) {
    .card-tools {
        margin-top: 1rem;
        width: 100%;
    }

    .btn {
        margin: 0.2rem;
        white-space: nowrap;
    }

    .table-responsive {
        margin-bottom: 1rem;
        -webkit-overflow-scrolling: touch;
    }

    .modal-dialog {
        margin: 0.5rem;
    }

    .toast-container {
        width: 100%;
        padding: 0.5rem;
    }

    .dropdown-menu {
        width: 100%;
    }
}

/* Improve table readability on mobile */
.table td, .table th {
    padding: 0.5rem;
    white-space: nowrap;
}

/* Make modals more mobile-friendly */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
        padding: 0;
    }

    .modal-content {
        border-radius: 0;
    }

    .modal-body {
        padding: 1rem;
    }
}

/* Improve button spacing */
.btn-group-sm > .btn, .btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
}

/* Improve dropdown menu usability on mobile */
.dropdown-menu {
    font-size: 0.875rem;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}
</style>
@endsection
