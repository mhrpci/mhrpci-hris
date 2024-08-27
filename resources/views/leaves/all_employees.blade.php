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
</style>
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
