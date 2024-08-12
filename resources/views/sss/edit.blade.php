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
                        <h3 class="card-title">Edit SSS Contribution</h3>
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

                        <form action="{{ route('sss.update', $sss->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id">Employee<span class="text-danger">*</span></label>
                                        <select id="employee_id" name="employee_id" class="form-control" required readonly>
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" data-sss-no="{{ $employee->sss_no }}" {{ $employee->id == $sss->employee_id ? 'selected' : '' }}>
                                                    {{ $employee->company_id }}  {{ $employee->last_name }}  {{ $employee->first_name }}, {{ $employee->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_sss_id">Employee sss No.<span class="text-danger">*</span></label>
                                        <input type="text" id="employee_sss_id" name="employee_sss_id" class="form-control" readonly required value="{{ $sss->employee_sss_id }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date Contributed<span class="text-danger">*</span></label>
                                        <input type="date" id="date" name="date" class="form-control" required value="{{ $sss->date }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sss_contribution">Amount Contributed<span class="text-danger">*</span></label>
                                        <input type="number" id="sss_contribution" name="sss_contribution" class="form-control" step="0.01" required value="{{ $sss->sss_contribution }}">
                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>&nbsp;&nbsp;
                                        <a href="{{ route('sss.index') }}" class="btn btn-info">Back</a>
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

@section('js')
<script>
    $(document).ready(function() {
        $('#employee_id').change(function() {
            var sssNo = $(this).find(':selected').data('sss-no');
            if (sssNo) {
                $('#employee_sss_id').val(sssNo);
            } else {
                $('#employee_sss_id').val('');
            }
        });
    });
</script>
@stop
