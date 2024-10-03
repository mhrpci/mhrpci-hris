@extends('layouts.app')

@section('content')
<br>
    <div class="container-fluid">
    <!-- Enhanced professional-looking link buttons -->
    <div class="mb-4">
        <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
            <a href="{{ route('payroll.index') }}" class="contribution-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}">
                <div class="icon-wrapper">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="text-wrapper">
                    <span class="title">Payroll</span>
                    <small class="description">Payroll List</small>
                </div>
            </a>
            @can('payroll-create')
            <a href="{{ route('payroll.create') }}" class="contribution-link {{ request()->routeIs('payroll.create') ? 'active' : '' }}">
                <div class="icon-wrapper">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="text-wrapper">
                    <span class="title">Create Payroll</span>
                    <small class="description">Generate Payroll</small>
                </div>
            </a>
            @endcan
            <a href="{{ route('overtime.index') }}" class="contribution-link {{ request()->routeIs('overtime.index') ? 'active' : '' }}">
                <div class="icon-wrapper">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="text-wrapper">
                    <span class="title">Overtime</span>
                    <small class="description">Employee overtime records</small>
                </div>
            </a>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Payroll</h3>
                    </div>
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

                        <form action="{{ route('payroll.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id">Employee<span class="text-danger">*</span></label>
                                        <select id="employee_id" name="employee_id" class="form-control" required>
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->company_id }}  {{ $employee->last_name }}  {{ $employee->first_name }}, {{ $employee->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date<span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">End Date<span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button type="submit" class="btn btn-primary">Generate Payroll</button>&nbsp;&nbsp;
                                        <a href="{{ route('payroll.index') }}" class="btn btn-info">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('select').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            // Automatically set the end date based on start date selection
            $('#start_date').change(function() {
                var startDate = new Date($(this).val());
                var endDate = new Date(startDate);

                if (startDate.getDate() >= 11 && startDate.getDate() <= 25) {
                    // Set end date to 25th of the same month
                    endDate.setDate(25);
                } else if (startDate.getDate() >= 26 || startDate.getDate() <= 10) {
                    // Set end date to 10th of the next month
                    if (startDate.getDate() >= 26) {
                        endDate.setMonth(startDate.getMonth() + 1);
                    }
                    endDate.setDate(10);
                }

                // Format the end date to YYYY-MM-DD and set the value
                var formattedEndDate = endDate.toISOString().split('T')[0];
                $('#end_date').val(formattedEndDate);
            });
        });
    </script>
@stop
