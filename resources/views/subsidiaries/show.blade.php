@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Back button -->
            <div class="mb-4">
                <a href="{{ route('subsidiaries.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Subsidiaries
                </a>
            </div>

            <div class="card shadow-sm mb-4 mb-md-5">
                <div class="card-body p-3 p-md-4">
                    <div class="row">
                        <div class="col-md-8 order-2 order-md-1 mt-4 mt-md-0">
                            <h1 class="h2 mb-3 mb-md-4">{{ $subsidiary->name }}</h1>
                            <p class="lead text-muted mb-4">{{ $subsidiary->description }}</p>
                            <div class="row mb-4">
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-uppercase text-muted">Abbreviation</h6>
                                    <p class="mb-0">{{ $subsidiary->abbr }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-uppercase text-muted">Contact No</h6>
                                    <p class="mb-0">{{ $subsidiary->contact_no }}</p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-uppercase text-muted">Email Address</h6>
                                    <p class="mb-0"><a href="mailto:{{ $subsidiary->email_address }}" class="text-reset">{{ $subsidiary->email_address }}</a></p>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h6 class="text-uppercase text-muted">Facebook Page</h6>
                                    <p class="mb-0"><a href="{{ $subsidiary->facebook_page }}" target="_blank" class="text-reset">Visit Page</a></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-uppercase text-muted">Website</h6>
                                    <p class="mb-0"><a href="{{ $subsidiary->website }}" target="_blank" class="text-reset">{{ $subsidiary->website }}</a></p>
                                </div>
                            </div>

                            <!-- Additional details -->
                            <div class="mt-4">
                                <h5 class="text-uppercase text-muted mb-3">Additional Information</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>CEO:</strong> {{ $subsidiary->ceo_name }}</li>
                                    <li class="mb-2"><strong>Number of Employees:</strong> {{ number_format($subsidiary->employee_count) }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 order-1 order-md-2">
                            <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="{{ $subsidiary->name }}" class="img-fluid rounded shadow-sm mb-4">

                            <!-- Quick links -->
                            <div class="list-group">
                                <a href="{{ $subsidiary->website }}" target="_blank" class="list-group-item list-group-item-action">
                                    <i class="fas fa-globe mr-2"></i> Visit Website
                                </a>
                                <a href="{{ $subsidiary->facebook_page }}" target="_blank" class="list-group-item list-group-item-action">
                                    <i class="fab fa-facebook mr-2"></i> Facebook Page
                                </a>
                                <a href="mailto:{{ $subsidiary->email_address }}" class="list-group-item list-group-item-action">
                                    <i class="fas fa-envelope mr-2"></i> Send Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="h3 mb-4">Additional Images</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @php
                    $images = [
                        'first_image' => 'First Image',
                        'second_image' => 'Second Image',
                        'third_image' => 'Third Image'
                    ];
                @endphp

                @foreach($images as $image => $label)
                    @if($subsidiary->$image)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $subsidiary->$image) }}" alt="{{ $label }}" class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text text-muted">{{ $label }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
