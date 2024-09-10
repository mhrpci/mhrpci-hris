@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
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

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
.toast-container {
    z-index: 1050;
    position: fixed;
    bottom: 1rem;
    right: 1rem;
}

.toast {
    background-color: #226304;
    color: white;
}
.status-active {
    color: rgb(255, 255, 255);
    border: 1px solid green;
    background-color: green;
    padding: 2px 4px;
    border-radius: 5px;
}

.status-inactive {
    color: rgb(255, 255, 255);
    border: 1px solid red;
    background-color: red;
    padding: 2px 4px;
    border-radius: 5px;
}

</style>
@stop
@section('content')
    <br>
    <div class="toast-container position-fixed bottom-0 right-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <strong class="mr-auto">Notification</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Filter applied successfully!
            </div>
        </div>
    </div>

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
                            <div class="dropdown mr-2 mb-2">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter<i class="fas fa-filter"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#monthModal">Month</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#yearModal">Year</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusModal">Status</a>
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
                                    <th>Position</th>
                                    <th>Employment Status</th>
                                    <th>Joined Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->company_id }}</td>
                                        <td>{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }} {{ $employee->suffix }}</td>
                                        <td>{{ $employee->position->name }}</td>
                                        <td align="center" style="color: {{ $employee->employee_status === 'Active' ? 'green' : 'red' }}; font-weight: bold;">
                                            {{ $employee->employee_status }}
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
                                                    @endcan
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#additionalDetailsModal"><i class="fas fa-balance-scale"></i>&nbsp;Leave Balance</a>
                                                        @can('employee-edit')
                                                            <form action="{{ route('employees.disable', $employee->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure that this employee is resigned?')"><i class="fas fa-sign-out-alt"></i>&nbsp;Resigned</button>
                                                            </form>
                                                        @endcan
                                                    @endif
                                                    @can('employee-delete')
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

@endsection

@section('js')
    <script>
       $(document).ready(function () {
    let table = $('#employees-table').DataTable({
        columnDefs: [
            {
                targets: 4, // Targeting the "Date Hired" column
                type: 'date'
            }
        ]
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
        $('#toast').toast('show');
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

    // Custom filtering function
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            let dateHiredStr = data[4]; // Get the "Date Hired" value from the 5th column
            let employeeStatus = data[3];
            if (!dateHiredStr) return true; // If no date, include the row

            let dateHiredObj = new Date(dateHiredStr);

            // Get the month and year from the form inputs
            let selectedMonth = $('#month').val();
            let selectedYear = $('#year').val();
            let selectedStatus = $('#employee_status').val();

            // Convert selectedMonth to date object if it exists
            let filterMonth = selectedMonth ? new Date(selectedMonth) : null;
            let filterYear = selectedYear ? parseInt(selectedYear) : null;

            // Date and status filter logic
            if (filterMonth || filterYear || selectedStatus) {
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
            }
            return true;
        }
    );
});

    </script>
@endsection
