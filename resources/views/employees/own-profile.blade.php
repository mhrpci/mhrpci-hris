@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <!-- Left column with photo and basic info -->
        <div class="col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block">
                        <img class="rounded-circle mb-3 shadow"
                             src="{{ $employee->profile ? asset('storage/' . $employee->profile) : asset('images/default-avatar.png') }}"
                             alt="{{ $employee->first_name }} {{ $employee->last_name }}"
                             style="width: 180px; height: 180px; object-fit: cover;">
                        @if(auth()->user()->email === $employee->email_address)
                            <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0 mb-3 me-2" 
                                    data-toggle="modal" 
                                    data-target="#updateProfileImageModal">
                                <i class="fas fa-camera"></i>
                            </button>
                        @endif
                    </div>
                    <h2 class="font-weight-bold">{{ $employee->first_name }} {{ $employee->last_name }}</h2>
                    <p class="text-muted mb-2">{{ $employee->email_address }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $employee->contact_no }}</p>
                    <p class="mb-1"><strong>Gender:</strong> {{ $employee->gender->name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Birthplace:</strong> {{ $employee->birth_place_province ?? 'N/A' }}, {{ $employee->birth_place_city ?? 'N/A' }}, {{ $employee->birth_place_barangay ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Right column with detailed information -->
        <div class="col-lg-9">
            <div class="mb-4">
                <div class="nav-buttons-wrapper overflow-auto">
                    <div class="d-flex">
                        <button class="btn btn-primary flex-shrink-0 mr-2 mb-2" onclick="showSection('personal')">
                            <i class="fas fa-user mr-1"></i> Personal Info
                        </button>
                        <button class="btn btn-success flex-shrink-0 mr-2 mb-2" onclick="showSection('work')">
                            <i class="fas fa-briefcase mr-1"></i> Work Details
                        </button>
                        <button class="btn btn-info flex-shrink-0 mr-2 mb-2" onclick="showSection('education')">
                            <i class="fas fa-graduation-cap mr-1"></i> Education
                        </button>
                        <button class="btn btn-warning flex-shrink-0 mr-2 mb-2" onclick="showSection('address')">
                            <i class="fas fa-home mr-1"></i> Address
                        </button>
                        <button class="btn btn-secondary flex-shrink-0 mr-2 mb-2" onclick="showSection('government')">
                            <i class="fas fa-id-card mr-1"></i> Government IDs
                        </button>
                        <button class="btn btn-dark flex-shrink-0 mr-2 mb-2" onclick="showSection('signature')">
                            <i class="fas fa-signature mr-1"></i> Signature
                        </button>
                    </div>
                </div>
            </div>

            <div id="infoSections">
                <!-- Personal Information -->
                <div id="personal" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user mr-2"></i>Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Birth Date:</strong> {{ $employee->birth_date ? \Carbon\Carbon::parse($employee->birth_date)->format('F d, Y') : 'N/A' }}</p>
                            <p><strong>Emergency Contact Name:</strong> {{ $employee->emergency_name ?? 'N/A' }}</p>
                            <p><strong>Emergency Contact #:</strong> {{ $employee->emergency_no ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Work Details -->
                <div id="work" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-briefcase mr-2"></i>Work Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Date Hired:</strong> {{ $employee->date_hired ? \Carbon\Carbon::parse($employee->date_hired)->format('F d, Y') : 'N/A' }}</p>
                            <p><strong>Company ID:</strong> {{ $employee->company_id }}</p>
                            <p><strong>Position:</strong> {{ $employee->position->name }}</p>
                            <p><strong>Department:</strong> {{ $employee->department->name }}</p>
                            <p><strong>Head:</strong> {{ $employee->department->head_name }}</p>
                            <p><strong>Employement:</strong> {{ $employee->employment_status }}</p>
                            <p><strong>Employee Status:</strong> <span class="badge bg-success">{{ $employee->employee_status }}</span></p>
                            <p><strong>Monthly Salary:</strong> ₱{{ number_format($employee->salary, 2, '.', ',') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div id="education" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap mr-2"></i>Education</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Elementary:</strong> {{ $employee->elementary ?? 'N/A' }}</p>
                            <p><strong>Secondary:</strong> {{ $employee->secondary ?? 'N/A' }}</p>
                            <p><strong>Tertiary:</strong> {{ $employee->tertiary ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div id="address" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-white">
                            <h5 class="mb-0"><i class="fas fa-home mr-2"></i>Home Address</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $employee->province->name}}, {{ $employee->city->name}}, {{ $employee->barangay->name}}, {{ $employee->zip_code}}</p>
                        </div>
                    </div>
                </div>

                <!-- Government IDs -->
                <div id="government" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-id-card mr-2"></i>Government IDs</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <strong>TIN:</strong> {{ $employee->tin_no ?? 'N/A' }}
                                </div>
                                <div class="col-md-3 mb-2">
                                    <strong>SSS:</strong> {{ $employee->sss_no ?? 'N/A' }}
                                </div>
                                <div class="col-md-3 mb-2">
                                    <strong>PAGIBIG:</strong> {{ $employee->pagibig_no ?? 'N/A' }}
                                </div>
                                <div class="col-md-3 mb-2">
                                    <strong>PHILHEALTH:</strong> {{ $employee->philhealth_no ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Signature -->
                <div id="signature" class="info-section">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-signature mr-2"></i>Digital Signature</h5>
                            @if(auth()->user()->email === $employee->email_address && !$employee->signature)
                                <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#signatureModal">
                                    <i class="fas fa-plus mr-1"></i> Add Signature
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($employee->signature)
                                <div class="text-center">
                                    <div class="border rounded p-4 d-inline-block bg-white">
                                        <img src="{{ Storage::url($employee->signature) }}"
                                             alt="Employee Signature"
                                             class="img-fluid"
                                             style="max-height: 100px;">
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-muted d-block">
                                            Last updated: {{ \Carbon\Carbon::parse($employee->updated_at)->format('F d, Y h:i A') }}
                                        </small>

                                        @if(auth()->user()->email === $employee->email_address)
                                            <button class="btn btn-outline-secondary mt-2" data-toggle="modal" data-target="#signatureModal">
                                                <i class="fas fa-edit mr-1"></i> Update Signature
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="text-muted mb-3">
                                        <i class="fas fa-signature fa-2x"></i>
                                        <p class="mt-2">No signature has been uploaded yet.</p>
                                    </div>

                                    @if(auth()->user()->email === $employee->email_address)
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#signatureModal">
                                            <i class="fas fa-plus mr-1"></i> Add Your Signature
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" role="dialog" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signatureModalLabel">
                    {{ $employee->signature ? 'Update Your Signature' : 'Add Your Signature' }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex flex-column">
                @if($employee->signature)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-1"></i>
                        Your existing signature will be replaced when you save a new one.
                    </div>
                @endif
                <div class="flex-grow-1 position-relative">
                    <canvas id="signatureCanvas" class="border rounded position-absolute w-100 h-100"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="clearSignature()">Clear</button>
                <button type="button" class="btn btn-primary" onclick="saveSignature()">
                    {{ $employee->signature ? 'Update Signature' : 'Save Signature' }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Image Modal -->
<div class="modal fade" id="updateProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileImageModalLabel">Update Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($employee->profile_updated_at && now()->diffInDays($employee->profile_updated_at) < 60)
                    @php
                        $nextUpdateDate = \Carbon\Carbon::parse($employee->profile_updated_at)->addDays(60);
                        $daysRemaining = now()->diffInDays($nextUpdateDate);
                    @endphp
                    <div class="alert alert-warning">
                        <i class="fas fa-clock mr-2"></i>
                        Profile updates are limited to once every 60 days.<br>
                        Next update available on: <strong>{{ $nextUpdateDate->format('F d, Y') }}</strong><br>
                        ({{ $daysRemaining }} days remaining)
                    </div>
                @else
                    <form id="profileImageForm" enctype="multipart/form-data">
                        <div class="upload-box">
                            <input type="file" class="file-input" id="profile" name="profile" accept="image/jpeg,image/png,image/jpg">
                            <div class="upload-content">
                                <div id="defaultUploadContent">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <p class="upload-text">Drag and drop your image here<br>or click to browse</p>
                                    <p class="upload-formats">Accepted formats: JPG, JPEG, PNG</p>
                                </div>
                                <div id="imagePreview" style="display: none;">
                                    <img src="" alt="Preview" class="preview-image">
                                    <p class="file-name mt-2"></p>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeImage()">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if(!$employee->profile_updated_at || now()->diffInDays($employee->profile_updated_at) >= 60)
                    <button type="button" class="btn btn-primary" onclick="updateProfileImage()">Save changes</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Base styles */
    .card {
        border: none;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    /* Enhanced Responsive Grid Layout */
    @media (max-width: 1200px) {
        .col-lg-3 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .col-lg-9 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        /* Center profile section on medium screens */
        .col-lg-3 .card {
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* Enhanced Mobile Responsiveness */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 10px;
        }

        .card {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 0.875rem;
        }

        /* Adjust profile image size */
        .rounded-circle {
            width: 120px !important;
            height: 120px !important;
        }

        /* Make buttons more touch-friendly */
        .btn {
            padding: 8px 16px;
            font-size: 0.95rem;
            margin-right: 8px;
            margin-bottom: 8px;
            white-space: nowrap;
        }

        /* Improve navigation buttons scrolling */
        .nav-buttons-wrapper {
            padding-bottom: 5px;
            margin-bottom: -5px;
        }

        .d-flex {
            flex-wrap: nowrap;
            padding-bottom: 5px;
        }

        /* Adjust text sizes for better readability */
        h2 {
            font-size: 1.5rem;
        }

        h5 {
            font-size: 1.1rem;
        }

        p {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
    }

    /* Small Screen Optimizations */
    @media (max-width: 576px) {
        .container-fluid {
            padding: 8px;
        }

        /* Stack government ID fields */
        #government .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 0.5rem;
        }

        /* Adjust modal padding */
        .modal-body {
            padding: 1rem;
        }

        .modal-footer {
            padding: 0.75rem;
        }

        /* Make signature canvas more manageable */
        #signatureCanvas {
            height: 120px !important;
        }
    }

    /* Enhanced Navigation Buttons */
    .nav-buttons-wrapper {
        position: relative;
        margin-bottom: 1.5rem;
        -webkit-overflow-scrolling: touch;
    }

    .nav-buttons-wrapper .d-flex {
        gap: 8px;
    }

    .btn {
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .btn:active {
        transform: translateY(1px);
    }

    /* Improved Info Section Transitions */
    .info-section {
        display: none;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .info-section.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    /* Enhanced Card Shadows and Hover Effects */
    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05), 
                    0 1px 2px rgba(0,0,0,0.1) !important;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.08), 
                    0 2px 4px rgba(0,0,0,0.12) !important;
    }

    /* Improved Image Display */
    .signature-display img {
        max-width: 100%;
        height: auto;
    }

    /* Better Touch Area for Buttons */
    @media (max-width: 992px) {
        .btn {
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    /* Signature Canvas Styles */
    #signatureCanvas {
        touch-action: none;
        background: #fff;
        border: 1px solid #dee2e6 !important;
    }

    /* Adjust modal size for better signature space */
    .modal-xl {
        max-width: 90%;
    }

    @media (max-width: 768px) {
        #signatureCanvas {
            height: 200px !important;
        }
        
        .modal-xl {
            max-width: 95%;
            margin: 10px;
        }
    }

    /* Fullscreen Modal Styles */
    .modal-fullscreen {
        width: 100vw;
        max-width: none;
        height: 100vh;
        margin: 0;
    }

    .modal-fullscreen .modal-content {
        height: 100vh;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen .modal-body {
        height: calc(100vh - 120px); /* Adjust for header and footer */
        padding: 20px;
    }

    /* Upload Box Styles */
    .upload-box {
        position: relative;
        width: 100%;
        min-height: 300px;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .upload-box.dragover {
        background-color: #e9ecef;
        border-color: #6c757d;
    }

    .upload-box .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .upload-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 90%;
    }

    .upload-icon {
        font-size: 48px;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .upload-text {
        font-size: 16px;
        color: #495057;
        margin-bottom: 10px;
    }

    .upload-formats {
        font-size: 12px;
        color: #6c757d;
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .file-name {
        font-size: 14px;
        color: #495057;
        margin: 8px 0;
        word-break: break-all;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.info-section');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        const selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = 'block';

        // Add slide-in animation
        selectedSection.style.opacity = '0';
        selectedSection.style.transform = 'translateX(20px)';
        setTimeout(() => {
            selectedSection.style.opacity = '1';
            selectedSection.style.transform = 'translateX(0)';
        }, 50);
    }

    // Show personal info by default
    document.addEventListener('DOMContentLoaded', () => {
        showSection('personal');
    });

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

        // Add resize handler
        window.addEventListener('resize', resizeCanvas);

        // Initial canvas setup
        resizeCanvas();

        // Show first section by default
        showSection('personal');
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
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 4;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
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
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;

        const offsetX = (touch.clientX - rect.left) * scaleX;
        const offsetY = (touch.clientY - rect.top) * scaleY;

        if (e.type === 'touchstart') {
            isDrawing = true;
            [lastX, lastY] = [offsetX, offsetY];
        } else if (e.type === 'touchmove' && isDrawing) {
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(offsetX, offsetY);
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 4;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.stroke();

            [lastX, lastY] = [offsetX, offsetY];
        }
    }

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        // Check if user is authorized
        const userEmail = '{{ auth()->user()->email }}';
        const employeeEmail = '{{ $employee->email_address }}';

        if (userEmail !== employeeEmail) {
            Swal.fire({
                icon: 'error',
                title: 'Unauthorized',
                text: 'You are not authorized to update this signature.'
            });
            return;
        }

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
                text: 'Please draw your signature before saving.'
            });
            return;
        }

        // Confirm if updating existing signature
        const hasExistingSignature = {{ $employee->signature ? 'true' : 'false' }};
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
        // Get signature data
        const signatureData = canvas.toDataURL('image/png');

        // Show loading state
        const saveButton = document.querySelector('[onclick="saveSignature()"]');
        const originalText = saveButton.innerHTML;
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        saveButton.disabled = true;

        // Add CSRF token to headers
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send AJAX request
        axios.post('/employee/signature', {
            signature: signatureData
        })
        .then(response => {
            if (response.data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Signature has been saved successfully.',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Close modal
                $('#signatureModal').modal('hide');

                // Refresh the page to update the UI
                location.reload();
            }
        })
        .catch(error => {
            console.error('Signature save error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.response?.data?.message || 'Failed to save signature'
            });
        })
        .finally(() => {
            // Reset button state
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        });
    }

    // Make canvas responsive
    function resizeCanvas() {
        const canvas = document.getElementById('signatureCanvas');
        if (canvas) {
            const container = canvas.parentElement;
            const width = container.offsetWidth;
            const height = container.offsetHeight;
            
            canvas.width = width;
            canvas.height = height;
            
            ctx = canvas.getContext('2d');
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 4;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
        }
    }

    // Ensure canvas is resized when modal opens
    $('#signatureModal').on('shown.bs.modal', function () {
        resizeCanvas();
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if ($('#signatureModal').hasClass('show')) {
            resizeCanvas();
        }
    });

    function updateProfileImage() {
        const formData = new FormData(document.getElementById('profileImageForm'));
        const saveButton = document.querySelector('[onclick="updateProfileImage()"]');
        const originalText = saveButton.innerHTML;
        
        // Show loading state
        saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
        saveButton.disabled = true;

        axios.post('/employee/profile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            if (response.data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Profile image has been updated successfully.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Profile update error:', error);
            let errorMessage = 'Failed to update profile image';
            
            if (error.response?.data?.message) {
                errorMessage = error.response.data.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage
            });
        })
        .finally(() => {
            saveButton.innerHTML = originalText;
            saveButton.disabled = false;
        });
    }

    // Add these new functions for drag and drop functionality
    document.addEventListener('DOMContentLoaded', function() {
        const uploadBox = document.querySelector('.upload-box');
        const fileInput = document.getElementById('profile');
        const defaultContent = document.getElementById('defaultUploadContent');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = imagePreview.querySelector('img');
        const fileName = imagePreview.querySelector('.file-name');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadBox.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadBox.classList.add('dragover');
        }

        function unhighlight(e) {
            uploadBox.classList.remove('dragover');
        }

        uploadBox.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            handleFile(file);
        }

        fileInput.addEventListener('change', function(e) {
            handleFile(this.files[0]);
        });

        function handleFile(file) {
            if (file) {
                if (validateFile(file)) {
                    displayPreview(file);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Please upload only JPG, JPEG, or PNG files.'
                    });
                }
            }
        }

        function validateFile(file) {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            return validTypes.includes(file.type);
        }

        function displayPreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                fileName.textContent = file.name;
                defaultContent.style.display = 'none';
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    function removeImage() {
        const fileInput = document.getElementById('profile');
        const defaultContent = document.getElementById('defaultUploadContent');
        const imagePreview = document.getElementById('imagePreview');
        
        fileInput.value = '';
        defaultContent.style.display = 'block';
        imagePreview.style.display = 'none';
    }
</script>
@endpush
