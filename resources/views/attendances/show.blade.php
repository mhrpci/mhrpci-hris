@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance Details</h3>
                </div>
                <!-- /.card-header -->
                @php
                    use Carbon\Carbon;
                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <p class="font-weight-bold">{{ $attendance->employee->company_id }} {{ $attendance->employee->last_name }} {{ $attendance->employee->first_name }}, {{ $attendnace->employee->middle_name?? ' ' }} {{ $attendance->employee->suffix ?? ' ' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="date_attended">Date:</label>
                                <p class="font-weight-bold">{{ Carbon::parse($attendance->date_attended)->format('F j, Y') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="time_in">Time In:</label>
                                <p class="font-weight-bold">{{ $attendance->time_in ? date('h:i A', strtotime($attendance->time_in)) : '--:-- --' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="time_out">Time Out:</label>
                                <p class="font-weight-bold">{{ $attendance->time_out ? date('h:i A', strtotime($attendance->time_out)) : '--:-- --' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="remarks">Remarks:</label>
                                <p class="font-weight-bold">{{ $attendance->remarks }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="hours_worked">Working Hour:</label>
                                <p class="font-weight-bold">{{ $attendance->hours_worked }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="time_stamp1">Time Stamp (In):</label><br>
                                <img src="{{ asset('storage/' . $attendance->time_stamp1) }}" alt="Time Stamp In" style="width:5em; height:8em;" class="img-thumbnail" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('storage/' . $attendance->time_stamp1) }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="time_stamp2">Time Stamp (Out):</label><br>
                                <img src="{{ asset('storage/' . $attendance->time_stamp2) }}" alt="Time Stamp Out" style="width:5em; height:8em;" class="img-thumbnail" data-toggle="modal" data-target="#imageModal" data-image="{{ asset('storage/' . $attendance->time_stamp2) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('attendances.index') }}" class="btn btn-info">Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Time Stamp</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" alt="Time Stamp" id="modalImage" class="img-fluid">
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var imageSrc = button.data('image'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body img').attr('src', imageSrc);
    });
</script>
@endsection
