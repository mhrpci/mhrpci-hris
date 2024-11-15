{{-- resources/views/profile/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10 col-sm-12">
            <!-- Enhanced Profile Header with better spacing and animations -->
            <div class="profile-container">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="d-flex gap-4">
                        <a href="{{ route('profile.show') }}" class="btn btn-primary btn-lg rounded-pill shadow-hover">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg rounded-pill shadow-hover">
                            <i class="bi bi-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>

                <!-- Improved profile image section -->
                <div class="text-center mb-5 profile-header">
                    <div class="position-relative d-inline-block mb-4 profile-image-wrapper">
                        @if($user->profile_image)
                            <img src="{{ Storage::url($user->profile_image) }}"
                                 alt="Profile Image"
                                 class="rounded-circle border border-4 border-white shadow-lg profile-image animate-hover">
                        @else
                            <div class="rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center border border-4 border-white shadow-lg profile-image animate-hover">
                                <span class="initials text-white">
                                    {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 bg-success p-2 rounded-circle border border-3 border-white shadow-lg status-badge pulse-animation">
                            <i class="bi bi-check-lg text-white"></i>
                        </span>
                    </div>

                    <!-- Enhanced name and email display -->
                    <h2 class="display-5 fw-bold mb-3 text-gradient">
                        {{ $user->first_name }}
                        @if($user->middle_name) {{ $user->middle_name }} @endif
                        {{ $user->last_name }}
                        @if($user->suffix) {{ $user->suffix }} @endif
                    </h2>
                    <p class="text-muted mb-4">
                        <span class="badge bg-light text-dark px-4 py-2 rounded-pill shadow-sm animate-hover">
                            <i class="bi bi-envelope-fill me-2"></i>{{ $user->email }}
                        </span>
                    </p>
                </div>

                <!-- Enhanced card styling -->
                <div class="card border-0 shadow-xl rounded-4 overflow-hidden mb-4 animate-card">
                    <div class="card-header bg-primary bg-gradient text-white py-3 px-4">
                        <h4 class="card-title mb-0 d-flex align-items-center">
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
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Modern Styling */
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.profile-image-wrapper {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.profile-image {
    width: 220px;
    height: 220px;
    object-fit: cover;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.animate-hover:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.shadow-hover {
    transition: all 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.shadow-xl {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.text-gradient {
    background: linear-gradient(120deg, #2b2d42 0%, #3d405b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.bg-gradient-primary {
    background: linear-gradient(145deg, #4361ee 0%, #3a0ca3 100%);
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(25, 135, 84, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0);
    }
}

.animate-card {
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.animate-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
}

/* Enhanced Responsive Design */
@media (max-width: 1200px) {
    .profile-container {
        padding: 1.5rem;
    }
}

@media (max-width: 992px) {
    .profile-image {
        width: 180px;
        height: 180px;
    }

    .display-5 {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .profile-image {
        width: 160px;
        height: 160px;
    }

    .btn-lg {
        padding: 0.5rem 1.2rem;
        font-size: 0.95rem;
    }

    .initials {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .profile-container {
        padding: 1rem;
    }

    .profile-image {
        width: 140px;
        height: 140px;
    }

    .display-5 {
        font-size: 1.5rem;
    }

    .btn-lg {
        padding: 0.4rem 1rem;
        font-size: 0.9rem;
    }

    .initials {
        font-size: 2rem;
    }

    .card-body {
        padding: 1rem !important;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .bg-light {
        background-color: #2b2d42 !important;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .text-dark {
        color: #f8f9fa !important;
    }

    .text-muted {
        color: #dee2e6 !important;
    }
}
</style>
@endsection
