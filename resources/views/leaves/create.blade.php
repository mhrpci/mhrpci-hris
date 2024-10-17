@extends('layouts.app')

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
                        <h3 class="card-title">Create New Leave</h3>
                        @elseif(Auth::user()->hasRole('Employee'))
                        <h3 class="card-title">Apply New Leave</h3>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
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

                        <form action="{{ route('leaves.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
                                        <div class="form-group">
                                            <label for="employee_id">Employee</label>
                                            <select id="employee_id" name="employee_id" class="form-control" required>
                                                <option value="">Select Employee</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="employee_id">Employee:</label>
                                            <select name="employee_id" id="employee_id" class="form-control">
                                                @foreach($employees->where('first_name', Auth::user()->first_name) as $employee)
                                                    <option value="{{ $employee->id }}" selected>{{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="leave_type">Leave Type<span class="text-danger">*</span></label>
                                        <select id="leave_type" name="leave_type" class="form-control" required onchange="toggleDateInputs()">
                                            <option value="">Select Leave Type</option>
                                            <option value="Leave">Leave</option>
                                            <option value="Undertime">Undertime</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_from">Date From<span class="text-danger">*</span></label>
                                        <input type="datetime-local" id="date_from" name="date_from" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_to">Date To<span class="text-danger">*</span></label>
                                        <input type="datetime-local" id="date_to" name="date_to" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="typeLabel" for="type_id">Type of Leave<span class="text-danger">*</span></label>
                                        <select id="type_id" name="type_id" class="form-control" required>
                                            <option value="">Select Type of Leave</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reason_to_leave">Reason<span class="text-danger">*</span></label>
                                        <textarea id="reason_to_leave" name="reason_to_leave" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                         {{-- <!-- Add the following after the "Reason" textarea -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_status">Payment Status</label>
                                        <div class="form-check">
                                            <input type="checkbox" id="payment_status" class="form-check-input" disabled>
                                            <label class="form-check-label" for="payment_status" id="payment_status_label">With Pay</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                    @if(Auth::user()->hasRole('Employee'))
                                        <button type="submit" class="btn btn-primary">Apply</button>&nbsp;&nbsp;
                                    @else
                                        <button type="submit" class="btn btn-primary">Create</button>&nbsp;&nbsp;
                                    @endif
                                        @can('super-admin')
                                        <a href="{{ route('leaves.index') }}" class="btn btn-info">Back</a>
                                        @endcan
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
        });
    </script>
@stop
<script>
    // document.getElementById('employee_id').addEventListener('change', function() {
    //     const employeeId = this.value;
    //     const paymentStatusCheckbox = document.getElementById('payment_status');
    //     const paymentStatusLabel = document.getElementById('payment_status_label');

    //     if (employeeId) {
    //         fetch(`/employees/${employeeId}/status`)
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.employment_status === 'REGULAR') {
    //                     paymentStatusCheckbox.checked = true;
    //                     paymentStatusLabel.innerText = 'With Pay';
    //                 } else {
    //                     paymentStatusCheckbox.checked = false;
    //                     paymentStatusLabel.innerText = 'Without Pay';
    //                 }
    //             })
    //             .catch(error => console.error('Error fetching employee status:', error));
    //     } else {
    //         paymentStatusCheckbox.checked = false;
    //         paymentStatusLabel.innerText = '';
    //     }
    // });

    function toggleDateInputs() {
        const leaveType = document.getElementById('leave_type').value;
        const dateFrom = document.getElementById('date_from');
        const dateTo = document.getElementById('date_to');
        const typeLabel = document.getElementById('typeLabel');

        if (leaveType === 'Leave') {
            dateFrom.type = 'date';
            dateTo.type = 'date';
            typeLabel.innerHTML = 'Type of Leave<span class="text-danger">*</span>'; // Reset label with asterisk
        } else if (leaveType === 'Undertime') {
            dateFrom.type = 'datetime-local';
            dateTo.type = 'datetime-local';
            typeLabel.innerHTML = 'Undertime deducted to<span class="text-danger">*</span>'; // Change label to Undertime with asterisk
        } else {
            dateFrom.type = 'datetime-local';
            dateTo.type = 'datetime-local';
            typeLabel.innerHTML = 'Type of Leave<span class="text-danger">*</span>'; // Reset label with asterisk when no selection
        }
    }
</script>

@endsection
