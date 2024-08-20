@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
<div class="container">
    <h1>Employee Timesheet</h1>
    
    <!-- Filter and Search Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filter and Search</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <label for="filter">Filter by Department:</label>
                    <select id="filter" class="form-control">
                        <option value="all">All Employees</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="search">Search Employee:</label>
                    <input type="text" id="search" class="form-control" placeholder="Enter company ID, last name, or first name">
                </div>
            </div>
        </div>
    </div>

    <!-- List of Employees Card -->
    <div class="card">
        <ul class="list-group list-group-flush" id="employee-list">
            @foreach ($employees as $employee)
                <li class="list-group-item" data-department-id="{{ $employee->department_id }}" data-employee-name="{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}" data-company-id="{{ $employee->company_id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{ $employee->company_id }}-{{ $employee->last_name }}, {{ $employee->first_name }} {{ $employee->middle_name }}
                        </div>
                        @if (count($timesheets[$employee->id]) > 0)
                        <a href="{{ route('employee.attendance', ['employee_id' => $employee->id]) }}" class="btn btn-primary float-right toggle-attendance" data-employee-id="{{ $employee->id }}"><i class="fas fa-file-alt"></i> Timesheet</a>
                        @else
                         <p>No record</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        <div id="no-employees" class="text-center p-4" style="display: none;">
            No employees found.
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function filterAndSearch() {
            var departmentId = $('#filter').val();
            var searchQuery = $('#search').val().toLowerCase();
            var anyVisible = false;

            console.log('Department ID:', departmentId); // Debugging log
            console.log('Search Query:', searchQuery); // Debugging log

            $('#employee-list .list-group-item').each(function() {
                var employeeName = $(this).data('employee-name').toLowerCase();
                var companyId = $(this).data('company-id').toString().toLowerCase();
                var itemDepartmentId = $(this).data('department-id').toString();

                console.log('Employee:', employeeName, companyId, itemDepartmentId); // Debugging log
                
                var matchesSearch = employeeName.includes(searchQuery) || companyId.includes(searchQuery);
                var matchesDepartment = (departmentId === 'all') || (departmentId === itemDepartmentId);

                if (matchesSearch && matchesDepartment) {
                    $(this).show();
                    anyVisible = true;
                } else {
                    $(this).hide();
                }
            });

            if (anyVisible) {
                $('#no-employees').hide();
            } else {
                $('#no-employees').show();
            }
        }

        $('#filter').change(filterAndSearch);
        $('#search').on('keyup', filterAndSearch);

        filterAndSearch();
    });
</script>
@endsection
