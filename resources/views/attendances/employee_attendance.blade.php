@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <h3 class="text-break">Employee Time Sheet - {{ $employee->company_id }} - {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }}</h3>
            </div>
            <div class="col-md-6 col-12 text-md-right text-center">
                <button class="btn btn-primary mb-2" onclick="printAttendance()"><i class="fas fa-print"></i> Print</button>
                @if(Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                <a href="{{ route('attendances.timesheets') }}" class="btn btn-secondary mb-2">Back</a>
                @endif
            </div>
        </div>

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
                            <td>{{ \Carbon\Carbon::parse($attendance->date_attended)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->time_in)->format('h:i A') }}</td>
                            <td>{{ $attendance->time_out ? date('h:i A', strtotime($attendance->time_out)) : '--:-- --' }}</td>
                            <td>{{ $attendance->remarks }}</td>
                            <td>{{ $attendance->hours_worked }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        function printAttendance() {
            // Hide elements you don't want to print
            $('.container-fluid .row').hide();
            // Trigger the browser's print functionality
            window.print(); 
            // Show the hidden elements after printing
            $('.container-fluid .row').show();
        }
    </script>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#attendanceTable').DataTable();
    });
</script>
@endsection
