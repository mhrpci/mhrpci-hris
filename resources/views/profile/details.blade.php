{{-- resources/views/profile/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10 col-sm-12">
            <!-- Profile Header -->
            <div class="text-center mb-5">
                <div class="position-relative d-inline-block mb-3">
                    @if($user->profile_image)
                        <img src="{{ Storage::url($user->profile_image) }}"
                             alt="Profile Image"
                             class="rounded-circle border border-4 border-white shadow-sm"
                             style="width: 180px; height: 180px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center border border-4 border-white shadow-sm"
                             style="width: 180px; height: 180px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                    <span class="position-absolute bottom-0 end-0 bg-success p-2 rounded-circle border border-3 border-white">
                        <i class="bi bi-check-lg text-white"></i>
                    </span>
                </div>

                <!-- Full Name Display -->
                <h2 class="fw-bold mb-1 text-truncate">
                    {{ $user->first_name }}
                    @if($user->middle_name) {{ $user->middle_name }} @endif
                    {{ $user->last_name }}
                    @if($user->suffix) {{ $user->suffix }} @endif
                </h2>
                <p class="text-muted">
                    <i class="bi bi-envelope-fill me-2"></i>{{ $user->email }}
                </p>
            </div>

            <!-- Profile Details Card -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                <div class="card-header bg-primary bg-gradient text-white py-3">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-person-badge me-2"></i>Personal Information
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Name Details Section -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-person me-2"></i>Name Details
                                </h5>
                                <div class="bg-light p-3 rounded">
                                    <div class="mb-2">
                                        <label class="small text-muted">First Name</label>
                                        <p class="mb-1 fw-medium">{{ $user->first_name }}</p>
                                    </div>
                                    @if($user->middle_name)
                                    <div class="mb-2">
                                        <label class="small text-muted">Middle Name</label>
                                        <p class="mb-1 fw-medium">{{ $user->middle_name }}</p>
                                    </div>
                                    @endif
                                    <div class="mb-2">
                                        <label class="small text-muted">Last Name</label>
                                        <p class="mb-1 fw-medium">{{ $user->last_name }}</p>
                                    </div>
                                    @if($user->suffix)
                                    <div>
                                        <label class="small text-muted">Suffix</label>
                                        <p class="mb-0 fw-medium">{{ $user->suffix }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-envelope me-2"></i>Contact Information
                                </h5>
                                <div class="bg-light p-3 rounded">
                                    <div class="mb-2">
                                        <label class="small text-muted">Email Address</label>
                                        <p class="mb-0 fw-medium">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Biography Section -->
                        <div class="col-12">
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-journal-text me-2"></i>Biography
                                </h5>
                                <div class="bg-light p-3 rounded">
                                    <p class="mb-0">{{ $user->bio ?: 'No biography provided.' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Signature Section -->
                        <div class="col-12">
                            <div>
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-pen me-2"></i>Digital Signature
                                </h5>
                                <div class="bg-light p-3 rounded text-center">
                                    @if($user->signature)
                                        <img src="{{ Storage::url($user->signature) }}"
                                             alt="Signature"
                                             class="img-fluid signature-img">
                                    @else
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-exclamation-circle me-2"></i>No signature uploaded
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mb-4">
                <a href="{{ route('profile.show') }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil-square me-2"></i>Edit Profile
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.signature-img {
    max-width: 300px;
    max-height: 150px;
    object-fit: contain;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.fw-medium {
    font-weight: 500 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .signature-img {
        max-width: 100%;
        height: auto;
    }
}
</style>
@endsection
