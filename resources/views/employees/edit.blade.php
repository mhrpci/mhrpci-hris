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
                <div class="card-header">
                    <h3 class="card-title">Edit Employee</h3>
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

                    <form action="{{ route('employees.update', $employee->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <p>Basic Information</p>
                        <img id="preview" src="{{ asset('storage/' . $employee->profile) }}" alt="Preview" style="width: 10em; height: 10em; border-radius:5em; margin-top: 10px;">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile">Profile Picture</label>
                                <input type="file" id="profile" value="{{ old('profile', $employee->profile) }}" accept="image/*" name="profile" class="form-control"  onchange="validateAndPreviewImage(event)">
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company ID<span class="text-danger">*</span></label>
                                    <input type="text" id="company_id" name="company_id" class="form-control" value="{{ $employee->company_id }}" placeholder="Enter employee company id" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name<span class="text-danger">*</span></label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}" placeholder="Enter employee first name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" class="form-control" value="{{ $employee->middle_name }}" placeholder="Enter employee middle name (optional)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}" placeholder="Enter employee last name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="suffix">Suffix</label>
                                    <input type="text" id="suffix" name="suffix" class="form-control" value="{{ $employee->suffix }}" placeholder="Enter employee suffix ex:(jr, sr, etc...)">
                                </div>
                            </div>
                        </div>
                        <!-- Add more fields as needed -->
                        <p>Contact Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_address">Email Address<span class="text-danger">*</span></label>
                                    <input type="email" id="email_address" name="email_address" class="form-control" value="{{ $employee->email_address }}" placeholder="Enter employee email address" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_no">Contact No<span class="text-danger">*</span></label>
                                    <input type="number" id="contact_no" name="contact_no" class="form-control" value="{{ $employee->contact_no }}" placeholder="Enter your contact number" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_name">Emergency Contact Name<span class="text-danger">*</span></label>
                                        <input type="text" id="emergency_name" name="emergency_name" class="form-control" value ="{{ $employee->emergency_name}}" placeholder="Enter employee emergency contact name"required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_no">Emergency Contact No<span class="text-danger">*</span></label>
                                        <input type="number" id="emergency_no" name="emergency_no" class="form-control" value ="{{ $employee->emergency_no}}" placeholder="Enter your emergency contact number"required>
                                    </div>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                            <p>School Attainment, Gender, Position and Department</p>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="elementary">Elementary:</label>
                                        <input type="text" id="elementary" name="elementary" class="form-control" value ="{{ $employee->elementary}}" placeholder="Enter elementary"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="secondary">Secondary:</label>
                                        <input type="text" id="secondary" name="secondary" class="form-control" value ="{{ $employee->secondary}}" placeholder="Enter secondary"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tertiary">Tertiary:</label>
                                        <input type="text" id="tertiary" name="tertiary" class="form-control" value ="{{ $employee->tertiary}}" placeholder="Enter tertiary"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender_id">Gender<span class="text-danger">*</span></label>
                                        <select id="gender_id" name="gender_id" class="form-control" required>
                                            <option value="">Select gender</option>
                                            @foreach($genders as $gender)
                                                <option value="{{ $gender->id }}" {{ $gender->id == $employee->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department_id">Department <span class="text-danger">*</span></label>
                                    <select id="department_id" name="department_id" class="form-control" required>
                                        <option value="">Select department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}"{{ $department->id == $employee->department_id ? ' selected' : '' }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_id">Position <span class="text-danger">*</span></label>
                                        <select id="position_id" name="position_id" class="form-control" required>
                                            <option value="">Select position</option>
                                            @foreach($positions as $position)
                                                @if($position->department_id == $employee->department_id)
                                                    <option value="{{ $position->id }}"{{ $position->id == $employee->position_id ? ' selected' : '' }}>{{ $position->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date">Birth Date<span class="text-danger">*</span></label>
                                        <input type="date" id="birth_date" name="birth_date" value="{{$employee->birth_date}}"class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_hired">Date Hired<span class="text-danger">*</span></label>
                                        <input type="date" id="date_hired" name="date_hired" value="{{$employee->date_hired}}"class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- End Of Contact and Gender-->

                            <!-- Start Of Birth Place-->
                            <p>Birth Place</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_place_province">Province:</label>
                                        <input type="text" id="birth_place_province" name="birth_place_province" value="{{$employee->birth_place_province}}" class="form-control" placeholder="Enter province">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_place_city">City:</label>
                                        <input type="text" id="birth_place_city" name="birth_place_city" value="{{$employee->birth_place_city}}" class="form-control" placeholder="Enter city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_place_barangay">Barangay:</label>
                                        <input type="text" id="birth_place_barangay" name="birth_place_barangay" value="{{$employee->birth_place_barangay}}" class="form-control" placeholder="Enter barangay">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salary">Monthly Salary<span class="text-danger">*</span></label>
                                        <input type="number" id="salary" name="salary" value="{{$employee->salary}}" class="form-control" placeholder="Enter monthly salary" step="0.01" required>
                                    </div>
                                </div>
                            </div>
                            <!-- End Of Birth Place-->

                            <!-- Start Of Home Address-->
                        <p>Home Address</p>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="province_id">Province<span class="text-danger">*</span></label>
                                    <select id="province_id" name="province_id" class="form-control" required>
                                        <option value="">Select province</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == $employee->province_id ? 'selected' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city_id">City<span class="text-danger">*</span></label>
                                    <select id="city_id" name="city_id" class="form-control" required>
                                        <option value="">Select city</option>
                                        <!-- City options will be populated dynamically -->
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barangay_id">Barangay<span class="text-danger">*</span></label>
                                        <select id="barangay_id" name="barangay_id" class="form-control" required>
                                            <option value="">Select barangay</option>
                                            <!-- Barangay options will be populated dynamically -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="zip_code">Zip Code<span class="text-danger">*</span></label>
                                        <input type="number" id="zip_code" name="zip_code" value="{{$employee->zip_code}}" class="form-control" placeholder="Enter zip code">
                                    </div>
                                </div>
                        </div>
                        <!-- End Of Home Address-->
                        <!-- Start Of Identification Card Numbers-->
                        <p>Identification Card Numbers</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sss_no">SSS No:</label>
                                        <input type="text" id="sss_no" name="sss_no" class="form-control" value="{{ $employee->sss_no }}" placeholder="Enter SSS number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="pagibig_no">PAGIBIG No:</label>
                                    <input type="text" id="pagibig_no" name="pagibig_no" value="{{$employee->pagibig_no}}" class="form-control" placeholder="Enter PAGIBIG number">
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tin_no">TIN No:</label>
                                        <input type="number" id="tin_no" name="tin_no" value="{{$employee->tin_no}}" class="form-control" placeholder="Enter tin number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="philhealth_no">Phil Health No:</label>
                                    <input type="text" id="philhealth_no" name="philhealth_no" class="form-control" value="{{$employee->philhealth_no}}" placeholder="Enter PhilHealth number">
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rank">Rank</label>
                                        <select class="form-control" id="rank" name="rank">
                                            <option value="Rank File" {{ old('rank', $employee->rank) == 'Rank File' ? 'selected' : '' }}>Rank File</option>
                                            <option value="Managerial" {{ old('rank', $employee->rank) == 'Managerial' ? 'selected' : '' }}>Managerial</option>
                                        </select>
                                    </div>
                                </div>
                                </div>
<!-- End Of Identification Card Numbers-->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-info">Back</a>
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
            function validateAndPreviewImage(event) {
        var input = event.target;
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(){
            var img = document.getElementById('preview');
            img.style.display = 'block';
            img.src = reader.result;
        };

        // Validate file type
        if (file.type.startsWith('image/')) {
            reader.readAsDataURL(file);
        } else {
            alert('The selected file is not an image.');
            input.value = ''; // Clear input
            document.getElementById('preview').style.display = 'none'; // Hide preview
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        function capitalizeInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }

        const inputsToCapitalize = [
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'elementary',
            'secondary',
            'tertiary',
            'birth_place_province',
            'birth_place_city',
            'birth_place_barangay',
            'emergency_name'
        ];

        inputsToCapitalize.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', capitalizeInput);
            }
        });
    });

             function populateCities(provinceId, selectedCityId = null) {
                 var cityDropdown = $('#city_id');
                 cityDropdown.empty();
                 cityDropdown.append('<option value="">Select city</option>');
                 @foreach($city as $city)
                     if ("{{ $city->province_id }}" == provinceId) {
                         var selected = "{{ $city->id }}" == selectedCityId ? 'selected' : '';
                         cityDropdown.append('<option value="{{ $city->id }}" ' + selected + '>{{ $city->name }}</option>');
                     }
                 @endforeach
             }

             function populateBarangays(cityId, selectedBarangayId = null) {
                 var barangayDropdown = $('#barangay_id');
                 barangayDropdown.empty();
                 barangayDropdown.append('<option value="">Select barangay</option>');
                 @foreach($barangay as $barangay)
                     if ("{{ $barangay->city_id }}" == cityId) {
                         var selected = "{{ $barangay->id }}" == selectedBarangayId ? 'selected' : '';
                         barangayDropdown.append('<option value="{{ $barangay->id }}" ' + selected + '>{{ $barangay->name }}</option>');
                     }
                 @endforeach
             }

             $('#province_id').on('change', function() {
                 var provinceId = $(this).val();
                 populateCities(provinceId);
                 $('#barangay_id').empty().append('<option value="">Select barangay</option>');
             });

             $('#city_id').on('change', function() {
                 var cityId = $(this).val();
                 populateBarangays(cityId);
             });

             // Initial population based on existing data
             var initialProvinceId = '{{ $employee->province_id }}';
             var initialCityId = '{{ $employee->city_id }}';
             var initialBarangayId = '{{ $employee->barangay_id }}';
             if (initialProvinceId) {
                 populateCities(initialProvinceId, initialCityId);
                 if (initialCityId) {
                     populateBarangays(initialCityId, initialBarangayId);
                 }
                }
                document.getElementById('philhealth_no').addEventListener('input', function (e) {
                                        // Remove non-numeric characters
                                        let input = e.target.value.replace(/\D/g, '');

                                        // Format as XXXX-XXXXXX-X (12 digits)
                                        if (input.length > 12) {
                                            input = input.slice(0, 12);
                                        }

                                        let formatted = '';
                                        for (let i = 0; i < input.length; i++) {
                                            if (i === 2 || i === 11) {
                                                formatted += '-';
                                            }
                                            formatted += input[i];
                                        }

                                        e.target.value = formatted;
                                    });
                                    document.getElementById('pagibig_no').addEventListener('input', function (e) {
                                        // Remove non-numeric characters
                                        let input = e.target.value.replace(/\D/g, '');

                                        // Format as XXXX-XXXX-XXXX (12 digits)
                                        if (input.length > 12) {
                                            input = input.slice(0, 12);
                                        }

                                        let formatted = '';
                                        for (let i = 0; i < input.length; i++) {
                                            if (i === 4 || i === 8) {
                                                formatted += '-';
                                            }
                                            formatted += input[i];
                                        }

                                        e.target.value = formatted;
                                    });
                                    document.getElementById('sss_no').addEventListener('input', function (e) {
                                        let sssNumber = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
                                        if (sssNumber.length > 10) {
                                            sssNumber = sssNumber.substr(0, 10); // Limit to 10 digits
                                        }
                                        // Format: XX-XXXXXXXXX-X
                                        let formattedSSS = '';
                                        if (sssNumber.length > 2) {
                                            formattedSSS = sssNumber.substr(0, 2) + '-';
                                            if (sssNumber.length > 3) {
                                                formattedSSS += sssNumber.substr(2, sssNumber.length - 3) + '-';
                                            }
                                            formattedSSS += sssNumber.substr(sssNumber.length - 1);
                                        } else {
                                            formattedSSS = sssNumber;
                                        }
                                        e.target.value = formattedSSS;
                                    });

                                    // New script for department and position relationship
                                    $('#department_id').on('change', function() {
                                        var departmentId = $(this).val();
                                        var positionSelect = $('#position_id');

                                        // Clear current options
                                        positionSelect.empty().append('<option value="">Select position</option>');

                                        // Add new options based on selected department
                                        @foreach($positions as $position)
                                            if ({{ $position->department_id }} == departmentId) {
                                                positionSelect.append('<option value="{{ $position->id }}">{{ $position->name }}</option>');
                                            }
                                        @endforeach

                                        // Trigger change event on position select to update Select2
                                        positionSelect.trigger('change');
                                    });
         });
     </script>
@stop

