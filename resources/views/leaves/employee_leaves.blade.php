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
