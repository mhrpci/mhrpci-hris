@extends('layouts.app')

@section('content')
<br>
    <div class="container my-4">
        <h1 class="mb-4">{{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name ?? ' ' }} {{ $employee->suffix ?? ' ' }}'s Leaves</h1>
        <a href="{{ route('leaves.all_employees') }}" class="btn btn-sm btn-primary mb-3">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="employee-leaves-table">
                <thead class="thead-dark">
                    <tr>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Type</th>
                        <th>Status</th>
                        {{-- <th>Action</th> --}}
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
                                    <i class="fas fa-check-circle"></i>
                                </span> Approved
                            @elseif ($leave->status == 'rejected')
                                <span class="text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </span> Rejected
                            @else
                                <span class="text-warning">
                                    <i class="fas fa-hourglass-half"></i>
                                </span> Pending
                            @endif
                        </td>
                        {{-- <td>
                            <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this leave request?')">Delete</button>
                            </form>
                        </td> --}}
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
            $('#employee-leaves-table').DataTable({
                responsive: true,
                "pagingType": "simple_numbers",
                "language": {
                    "emptyTable": "No leave requests available"
                }
            });
        });
    </script>
@endsection
