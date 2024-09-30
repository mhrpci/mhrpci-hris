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
        <!-- Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Employees</h3>
            </div>
            <div class="card-body">
                <!-- Department Filter Dropdown -->
                <div class="row mb-3">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="departmentFilter">Filter by Department:</label>
                            <select id="departmentFilter" class="form-control">
                                <option value="">All Departments</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->name }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="employees-table">
                        <thead>
                            <tr>
                                <th>Company ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->company_id }}</td>
                                <td>{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name ?: ' ' }} {{ $employee->suffix ?: ' ' }}</td>
                                <td>{{ $employee->department->name }}</td> <!-- Assuming you have a relationship set up in the Employee model -->
                                <td>
                                    <a href="{{ route('leaves.employee_leaves', $employee->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View Leaves</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Card Body -->
        </div>
        <!-- End of Card -->
    </div>

    @section('js')
    <script>
        $(document).ready(function() {
            var table = $('#employees-table').DataTable();

            $('#departmentFilter').on('change', function() {
                var selectedDepartment = $(this).val();
                console.log("Selected Department: ", selectedDepartment); // Debugging log
                if (selectedDepartment) {
                    table.column(2).search('^' + selectedDepartment + '$', true, false).draw();
                } else {
                    table.column(2).search('').draw();
                }
            });
        });
    </script>
    @endsection
@endsection
