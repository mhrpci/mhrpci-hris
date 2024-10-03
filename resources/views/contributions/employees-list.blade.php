@extends('layouts.app')

@section('content')
<br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contribution Employee List</h3>
        </div>
        <div class="card-body">
            <table id="employeeTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->company_id }} </td>
                            <td>{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle ?? ' ' }} {{ $employee->suffix ?? ' ' }}</td>
                            <td>
                                <a href="{{ route('contributions.employee', ['employee_id' => $employee->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-coins"></i> Contributions
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#employeeTable').DataTable();
        });
    </script>
@endsection
