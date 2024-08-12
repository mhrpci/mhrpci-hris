@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop


@section('content')
    <div class="container">
        <h1>All Employees</h1>

        <!-- Department Filter Dropdown -->
        <div class="row mb-3">
            <div class="col-6">
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
                    <td>{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name ?: 'N/A' }}</td>
                    <td>{{ $employee->department->name }}</td> <!-- Assuming you have a relationship set up in the Employee model -->
                    <td>
                        <a href="{{ route('leaves.employee_leaves', $employee->id) }}" class="btn btn-sm btn-primary">View Leaves</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
