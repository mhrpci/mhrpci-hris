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
                                    @if(!auth()->user()->hasRole('Employee'))
                                    <div class="col-md-12 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0"><i class="fas fa-signature mr-2"></i>Digital Signature</h5>
                                                @if(!$user->signature)
                                                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#signatureModal">
                                                        <i class="fas fa-plus mr-1"></i> Add Signature
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                @if($user->signature)
                                                    <div class="text-center">
                                                        <div class="border rounded p-4 d-inline-block bg-white">
                                                            <img src="{{ Storage::url($user->signature) }}"
                                                                 alt="User Signature"
                                                                 class="img-fluid"
                                                                 style="max-height: 100px;">
                                                        </div>

                                                        <div class="mt-3">
                                                            <small class="text-muted d-block">
                                                                Last updated: {{ \Carbon\Carbon::parse($user->updated_at)->format('F d, Y h:i A') }}
                                                            </small>

                                                            <button type="button" class="btn btn-outline-secondary mt-2" data-toggle="modal" data-target="#signatureModal">
                                                                <i class="fas fa-edit mr-1"></i> Update Signature
                                                            </button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center py-4">
                                                        <div class="text-muted mb-3">
                                                            <i class="fas fa-signature fa-2x"></i>
                                                            <p class="mt-2">No signature has been uploaded yet.</p>
                                                        </div>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signatureModal">
                                                            <i class="fas fa-plus mr-1"></i> Add Your Signature
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                    @endif
                                    <!-- Add navigation and submit buttons -->
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-secondary" onclick="stepper.previous()">Previous</button>
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="fas fa-save mr-1"></i> Save Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signatureModalLabel">
                    {{ $user->signature ? 'Update Your Signature' : 'Add Your Signature' }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($user->signature)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-1"></i>
                        Your existing signature will be replaced when you save a new one.
                    </div>
                @endif
                <canvas id="signatureCanvas" class="border rounded" width="700" height="200"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="clearSignature()">Clear</button>
                <button type="button" class="btn btn-primary" onclick="saveSignature()">
                    {{ $user->signature ? 'Update Signature' : 'Save Signature' }}
                </button>
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
    #signatureCanvas {
        cursor: crosshair;
        background-color: #fff;
    }
    .signature-display {
        display: none;
    }
    .signature-display img {
        filter: brightness(1.1) contrast(1.2);
    }
    /* Toast styles */
    .colored-toast.swal2-icon-success {
        box-shadow: 0 0 12px rgba(40, 167, 69, 0.4) !important;
    }
    .colored-toast.swal2-icon-error {
        box-shadow: 0 0 12px rgba(220, 53, 69, 0.4) !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    $(document).ready(function() {
        // SweetAlert toast configuration
        const toastConfig = {
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            background: '#fff',
            color: '#424242',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            }
        };

        // Success toast
        @if(Session::has('success'))
            Swal.fire({
                ...toastConfig,
                icon: 'success',
                title: 'Success',
                text: "{{ Session::get('success') }}",
                background: '#28a745',
                color: '#fff'
            });
        @endif

        // Error toast
        @if(Session::has('error'))
            Swal.fire({
                ...toastConfig,
                icon: 'error',
                title: 'Error',
                text: "{{ Session::get('error') }}",
                background: '#dc3545',
                color: '#fff'
            });
        @endif

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

        // Add form submission handler
        $('form').on('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...').prop('disabled', true);

            // Submit form
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        ...toastConfig,
                        icon: 'success',
                        title: 'Success',
                        text: 'Profile updated successfully',
                        background: '#28a745',
                        color: '#fff'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        ...toastConfig,
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Failed to update profile',
                        background: '#dc3545',
                        color: '#fff'
                    });
                },
                complete: function() {
                    submitBtn.html(originalText).prop('disabled', false);
                }
            });
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

    let canvas = null;
    let ctx = null;
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    document.addEventListener('DOMContentLoaded', function() {
        canvas = document.getElementById('signatureCanvas');
        ctx = canvas.getContext('2d');

        // Set up canvas drawing events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Set up touch events for mobile
        canvas.addEventListener('touchstart', handleTouch);
        canvas.addEventListener('touchmove', handleTouch);
        canvas.addEventListener('touchend', stopDrawing);
    });

    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function draw(e) {
        if (!isDrawing) return;

        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();

        [lastX, lastY] = [e.offsetX, e.offsetY];
    }

    function stopDrawing() {
        isDrawing = false;
    }

    function handleTouch(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        const offsetX = touch.clientX - rect.left;
        const offsetY = touch.clientY - rect.top;

        const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : 'mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });

        canvas.dispatchEvent(mouseEvent);
    }

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        // Validate if signature is empty
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const pixels = imageData.data;
        let isEmpty = true;

        for (let i = 0; i < pixels.length; i += 4) {
            if (pixels[i + 3] !== 0) {
                isEmpty = false;
                break;
            }
        }

        if (isEmpty) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please draw your signature before saving.',
                background: '#dc3545',
                color: '#fff'
            });
            return;
        }

        // Confirm if updating existing signature
        const hasExistingSignature = {{ $user->signature ? 'true' : 'false' }};
        if (hasExistingSignature) {
            Swal.fire({
                title: 'Update Signature?',
                text: 'This will replace your existing signature. Continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitSignature();
                }
            });
        } else {
            submitSignature();
        }
    }

    function submitSignature() {
        const signatureData = canvas.toDataURL('image/png');
        const saveButton = document.querySelector('[onclick="saveSignature()"]');
        const originalText = saveButton.innerHTML;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        saveButton.disabled = true;

        axios.post('/profile/signature', {
            signature: signatureData
        })
        .then(response => {
            if (response.data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Signature has been saved successfully.',
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#28a745',
                    color: '#fff'
                }).then(() => {
                    location.reload();
                });
                $('#signatureModal').modal('hide');
            }
        })
        .catch(error => {
            console.error('Signature save error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.response?.data?.message || 'Failed to save signature',
                background: '#dc3545',
                color: '#fff'
            });
        })
        .finally(() => {
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        });
    }
</script>
@endpush
