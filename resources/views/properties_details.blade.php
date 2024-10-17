<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->position }} - Property Details | MHRPCI Properties</title>
    <meta name="description" content="Join our team as a {{ $property->position }} at MHRPCI. Explore properties details.!">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $property->position }} - Property Details | MHRPCI Properties" />
    <meta property="og:description" content="Join our team as a {{ $property->position }} at MHRPCI. Explore properties details.!" />
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
            font-size: 1.2rem;
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
            font-size: 0.95rem;
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
            font-size: 0.95rem;
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
    </style>
</head>
<body>
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
                            <a class="nav-link active" href="/#properties">Properties</a>
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

    <div class="property-header bg-light py-4" style="margin-top: 60px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->property_name }}</li>
                </ol>
            </nav>
            <h1 class="property-title display-4 mb-3">{{ $property->property_name }}</h1>
            <div class="property-meta d-flex flex-wrap align-items-center mb-3">
                <span class="me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $property->location }}</span>
                <span class="me-4"><i class="fas fa-home text-primary me-2"></i> {{ ucfirst($property->type) }}</span>
                <span><i class="fas fa-calendar-alt text-primary me-2"></i> Listed on {{ $property->created_at->format('M d, Y') }}</span>
            </div>
            <div class="property-actions">
                <button class="btn btn-primary btn-lg me-2" data-bs-toggle="modal" data-bs-target="#contactModal">
                    <i class="fas fa-envelope me-2"></i>Contact Agent
                </button>
                <button class="btn btn-outline-primary btn-lg save-property" data-property-id="{{ $property->id }}">
                    <i class="fas fa-bookmark me-2"></i>
                    <span class="button-text">Save Property</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Property Description and Details Column -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div id="propertyImageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach(['main_image', 'first_image', 'second_image', 'third_image', 'fourth_image', 'fifth_image'] as $index => $image)
                                    @if($property->$image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $property->$image) }}" class="d-block w-100" alt="{{ $property->property_name }} - Image {{ $index + 1 }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#propertyImageCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-4">Property Description</h2>
                        <div class="property-description">
                            {!! nl2br(e($property->description)) !!}
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-4">Property Details</h2>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p><strong>Type:</strong> {{ ucfirst($property->type) }}</p>
                                <p><strong>Location:</strong> {{ $property->location }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>Contact Info:</strong> {{ $property->contact_info }}</p>
                                <p><strong>Email:</strong> {{ $property->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more sections as needed, e.g., Amenities, Location Map, etc. -->
            </div>

            <!-- Related Properties Column -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title h4 mb-4">Related Properties</h3>
                        <div class="related-properties-container">
                            @forelse($relatedProperties as $relatedProperty)
                                <div class="card mb-3 border-0 shadow-sm related-property-item">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="{{ asset('storage/' . $relatedProperty->main_image) }}" class="img-fluid rounded-start" alt="{{ $relatedProperty->property_name }}">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h5 class="card-title h6">{{ $relatedProperty->property_name }}</h5>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="fas fa-map-marker-alt me-2"></i>{{ $relatedProperty->location }}
                                                    </small>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <i class="fas fa-home me-2"></i>{{ ucfirst($relatedProperty->type) }}
                                                    </small>
                                                </p>
                                                <a href="{{ route('properties.details', $relatedProperty->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No related properties found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Add a contact form or additional information here -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title h4 mb-4">Quick Contact</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        // Add your JavaScript here
        // Example: Preloader script
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        // Add more scripts as needed
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navLinks = document.getElementById('navLinks');
            const userInfo = document.querySelector('.user-info');
            const userDropdown = document.querySelector('.user-dropdown');

            mobileMenuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('show');
            });

            // Close menu when a link is clicked
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('show');
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!event.target.closest('nav') && navLinks.classList.contains('show')) {
                    navLinks.classList.remove('show');
                }
            });

            if (userInfo) {
                userInfo.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('active');
                });

                document.addEventListener('click', function(e) {
                    if (!userInfo.contains(e.target)) {
                        userDropdown.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>
</html>
