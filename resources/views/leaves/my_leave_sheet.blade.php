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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Leave Sheet</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="min-date">From:</label>
                            <input type="date" id="min-date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="max-date">To:</label>
                            <input type="date" id="max-date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="leave-type">Leave Type:</label>
                            <select id="leave-type" class="form-control">
                                <option value="">All</option>
                                <option value="Sick Leave">Sick</option>
                                <option value="Emergency Leave">Emergency</option>
                                <option value="Vacation Leave">Vacation</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="leaveTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th> <!-- Added Action column -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                <tr>
                                    <td>{{ $leave->type->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('F j, Y h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('F j, Y h:i A') }}</td>
                                    <td>{{ $leave->reason_to_leave }}</td>
                                    <td>
                                        @if($leave->status == 'approved')
                                            <span class="text-success"><i class="fas fa-check-circle"></i> </span>Approved
                                        @elseif($leave->status == 'rejected')
                                            <span class="text-danger"><i class="fas fa-times-circle"></i> </span>Rejected
                                        @else
                                            <span class="text-secondary"><i class="fas fa-clock"></i> </span>Pending
                                        @endif
                                    </td>
                                    <td>
                                        @if($leave->is_view)
                                            <span class="text-white badge badge-success">Viewed</span> <!-- Updated design for viewed -->
                                        @else
                                            <a href="{{ route('leaves.myLeaveDetail', $leave->id) }}" class="btn btn-info btn-sm">Preview</a> <!-- Original button -->
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    .card-header { border-radius: 0; }
    .badge { font-size: 0.9em; }
    .form-control, .table { margin-bottom: 1rem; }
</style>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#leaveTable').DataTable({
        "responsive": true,
        "language": {
            "search": "Quick search:",
            "lengthMenu": "Show _MENU_ entries per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries"
        }
    });

    // Custom filtering function
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min-date').val();
            var max = $('#max-date').val();
            var type = $('#leave-type').val();
            var dateFrom = new Date(data[1]).getTime(); // use data for the date from column
            var leaveType = data[0];

            // Date range filter
            if (min && dateFrom < new Date(min).getTime()) {
                return false;
            }
            if (max && dateFrom > new Date(max).getTime()) {
                return false;
            }

            // Leave type filter
            if (type && leaveType !== type) {
                return false;
            }

            return true;
        }
    );

    // Event listener to the filtering inputs to redraw on input
    $('#min-date, #max-date, #leave-type').change(function() {
        table.draw();
    });
});
</script>
@endsection
