@extends('adminlte::page')

@section('title', 'Edit Employee')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Employee</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('employees.update', $employee->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-outline card-primary shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-user-edit mr-2"></i>Employee Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="company_id">Company ID</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id" value="{{ old('company_id', $employee->company_id) }}" required placeholder="Enter Company ID">
                                </div>
                                @error('company_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var companyIdInput = document.getElementById('company_id');

                                companyIdInput.addEventListener('input', function() {
                                    // Remove any non-alphanumeric characters
                                    var currentValue = this.value.replace(/[^a-zA-Z0-9]/g, '');

                                    // Ensure the first 3-5 characters are letters
                                    var letters = currentValue.substr(0, 5).replace(/[^a-zA-Z]/g, '').toUpperCase();
                                    var numbers = currentValue.substr(letters.length).replace(/\D/g, '');

                                    // Limit letters to 5 and numbers to 10 digits
                                    letters = letters.substr(0, 5);
                                    numbers = numbers.substr(0, 11);

                                    // Combine letters and numbers
                                    var formattedValue = letters + (numbers.length > 0 ? '-' + numbers : '');

                                    // Update the input value
                                    this.value = formattedValue;

                                    // Validate the input
                                    if (letters.length >= 3 && letters.length <= 5 && numbers.length >= 8 && numbers.length <= 11) {
                                        this.setCustomValidity('');
                                    } else {
                                        this.setCustomValidity('Company ID must have 3 to 5 letters followed by 8 to 11 digits');
                                    }
                                });
                            });
                        </script>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('profile') is-invalid @enderror" id="profile" name="profile" placeholder="Upload Profile Picture">
                                    <label class="custom-file-label" for="profile">Choose file</label>
                                </div>
                                @error('profile')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                @if($employee->profile)
                                <img src="{{ asset('storage/' . $employee->profile) }}" alt="Profile Image" class="profile-img img-fluid rounded-circle mb-3" style="height: 150px; width: 150px;">
                            @else
                                <p>No profile image available</p>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-info shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title"><i class="fas fa-user mr-2"></i>Personal Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required placeholder="Enter First Name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name', $employee->middle_name) }}" placeholder="Enter Middle Name">
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required placeholder="Enter Last Name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control @error('suffix') is-invalid @enderror" id="suffix" name="suffix" value="{{ old('suffix', $employee->suffix) }}" placeholder="Enter Suffix">
                                @error('suffix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control @error('email_address') is-invalid @enderror" id="email_address" name="email_address" value="{{ old('email_address', $employee->email_address) }}" required placeholder="Enter Email Address">
                                </div>
                                @error('email_address')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_no">Contact Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no', $employee->contact_no) }}" required placeholder="Enter Contact Number">
                                </div>
                                @error('contact_no')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <div class="input-group date" id="birth_date_picker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input @error('birth_date') is-invalid @enderror" data-target="#birth_date_picker" id="birth_date" name="birth_date" value="{{ old('birth_date', $employee->birth_date) }}" required placeholder="YYYY-MM-DD"/>
                                    <div class="input-group-append" data-target="#birth_date_picker" data-toggle="datetimepicker">
                                        <div class="input-group-text bg-info text-white"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('birth_date')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender_id">Gender</label>
                                <select class="form-control select2 @error('gender_id') is-invalid @enderror" id="gender_id" name="gender_id" required>
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}" {{ old('gender_id', $employee->gender_id) == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-success shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title"><i class="fas fa-map-marker-alt mr-2"></i>Address Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province_id">Province</label>
                                <select class="form-control select2 @error('province_id') is-invalid @enderror" id="province_id" name="province_id" required disabled>
                                    <option value="">Select Province</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" {{ old('province_id', $employee->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city_id">City</label>
                                <select class="form-control select2 @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required disabled>
                                    <option value="">Select City</option>
                                    @if(old('city_id', $employee->city_id))
                                        <option value="{{ old('city_id', $employee->city_id) }}" selected>{{ $employee->city->name }}</option>
                                    @endif
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="barangay_id">Barangay</label>
                                <select class="form-control select2 @error('barangay_id') is-invalid @enderror" id="barangay_id" name="barangay_id" required disabled>
                                    <option value="">Select Barangay</option>
                                    @if(old('barangay_id', $employee->barangay_id))
                                        <option value="{{ old('barangay_id', $employee->barangay_id) }}" selected>{{ $employee->barangay->name }}</option>
                                    @endif
                                </select>
                                @error('barangay_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="zip_code">Zip Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ old('zip_code', $employee->zip_code) }}" required disabled placeholder="Enter Zip Code">
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-outline card-warning shadow-sm mb-4">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title"><i class="fas fa-briefcase mr-2"></i>Employment Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="position_id">Position</label>
                                <select class="form-control select2 @error('position_id') is-invalid @enderror" id="position_id" name="position_id" required disabled>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id', $employee->position_id) == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class="form-control select2 @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required disabled>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white">Php</span>
                                </div>
                                <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}" required>
                            </div>
                            @error('salary')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sss_no">SSS No</label>
                            <input type="text" class="form-control @error('sss_no') is-invalid @enderror" id="sss_no" name="sss_no" value="{{ old('sss_no', $employee->sss_no) }}" placeholder="Enter SSS No">
                            @error('sss_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tin_no">TIN No</label>
                            <input type="text" class="form-control @error('tin_no') is-invalid @enderror" id="tin_no" name="tin_no" value="{{ old('tin_no', $employee->tin_no) }}" placeholder="Enter TIN No">
                            @error('tin_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="philhealth_no">PhilHealth No</label>
                            <input type="text" class="form-control @error('philhealth_no') is-invalid @enderror" id="philhealth_no" name="philhealth_no" value="{{ old('philhealth_no', $employee->philhealth_no) }}" placeholder="Enter PhilHealth No">
                            @error('philhealth_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pagibig_no">Pag-IBIG No</label>
                            <input type="text" class="form-control @error('pagibig_no') is-invalid @enderror" id="pagibig_no" name="pagibig_no" value="{{ old('pagibig_no', $employee->pagibig_no) }}" placeholder="Enter Pag-IBIG No">
                            @error('pagibig_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_hired">Date Hired</label>
                            <div class="input-group date" id="date_hired_picker" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('date_hired') is-invalid @enderror" data-target="#date_hired_picker" id="date_hired" name="date_hired" value="{{ old('date_hired', $employee->date_hired) }}" required placeholder="YYYY-MM-DD"/>
                                <div class="input-group-append" data-target="#date_hired_picker" data-toggle="datetimepicker">
                                    <div class="input-group-text bg-warning text-white"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('date_hired')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="employee_status">Employment Status</label>
                            <select class="form-control select2 @error('employee_status') is-invalid @enderror" id="employee_status" name="employee_status" required>
                                <option value="active" {{ old('employee_status', $employee->employment_status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="resigned" {{ old('employee_status', $employee->employment_status) == 'Resigned' ? 'selected' : '' }}>Resigned</option>
                                <option value="terminated" {{ old('employee_status', $employee->employment_status) == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                            </select>
                            @error('employee_status')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rank">Rank</label>
                            <select class="form-control select2 @error('rank') is-invalid @enderror" id="rank" name="rank" required>
                                <option value="Rank File" {{ old('rank', $employee->rank) == 'Rank File' ? 'selected' : '' }}>Rank and File</option>
                                <option value="Managerial" {{ old('rank', $employee->rank) == 'Managerial' ? 'selected' : '' }}>Managerial</option>
                            </select>
                            @error('rank')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-left">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Update Employee
                        </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
<style>
.card-outline {
    border-top: 3px solid;
}
.form-group label {
    font-weight: bold;
    color: #495057;
}
.custom-file-label::after {
    content: "Browse";
}
.select2-container--default .select2-selection--single {
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(2.25rem + 2px);
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
input {
    text-transform: capitalize;
}
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap'
        });
    //Initialize datetimepicker
    $('#birth_date_picker, #date_hired_picker').datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'far fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'fas fa-times'
        }
    });

    //BS-custom-file-input
    bsCustomFileInput.init();

    // Add smooth scrolling to anchor links
    $('a[href*="#"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 500, 'linear');
    });
});
</script>
@stop
