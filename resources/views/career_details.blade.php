<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hiring->position }} - Job Details | MHRPCI Careers</title>
    <meta name="description" content="Join our team as a {{ $hiring->position }} at MHRPCI. Explore job details, requirements, and apply now!">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $hiring->position }} - Job Details | MHRPCI Careers" />
    <meta property="og:description" content="Join our team as a {{ $hiring->position }} at MHRPCI. Explore job details, requirements, and apply now!" />
    <meta property="og:image" content="{{ asset('path/to/your/image.jpg') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8b09db;
            --secondary-color: #00875A;
            --accent-color: #0065FF;
            --background-color: #F4F5F7;
            --text-color: #172B4D;
            --border-color: #DFE1E6;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            font-size: 16px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Times New Roman', Times, serif;
        }

        /* Enhanced Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--primary-color);
            font-family: 'Times New Roman', Times, serif;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 0.5rem;
        }

        .nav-link {
            color: var(--text-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.2s ease, background-color 0.2s ease;
            border-radius: 4px;
            font-size: 1.3rem;
            font-family: 'Times New Roman', Times, serif;
        }

        .nav-link:hover, .nav-link:focus {
            color: var(--accent-color);
            background-color: rgba(0, 101, 255, 0.1);
        }

        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Enhanced Job Header Styles */
        .job-header {
            background-color: white;
            padding: 3rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .job-title {
            font-size: 3rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .job-meta-item {
            display: flex;
            align-items: center;
            color: #5E6C84;
            font-size: 1.1rem;
        }

        .job-meta-item i {
            margin-right: 0.5rem;
            color: var(--secondary-color);
        }

        /* Enhanced Button Styles */
        .btn {
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #0747A6;
            border-color: #0747A6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 82, 204, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 82, 204, 0.3);
        }

        /* Enhanced Card Styles */
        .card {
            border: none;
            box-shadow: var(--card-shadow);
            border-radius: 8px;
            margin-bottom: 2rem;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-5px);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Enhanced List Styles */
        .custom-list {
            list-style: none;
            padding: 0;
        }

        .custom-list li {
            display: flex;
            align-items: start;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            font-size: 1.2rem;
        }

        .custom-list li:hover {
            background-color: rgba(0, 101, 255, 0.05);
        }

        .custom-list li i {
            color: var(--secondary-color);
            margin-right: 1rem;
            margin-top: 0.25rem;
        }

        /* Enhanced Related Jobs Styles */
        .related-job-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .related-job-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--hover-shadow);
        }

        /* Enhanced Modal Styles */
        .modal-content {
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 2rem;
        }

        /* Enhanced Form Styles */
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid var(--border-color);
            padding: 0.75rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 82, 204, 0.25);
        }

        /* Enhanced Accessibility */
        .btn:focus, .form-control:focus, .form-select:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(0, 82, 204, 0.25);
        }

        /* Enhanced Readability */
        .job-description, .list-group-item {
            font-size: 1.25rem;
            line-height: 1.8;
        }

        /* Sticky Apply Button for Mobile */
        @media (max-width: 768px) {
            .sticky-apply {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: white;
                padding: 1rem;
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                z-index: 1000;
            }
        }

        /* Enhanced Tooltip styles */
        .custom-tooltip {
            position: relative;
            display: inline-block;
        }

        .custom-tooltip .tooltip-text {
            visibility: hidden;
            width: 120px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.875rem;
        }

        .custom-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Enhanced button group styles */
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            width: 100%;
            max-width: 400px;
        }

        .btn-group > .btn {
            flex: 2;
        }

        .btn-group > .dropdown > .btn {
            flex: 1;
        }

        /* Animated placeholder for images */
        .img-placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: placeholderShimmer 1.5s infinite;
        }

        @keyframes placeholderShimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        /* Enhanced footer styles */
        footer {
            background: linear-gradient(135deg, #4a0082 0%, #8b09db 50%, #3498db 100%);
            color: #ffffff;
            padding: 4rem 0 2rem;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-col h4 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Footer Links */
        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
            display: inline-block;
            font-size: 1.1rem;
        }

        .footer-col a:hover {
            color: #ffffff;
            padding-left: 5px;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        /* Social Icons */
        .social-icons {
            margin-top: 1rem;
        }

        .social-icon {
            color: #ffffff;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icon:hover {
            color: #e0e0e0;
            transform: translateY(-3px);
        }

        .footer-bottom {
            margin-top: 2rem;
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Footer text */
        .footer-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Preloader Styles */
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

        /* MHR Loader */
        .mhr-loader {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .spinner {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #8e44ad;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .mhr-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: #8e44ad;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Update mobile styles */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .nav-link {
                font-size: 1.2rem;
            }
        }

        /* Enhanced Modal Styles */
        .modal-header.bg-gradient {
            background: linear-gradient(135deg, var(--primary-color) 0%, #6a0dad 100%);
            color: white;
            padding: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .form-section-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eee;
        }

        .form-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .form-control, .form-select {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-color: #e0e0e0;
            background-color: #f8f9fa;
        }

        .form-control:focus, .form-select:focus {
            background-color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(139, 9, 219, 0.15);
            border-color: var(--primary-color);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
            color: #6c757d;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-weight: 600;
        }

        .application-intro {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 6px;
            border-left: 4px solid var(--primary-color);
        }

        .selected-file-info {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #495057;
        }

        .selected-file-info i.fa-file-pdf {
            color: #dc3545;
        }

        .selected-file-info i.fa-file-word {
            color: #0d6efd;
        }

        .input-group .form-control[type="file"] {
            padding: 0.75rem;
            cursor: pointer;
        }

        .input-group .form-control[type="file"]::file-selector-button {
            padding: 0.375rem 0.75rem;
            margin: -0.375rem -0.75rem;
            margin-inline-end: 0.75rem;
            color: #212529;
            background-color: #e9ecef;
            pointer-events: none;
            border-color: inherit;
            border-style: solid;
            border-width: 0;
            border-inline-end-width: 1px;
            border-radius: 0;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .input-group .form-control[type="file"]:hover:not(:disabled):not([readonly])::file-selector-button {
            background-color: #dde0e3;
        }

        .form-text {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-text i {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="loader" class="loader">
        <div class="loader-content">
            <div class="mhr-loader">
                <div class="spinner"></div>
                <div class="mhr-text">MHR</div>
            </div>
            <h4 class="mt-4 text-dark">Loading...</h4>
        </div>
    </div>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHR Logo" class="d-inline-block align-top">
                    MHRPCI
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/careers">Careers</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('saved-jobs') ? 'active' : '' }}" href="{{ url('/saved-jobs') }}">
                                Saved Jobs
                                <span class="badge bg-primary saved-jobs-count">0</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Job Header -->
    <section class="job-header">
        <div class="container">
            <h1 class="job-title">{{ $hiring->position }}</h1>
            <div class="job-meta">
                <div class="job-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $hiring->location }}
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-briefcase"></i>
                    Full-time
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-clock"></i>
                    {{ $hiring->created_at->diffForHumans() }}
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-users"></i>
                    {{ $hiring->department }}
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal">
                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                </button>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-share-alt me-2"></i>Share
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="copyLink"><i class="fas fa-link me-2"></i>Copy Link</a></li>
                        <li><a class="dropdown-item" href="#" id="shareTwitter"><i class="fab fa-twitter me-2"></i>Twitter</a></li>
                        <li><a class="dropdown-item" href="#" id="shareLinkedIn"><i class="fab fa-linkedin me-2"></i>LinkedIn</a></li>
                        <li><a class="dropdown-item" href="#" id="shareFacebook"><i class="fab fa-facebook me-2"></i>Facebook</a></li>
                        <li><a class="dropdown-item" href="#" id="shareInstagram"><i class="fab fa-instagram me-2"></i>Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <!-- Job Details -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-file-alt me-2"></i>Job Description</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 job-description">{!! nl2br(e($hiring->description)) !!}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-check-circle me-2"></i>Qualifications</h2>
                    </div>
                    <div class="card-body">
                        <ul class="custom-list">
                            @foreach(explode("\n", $hiring->requirements) as $requirement)
                                @if(!empty(trim($requirement)))
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ trim($requirement) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-gift me-2"></i>Benefits</h2>
                    </div>
                    <div class="card-body">
                        <ul class="custom-list">
                            @foreach(explode("\n", $hiring->benefits) as $benefit)
                                @if(!empty(trim($benefit)))
                                    <li>
                                        <i class="fas fa-check"></i>
                                        <span>{{ trim($benefit) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-briefcase me-2"></i>Related Jobs</h2>
                    </div>
                    <div class="card-body">
                        @forelse($relatedJobs as $relatedJob)
                            @if($relatedJob->id !== $hiring->id)
                                <div class="card mb-3 border-0 shadow-sm related-job-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $relatedJob->position }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-2"></i>{{ $relatedJob->location }}
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ Str::limit($relatedJob->description, 100) }}
                                            </small>
                                        </p>
                                        <a href="{{ route('careers.show', $relatedJob->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-muted">No related jobs found at this time.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Enhanced Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>About MHRPCI</h4>
                    <p class="footer-text">MHR Property Conglomerates, Inc. is a dynamic group of companies with expertise across multiple industries, committed to innovation and excellence.</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="/#about">About Us</a></li>
                        <li><a href="/#subsidiaries">Our Subsidiaries</a></li>
                        <li><a href="/#properties">Properties</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p class="footer-text"><i class="fas fa-map-marker-alt"></i> {{ config('app.company_address') }}, {{ config('app.company_city') }}, Cebu, Philippines 6000</p>
                    <p class="footer-text"><i class="fas fa-phone"></i> {{ config('app.company_phone') }}</p>
                    <p class="footer-text"><i class="fas fa-envelope"></i> <a href="mailto:mhrpciofficial@gmail.com">{{ config('app.company_email') }}</a></p>
                </div>
                <div class="footer-col">
                    <h4>Connect With Us</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/mhrpciofficial" target="_blank" rel="noopener noreferrer" class="social-icon" title="Follow us on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@MHRPCI-tr3dy" target="_blank" rel="noopener noreferrer" class="social-icon" title="Subscribe to our YouTube channel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MHR Property Conglomerates, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient">
                    <h5 class="modal-title" id="applyModalLabel">
                        <i class="fas fa-paper-plane me-2"></i>Apply for {{ $hiring->position }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="application-intro mb-4">
                        <p class="text-muted">Please fill out the form below with your professional details. Fields marked with an asterisk (*) are required.</p>
                    </div>
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="hiring_id" value="{{ $hiring->id }}">

                        <!-- Personal Information Section -->
                        <div class="form-section mb-4">
                            <h6 class="form-section-title mb-3">Personal Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name"
                                        placeholder="Enter your first name" required>
                                    <div class="invalid-feedback">Please enter your first name.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name"
                                        placeholder="Enter your last name" required>
                                    <div class="invalid-feedback">Please enter your last name.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="form-section mb-4">
                            <h6 class="form-section-title mb-3">Contact Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="name@example.com" required>
                                    </div>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="+63 XXX XXX XXXX" required>
                                    </div>
                                    <div class="invalid-feedback">Please enter your phone number.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="form-section mb-4">
                            <h6 class="form-section-title mb-3">Professional Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin"
                                            placeholder="https://linkedin.com/in/yourprofile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience" class="form-label">Years of Experience *</label>
                                    <select class="form-select" id="experience" name="experience" required>
                                        <option value="">Select your experience</option>
                                        <option value="0-1">Less than 1 year</option>
                                        <option value="1-3">1-3 years</option>
                                        <option value="3-5">3-5 years</option>
                                        <option value="5+">More than 5 years</option>
                                    </select>
                                    <div class="invalid-feedback">Please select your years of experience.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="form-section mb-4">
                            <h6 class="form-section-title mb-3">Documents</h6>
                            <div class="mb-3">
                                <label for="resume" class="form-label">Resume (PDF/DOC/DOCX) *</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    <input type="file" class="form-control" id="resume" name="resume"
                                        accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Accepted formats: PDF, DOC, DOCX | Maximum file size: 5MB
                                </div>
                                <div class="invalid-feedback">Please upload your resume in PDF, DOC, or DOCX format.</div>
                            </div>
                            <div class="mb-3">
                                <label for="coverLetter" class="form-label">Cover Letter</label>
                                <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4"
                                    placeholder="Tell us why you're interested in this position and what makes you a great fit..."></textarea>
                                <div class="form-text">Maximum 500 characters</div>
                            </div>
                        </div>

                        <!-- Terms Section -->
                        <div class="form-section mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                                <label class="form-check-label" for="agreeTerms">
                                    I agree to the <a href="#" target="_blank">terms and conditions</a> and consent to the processing of my personal data *
                                </label>
                                <div class="invalid-feedback">You must agree to the terms and conditions.</div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Apply Button for Mobile -->
    <div class="sticky-apply d-md-none">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#applyModal">
            Apply Now
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader functionality
            window.addEventListener('load', function() {
                const loader = document.getElementById('loader');
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            });

            // If the page takes too long to load, hide the preloader after 1 second
            setTimeout(function() {
                const loader = document.getElementById('loader');
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }, 1000);

            // Form validation
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Social Sharing Functionality
            const shareData = {
                url: window.location.href,
                title: document.title,
                description: document.querySelector('meta[name="description"]')?.content || '',
                image: document.querySelector('meta[property="og:image"]')?.content || ''
            };

            function initializeSocialSharing() {
                document.getElementById('copyLink').addEventListener('click', handleCopyLink);
                document.getElementById('shareTwitter').addEventListener('click', handleTwitterShare);
                document.getElementById('shareLinkedIn').addEventListener('click', handleLinkedInShare);
                document.getElementById('shareFacebook').addEventListener('click', handleFacebookShare);
                document.getElementById('shareInstagram').addEventListener('click', handleInstagramShare);
            }

            function handleCopyLink(e) {
                e.preventDefault();
                copyToClipboard(shareData.url)
                    .then(() => showNotification('Success', 'Link copied to clipboard!'))
                    .catch(() => showNotification('Error', 'Failed to copy link. Please try again.'));
            }

            function handleTwitterShare(e) {
                e.preventDefault();
                const twitterUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareData.url)}&text=${encodeURIComponent(shareData.title)}`;
                openShareWindow(twitterUrl, 'Twitter');
            }

            function handleLinkedInShare(e) {
                e.preventDefault();
                const linkedInUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareData.url)}`;
                openShareWindow(linkedInUrl, 'LinkedIn');
            }

            function handleFacebookShare(e) {
                e.preventDefault();
                copyToClipboard(shareData.url)
                    .then(() => {
                        showNotification('Success', 'Link copied to clipboard. You can now paste this into your Facebook post.');
                        window.open('https://www.facebook.com', '_blank');
                    })
                    .catch(() => showNotification('Error', 'Failed to copy link. Please try again.'));
            }

            function handleInstagramShare(e) {
                e.preventDefault();
                copyToClipboard(shareData.url)
                    .then(() => showNotification('Success', 'Link copied! You can now paste this into your Instagram post or story.'))
                    .catch(() => showNotification('Error', 'Failed to copy link. Please try again.'));
            }

            function openShareWindow(url, platformName) {
                const width = 600;
                const height = 400;
                const left = (window.innerWidth / 2) - (width / 2);
                const top = (window.innerHeight / 2) - (height / 2);
                const options = `width=${width},height=${height},top=${top},left=${left},location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1`;
                window.open(url, `Share on ${platformName}`, options);
            }

            function copyToClipboard(text) {
                if (navigator.clipboard && window.isSecureContext) {
                    return navigator.clipboard.writeText(text);
                } else {
                    return new Promise((resolve, reject) => {
                        const textArea = document.createElement("textarea");
                        textArea.value = text;
                        textArea.style.position = "fixed";
                        textArea.style.left = "-999999px";
                        textArea.style.top = "-999999px";
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        try {
                            document.execCommand('copy') ? resolve() : reject();
                        } catch (error) {
                            reject(error);
                        } finally {
                            textArea.remove();
                        }
                    });
                }
            }

            function showNotification(type, message) {
                // Implement a more sophisticated notification system here
                // For example, you could use a library like toastr or create a custom notification component
                alert(`${type}: ${message}`);
            }

            // Initialize social sharing functionality
            initializeSocialSharing();

            // Smooth scroll to sections
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Lazy loading for images
            const images = document.querySelectorAll('img[data-src]');
            const config = {
                rootMargin: '0px 0px 50px 0px',
                threshold: 0
            };

            let observer = new IntersectionObserver(function (entries, self) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        preloadImage(entry.target);
                        self.unobserve(entry.target);
                    }
                });
            }, config);

            images.forEach(image => {
                observer.observe(image);
            });

            function preloadImage(img) {
                const src = img.getAttribute('data-src');
                if (!src) { return; }
                img.src = src;
            }

            // Enhanced form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // File input validation
            const resumeInput = document.getElementById('resume');
            resumeInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes

                if (file) {
                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        this.value = '';
                        showNotification('Error', 'Please upload a PDF, DOC, or DOCX file.');
                        return;
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        this.value = '';
                        showNotification('Error', 'File size must be less than 5MB.');
                        return;
                    }

                    // Show file name in a user-friendly way
                    const fileName = file.name;
                    const fileExtension = fileName.split('.').pop().toLowerCase();
                    let fileIcon = 'fa-file-pdf';

                    if (fileExtension === 'doc' || fileExtension === 'docx') {
                        fileIcon = 'fa-file-word';
                    }

                    // Update the input group with file information
                    const fileInfo = `
                        <div class="selected-file-info">
                            <i class="fas ${fileIcon} me-2"></i>
                            ${fileName}
                        </div>
                    `;

                    const fileInfoContainer = document.createElement('div');
                    fileInfoContainer.className = 'selected-file-feedback mt-2';
                    fileInfoContainer.innerHTML = fileInfo;

                    // Remove any existing file info
                    const existingFileInfo = this.parentElement.querySelector('.selected-file-feedback');
                    if (existingFileInfo) {
                        existingFileInfo.remove();
                    }

                    this.parentElement.appendChild(fileInfoContainer);
                }
            });

            // Character count for cover letter
            const coverLetter = document.getElementById('coverLetter');
            const maxChars = 500;
            coverLetter.addEventListener('input', function() {
                const remaining = maxChars - this.value.length;
                if (remaining < 0) {
                    this.value = this.value.slice(0, maxChars);
                    showNotification('Warning', `Cover letter is limited to ${maxChars} characters.`);
                }
            });
        });
    </script>
    @include('preloader')
</body>
</html>
