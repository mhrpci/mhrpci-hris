<!-- employee_leaves.blade.php -->

@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop


@section('content')
    <div class="container">
        <h1>{{ $employee->company_id }}'s Leaves</h1>
        <table class="table table-bordered" id="employee-leaves-table">
            <thead>
                <tr>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y g:iA') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y g:iA') }}</td>
                    <td>{{ $leave->type->name }}</td>
                    <td>
                        @if ($leave->status == 'approved')
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i> Approved
                            </span>
                        @elseif ($leave->status == 'rejected')
                            <span class="text-danger">
                                <i class="fas fa-times-circle"></i> Rejected
                            </span>
                        @else
                            <span class="text-warning">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#employee-leaves-table').DataTable();
        });
    </script>
@endsection