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
                    <h3 class="card-title">Edit Attendance</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee</label>
                                    <select id="employee_id" name="employee_id" class="form-control" required>
                                        <option value="">Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ $employee->id == $attendance->employee_id ? 'selected' : '' }}>
                                                {{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_attended">Date</label>
                                    <input type="date" id="date_attended" name="date_attended" class="form-control" value="{{ $attendance->date_attended }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_in">Time In</label>
                                    <input type="time" id="time_in" name="time_in" class="form-control" value="{{ $attendance->time_in }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_out">Time Out</label>
                                    <input type="time" id="time_out" name="time_out" class="form-control" value="{{ $attendance->time_out }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time_stamp1">Time Stamp (In)</label>
                                        <input type="file" id="time_stamp1" name="time_stamp1"  value="{{ $attendance->time_stamp1 }}" class="form-control">
                                    </div>
                                </div>
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="time_stamp2">Time Stamp (Out)</label>
                                        <input type="file" id="time_stamp2" name="time_stamp2"  value="{{ $attendance->time_stamp2 }}" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <select id="remarks" name="remarks" class="form-control" required>
                                        @foreach($remarks as $key => $value)
                                            <option value="{{ $value }}" {{ $attendance->remarks == $value ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group" role="group" aria-label="Button group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>&nbsp;&nbsp;
                                    <a href="{{ route('attendances.index') }}" class="btn btn-info">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
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
@endsection
