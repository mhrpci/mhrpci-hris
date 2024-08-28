@extends('adminlte::page')

@section('title', 'Payroll Management')

@section('content_header')
    <h1 class="m-0 text-dark">Payroll Management</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payroll Records</h3>
                    <div class="card-tools">
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Generate New Payroll
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="payrolls-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Gross Pay</th>
                                <th>Net Pay</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $payroll)
                                <tr>
                                    <td>{{ $payroll->id }}</td>
                                    <td>{{ $payroll->employee->first_name }}</td>
                                    <td>{{ $payroll->start_date->format('M d, Y') }}</td>
                                    <td>{{ $payroll->end_date->format('M d, Y') }}</td>
                                    <td>{{ number_format($payroll->gross_pay, 2) }}</td>
                                    <td>{{ number_format($payroll->net_pay, 2) }}</td>
                                    <td>
                                        <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payroll record?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#payrolls-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
