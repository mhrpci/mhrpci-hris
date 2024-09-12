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
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">My Leave Sheet</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Employee Details</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $employee->last_name }} {{ $employee->last_name }}, {{ $employee->middle_name ?? ' ' }} {{ $employee->suffix ?? ' ' }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $employee->email_address }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Leave Balances</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Sick Leave:</th>
                                    <td>{{ $sickLeaveBalance }}</td>
                                </tr>
                                <tr>
                                    <th>Emergency Leave:</th>
                                    <td>{{ $emergencyLeaveBalance }}</td>
                                </tr>
                                <tr>
                                    <th>Vacation Leave:</th>
                                    <td>{{ $vacationLeaveBalance }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h4 class="mt-4">Leave Records</h4>
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
                        <!-- Removed status filter -->
                    </div>
                    <table id="leaveTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Date From</th>
                                <th>Date To</th>
                                <th>Reason</th>
                                <th>Status</th>
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
                                    <span class="badge badge-{{ $leave->status == 'Approved' ? 'success' : ($leave->status == 'Pending' ? 'warning' : 'danger') }}">
                                        {{ $leave->status }}
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
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
    .card-header { border-radius: 0; }
    .badge { font-size: 0.9em; }
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