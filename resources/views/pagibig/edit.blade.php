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
                        <h3 class="card-title">Edit PAGIBIG Contribution</h3>
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

                        <form action="{{ route('pagibig.update', $pagibig->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id">Employee<span class="text-danger">*</span></label>
                                        <select id="employee_id" name="employee_id" class="form-control" required readonly>
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" data-pagibig-no="{{ $employee->pagibig_no }}" {{ $employee->id == $pagibig->employee_id ? 'selected' : '' }}>
                                                    {{ $employee->company_id }}  {{ $employee->last_name }}  {{ $employee->first_name }}, {{ $employee->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_pagibig_id">Employee pagibig No.<span class="text-danger">*</span></label>
                                        <input type="text" id="employee_pagibig_id" name="employee_pagibig_id" class="form-control" readonly required value="{{ $pagibig->employee_pagibig_id }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Date Contributed<span class="text-danger">*</span></label>
                                        <input type="date" id="date" name="date" class="form-control" required value="{{ $pagibig->date }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pagibig_contribution">Amount Contributed<span class="text-danger">*</span></label>
                                        <input type="number" id="pagibig_contribution" name="pagibig_contribution" class="form-control" step="0.01" required value="{{ $pagibig->pagibig_contribution }}">
                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>&nbsp;&nbsp;
                                        <a href="{{ route('pagibig.index') }}" class="btn btn-info">Back</a>
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
            var pagibigNo = $(this).find(':selected').data('pagibig-no');
            if (pagibigNo) {
                $('#employee_pagibig_id').val(pagibigNo);
            } else {
                $('#employee_pagibig_id').val('');
            }
        });
    });
</script>
@stop
