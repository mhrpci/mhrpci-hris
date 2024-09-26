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
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h3 class="card-title text-break">
                        @if(Auth::user()->hasRole('Employee'))
                        My Timesheet
                        @else
                        Employee Timesheet
                        @endif
                         - {{ $employee->company_id }} - {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name?? ' ' }} {{ $employee->suffix ?? ' ' }}</h3>
                    </div>
                    <div class="col-md-6 col-12 text-md-right text-center">
                        <button class="btn btn-primary mb-2" onclick="printAttendance()"><i class="fas fa-print"></i> Print</button>
                        @if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                        <a href="{{ route('attendances.timesheets') }}" class="btn btn-secondary mb-2">Back</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Date range filter form -->
                <form id="date-range-form" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="attendanceTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date Attended</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Remarks</th>
                                <th>Hours Worked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td data-sort="{{ date('Y-m-d', strtotime($attendance->date_attended)) }}">
                                        {{ date('F d, Y', strtotime($attendance->date_attended)) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->time_in)->format('h:i A') }}</td>
                                    <td>{{ $attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('h:i A') : '--:-- --' }}</td>
                                    <td>{{ $attendance->remarks }}</td>
                                    <td>{{ $attendance->hours_worked }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
function printAttendance() {
    var printWindow = window.open('', '', 'height=600,width=800');

    // Get the table's visible data
    var table = $('#attendanceTable').DataTable();
    var visibleRows = table.rows({ search: 'applied' }).nodes();

    // Create an array to hold the rows for sorting
    var rowsArray = Array.from(visibleRows).map(row => {
        var cells = row.querySelectorAll('td');
        return {
            date: new Date(cells[0].innerText),
            timeIn: cells[1].innerText,
            timeOut: cells[2].innerText,
            remarks: cells[3].innerText,
            hoursWorked: cells[4].innerText
        };
    });

    // Sort the rows by date in ascending order
    rowsArray.sort((a, b) => a.date - b.date);

    // Get the current date and time for the footer
    var currentDateTime = new Date().toLocaleString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });

    // Create the print content
    var printContent = `
        <html>
            <head>
                <title>Print</title>
                <style>
                    @media print {
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                        }
                        .header {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            text-align: center;
                            background: url('{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}') no-repeat center center;
                            background-size: contain;
                            height: 100px; /* Adjust height according to your logo */
                            border-bottom: 1px solid #ddd;
                            padding: 10px 0;
                        }
                        .page-break {
                            page-break-before: always;
                        }
                        .print-content {
                            margin-top: 120px; /* Space for the header */
                            padding: 20px;
                            background: white;
                            border-radius: 8px;
                            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                        }
                        th {
                            background-color: #f4f4f4;
                        }
                        h3 {
                            margin-bottom: 20px;
                        }
                        .footer {
                            position: fixed;
                            bottom: 0;
                            width: 100%;
                            text-align: center;
                            font-size: 12px;
                            color: #333;
                        }
                        /* Hide the header on pages after the first one */
                        @page {
                            margin: 0;
                        }
                        @page :first {
                            margin: 0;
                        }
                        @page :left {
                            margin-top: 0;
                        }
                        @page :right {
                            margin-top: 0;
                        }
                        .no-logo {
                            display: none;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="header"></div>
                <div class="page-break"></div> <!-- This forces a page break after the header -->
                <div class="print-content">
                    <h3>
                        @if(Auth::user()->hasRole('Employee'))
                            My Timesheet
                        @else
                            Employee Timesheet
                        @endif
                         - {{ $employee->company_id }} - {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }}
                    </h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Date Attended</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Remarks</th>
                                <th>Hours Worked</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${rowsArray.map(row => `
                                <tr>
                                    <td>${row.date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                                    <td>${row.timeIn}</td>
                                    <td>${row.timeOut}</td>
                                    <td>${row.remarks}</td>
                                    <td>${row.hoursWorked}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    Printed on ${currentDateTime}
                </div>
            </body>
        </html>
    `;

    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}

</script>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        var table = $('#attendanceTable').DataTable({
            "order": [[0, "desc"]], // Sort by date column (index 0) in descending order
            "columnDefs": [
                {
                    "targets": 0, // Target the date column (index 0)
                    "render": function(data, type, row) {
                        // Convert the date to YYYY-MM-DD format for sorting and filtering
                        var date = new Date(data);
                        return date.getFullYear() + '-' +
                               ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                               ('0' + date.getDate()).slice(-2);
                    }
                }
            ]
        });

        // Date range filter
        $('#date-range-form').on('submit', function(e) {
            e.preventDefault();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            // Custom filtering function
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var date = data[0]; // Use index 0 for the date column (now in YYYY-MM-DD format)

                if (
                    (startDate === "" && endDate === "") ||
                    (startDate === "" && date <= endDate) ||
                    (startDate <= date && endDate === "") ||
                    (startDate <= date && date <= endDate)
                ) {
                    return true;
                }
                return false;
            });

            table.draw(); // Redraw the table with the filter applied

            // Clear the custom filter
            $.fn.dataTable.ext.search.pop();
        });
    });
</script>
@endsection
