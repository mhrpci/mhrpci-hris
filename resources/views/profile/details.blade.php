{{-- resources/views/profile/details.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Profile Details</h1>
        <div class="align-items-center">
            <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Profile Summary Card -->
        <div class="col-md-4">
            <div class="card shadow-sm rounded-3">
                <div class="card-body text-center p-3">
                    <!-- Profile Image -->
                    <div class="mb-3">
                        @if($user->profile_image)
                            <img src="{{ Storage::url($user->profile_image) }}"
                                 alt="Profile"
                                 class="rounded-circle profile-img">
                        @else
                            <div class="profile-placeholder">
                                <span>{{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Basic Info -->
                    <h5 class="mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <p class="text-muted small">{{ $user->email }}</p>

                    <!-- Quick Stats -->
                    <div class="row g-2 mt-3">
                        <div class="col-4">
                            <div class="p-2 border rounded">
                                <small class="d-block fw-bold">Status</small>
                                <span class="badge bg-success">Active</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 border rounded">
                                <small class="d-block fw-bold">Since</small>
                                <small>{{ $user->created_at->format('M Y') }}</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 border rounded">
                                <small class="d-block fw-bold">Role</small>
                                <small>
                                    @forelse($user->getRoleNames() as $role)
                                        <span class="badge badge-success">{{ $role }}</span>
                                    @empty
                                    <span class="badge badge-success">No roles assigned</span>
                                @endforelse</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Cards -->
        <div class="col-md-8">
            <!-- Personal Info -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">First Name</label>
                            <p class="mb-0">{{ $user->first_name }}</p>
                        </div>
                        @if($user->middle_name)
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Middle Name</label>
                            <p class="mb-0">{{ $user->middle_name ?? 'N/A'}}</p>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Last Name</label>
                            <p class="mb-0">{{ $user->last_name }}</p>
                        </div>
                        @if($user->suffix)
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Suffix</label>
                            <p class="mb-0">{{ $user->suffix ?? 'N/A'}}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Contact Information</h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Email Address</label>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        @if($user->phone)
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Phone Number</label>
                            <p class="mb-0">{{ $user->phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Biography -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Bio</h5>
                    <p class="mb-0">{{ $user->bio ?: 'No biography provided.' }}</p>
                </div>
            </div>

            <!-- Digital Signature -->
            <div class="card shadow-sm rounded-3">
                <div class="card-body text-center p-3">
                    <h5 class="mb-3">Digital Signature</h5>
                    @if($user->signature)
                        <img src="{{ Storage::url($user->signature) }}"
                             alt="Signature"
                             class="img-fluid signature-img max-width-300">
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

<style>
.profile-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
}

.profile-placeholder {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    background: linear-gradient(145deg, #4361ee 0%, #3a0ca3 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .profile-img,
    .profile-placeholder {
        width: 100px;
        height: 100px;
    }

    .card {
        margin-bottom: 1rem;
    }
}

/* Dark mode */
@media (prefers-color-scheme: dark) {
    .card {
        background-color: #2b2d42;
        color: #e9ecef;
    }

    .border {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
}
</style>
@endsection
