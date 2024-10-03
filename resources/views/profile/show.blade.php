@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Profile Update</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div id="stepper" class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#personal-info">
                                <button type="button" class="step-trigger" role="tab" aria-controls="personal-info" id="personal-info-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label d-none d-sm-inline">Personal Info</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#account-info">
                                <button type="button" class="step-trigger" role="tab" aria-controls="account-info" id="account-info-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label d-none d-sm-inline">Account Info</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#profile-image">
                                <button type="button" class="step-trigger" role="tab" aria-controls="profile-image" id="profile-image-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label d-none d-sm-inline">Profile Image & Bio</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="company_id">Company ID</label>
                                                <input type="text" id="company_id" name="company_id" value="{{ old('company_id', $user->company_id) }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" placeholder="Enter first name" required>
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" id="middle_name" name="middle_name" placeholder="Enter middle name (optional)" value="{{ old('middle_name', $user->middle_name) }}" class="form-control">
                                                @error('middle_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" placeholder="Enter last name" required>
                                                @error('last_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="suffix">Suffix</label>
                                                <input type="text" id="suffix" name="suffix" placeholder="Enter suffix (optional)" value="{{ old('suffix', $user->suffix) }}" class="form-control">
                                                @error('suffix')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" onclick="stepper.next()">Next</button>
                                </div>

                                <div id="account-info" class="content" role="tabpanel" aria-labelledby="account-info-trigger">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Enter email address" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="togglePasswordVisibility('password', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Enter confirm password (optional)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="togglePasswordVisibility('password_confirmation', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                                    <button type="button" class="btn btn-primary float-right" onclick="stepper.next()">Next</button>
                                </div>

                                <div id="profile-image" class="content" role="tabpanel" aria-labelledby="profile-image-trigger">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                @if (isset($user->profile_image))
                                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-fluid mb-2" style="max-width: 200px; border-radius: 50%;">
                                                @endif
                                                <br>
                                                <strong>Profile Image:</strong>
                                                <input type="file" name="profile_image" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="bio">Bio</label>
                                                <textarea id="bio" name="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                                @error('bio')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                                    <button type="submit" class="btn btn-success float-right">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
<style>
    @media (max-width: 767.98px) {
        .bs-stepper-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .bs-stepper .line {
            display: none;
        }
        .bs-stepper-header .step {
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('#stepper'), {
            animation: true
        });

        function capitalizeInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }

        const inputsToCapitalize = [
            'first_name',
            'middle_name',
            'last_name'
        ];

        inputsToCapitalize.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', capitalizeInput);
            }
        });
    });

    function togglePasswordVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;

        // Toggle the icon class
        icon.querySelector('i').classList.toggle('fa-eye');
        icon.querySelector('i').classList.toggle('fa-eye-slash');
    }
</script>
@endpush
