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
            --primary-color: #0052CC;
            --secondary-color: #00875A;
            --accent-color: #0065FF;
            --background-color: #F4F5F7;
            --text-color: #172B4D;
            --border-color: #DFE1E6;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
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
            font-size: 2.5rem;
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
            font-size: 0.95rem;
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
            font-size: 1.25rem;
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
            font-size: 1.1rem;
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
        }

        .btn-group > .btn,
        .btn-group > .dropdown > .btn {
            flex: 1;
            min-width: 120px;
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
            background-color: #2C3E50;
            color: #ECF0F1;
            padding: 3rem 0;
        }

        .footer-heading {
            color: #3498DB;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-link {
            color: #ECF0F1;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #3498DB;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            color: #ECF0F1;
            font-size: 1.5rem;
            transition: color 0.2s ease;
        }

        .social-icons a:hover {
            color: #3498DB;
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
                @auth('google')
                    <button class="btn btn-outline-primary save-job-btn" data-hiring-id="{{ $hiring->id }}" data-saved="{{ in_array($hiring->id, $savedJobs) ? 'true' : 'false' }}">
                        <i class="fas fa-bookmark me-2"></i>
                        <span class="save-job-text">
                            {{ in_array($hiring->id, $savedJobs) ? 'Unsave Job' : 'Save Job' }}
                        </span>
                    </button>
                @else
                    <a href="{{ url('http://localhost:8080/auth/google') }}" class="btn btn-outline-primary">
                        <i class="fab fa-google me-2"></i>Login with Google to save jobs
                    </a>
                @endauth
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
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-heading">About MHRPCI</h5>
                    <p>MHRPCI is a leading company dedicated to innovation and excellence in human resources solutions.</p>
                    <div class="social-icons mt-3">
                        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-heading">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link">Home</a></li>
                        <li><a href="#" class="footer-link">About Us</a></li>
                        <li><a href="#" class="footer-link">Services</a></li>
                        <li><a href="#" class="footer-link">Careers</a></li>
                        <li><a href="#" class="footer-link">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-heading">Contact Us</h5>
                    <address>
                        <p><i class="fas fa-map-marker-alt me-2"></i> 123 Main St, City, Country</p>
                        <p><i class="fas fa-phone me-2"></i> +1 (123) 456-7890</p>
                        <p><i class="fas fa-envelope me-2"></i> info@mhrpci.com</p>
                    </address>
                </div>
            </div>
            <hr class="mt-4 mb-3">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; 2024 MHRPCI. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="footer-link me-3">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for {{ $hiring->position }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="hiring_id" value="{{ $hiring->id }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                                <div class="invalid-feedback">Please enter your first name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                            <div class="invalid-feedback">Please enter your phone number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn Profile (optional)</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin">
                        </div>
                        <div class="mb-3">
                            <label for="experience" class="form-label">Years of Experience</label>
                            <select class="form-select" id="experience" name="experience" required>
                                <option value="">Select experience</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-3">1-3 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5+">5+ years</option>
                            </select>
                            <div class="invalid-feedback">Please select your years of experience.</div>
                        </div>
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume (PDF)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf" required>
                            <div class="invalid-feedback">Please upload your resume in PDF format.</div>
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter (optional)</label>
                            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the <a href="#" target="_blank">terms and conditions</a></label>
                            <div class="invalid-feedback">You must agree to the terms and conditions.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
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

            // Save/Unsave Job Functionality
            $('.save-job-btn').on('click', function() {
                var button = $(this);
                var hiringId = button.data('hiring-id');
                var isSaved = button.data('saved') === 'true';

                axios.post('{{ route("toggle.save.job") }}', {
                    hiring_id: hiringId,
                })
                .then(function (response) {
                    if (response.data.isSaved) {
                        button.data('saved', 'true');
                        button.find('.save-job-text').text('Unsave Job');
                        button.removeClass('btn-outline-primary').addClass('btn-primary');
                    } else {
                        button.data('saved', 'false');
                        button.find('.save-job-text').text('Save Job');
                        button.removeClass('btn-primary').addClass('btn-outline-primary');
                    }
                    updateSavedJobsCount(response.data.savedJobsCount);
                    showNotification('Success', response.data.message);
                })
                .catch(function (error) {
                    console.error('Error toggling job save status:', error);
                    showNotification('Error', 'An error occurred. Please try again.');
                });
            });

            function updateSavedJobsCount(count) {
                $('.saved-jobs-count').text(count);
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
                if (file && file.type !== 'application/pdf') {
                    resumeInput.value = '';
                    showNotification('Error', 'Please upload a PDF file.');
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
