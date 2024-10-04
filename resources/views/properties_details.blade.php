<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->property_name }} - Property Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Copy the styles from the job details page and adjust as needed */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .property-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 0;
            position: relative;
            overflow: hidden;
        }
        .property-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image: radial-gradient(circle, #4a90e2 10%, transparent 10%),
                              radial-gradient(circle, #4a90e2 10%, transparent 10%);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            opacity: 0.05;
            transform: rotate(45deg);
            z-index: 0;
        }
        .property-header .container {
            position: relative;
            z-index: 1;
        }
        .property-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        .property-meta {
            color: #6c757d;
        }
        .property-actions {
            margin-top: 20px;
        }
        .btn-contact {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }
        .btn-contact:hover {
            background-color: #3a7bd5;
            border-color: #3a7bd5;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #4a90e2;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 10px;
        }
        .property-image {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .property-image img {
            width: 100%;
            height: auto;
        }
        .property-details p {
            margin-bottom: 10px;
        }
        .related-properties {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 20px;
        }
        /* Add any additional styles here */

        /* Add these new styles */
        .carousel-item {
            height: 400px; /* Adjust this value as needed */
            overflow: hidden;
        }
        .carousel-item img {
            object-fit: cover;
            object-position: center;
            width: 100%;
            height: 100%;
        }

        /* Navigation styles */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .app-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4a90e2;
        }

        .nav-links {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-left: 2rem;
            position: relative;
        }

        .nav-links a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 0.5rem 0;
            display: inline-block;
        }

        .nav-links a:hover {
            color: #4a90e2;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #4a90e2;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .nav-links a:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.25em 0.6em;
            border-radius: 50%;
            vertical-align: top;
            margin-left: 5px;
            background-color: #4a90e2;
            color: white;
        }

        .saved-properties-count {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: #4a90e2;
            cursor: pointer;
        }

        /* Auth buttons styles */
        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            position: relative;
        }

        .user-info .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-info .user-name {
            font-weight: 600;
            color: #333;
            cursor: pointer;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .user-dropdown.active {
            display: block;
        }

        .logout-form {
            padding: 10px;
        }

        .logout-btn {
            background-color: #4a90e2;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #3a7bd5;
        }

        .google-login-btn {
            display: flex;
            align-items: center;
            background-color: #4285F4;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .google-login-btn i {
            margin-right: 10px;
        }

        .google-login-btn:hover {
            background-color: #3367D6;
        }

        @media (max-width: 768px) {
            nav {
                padding: 0.5rem 1rem;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #ffffff;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                margin: 0;
            }

            .nav-links a {
                padding: 1rem;
                display: block;
                border-bottom: 1px solid #f0f0f0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .auth-buttons {
                margin-top: 10px;
            }

            .user-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-info .avatar {
                margin-right: 0;
                margin-bottom: 5px;
            }

            .user-dropdown {
                width: 100%;
            }
        }

        /* ... rest of your existing styles ... */
    </style>
</head>
<body>
    <!-- Add preloader HTML -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Add shape overlays -->
    <div class="shape-overlay shape-1"></div>
    <div class="shape-overlay shape-2"></div>
    <div class="shape-overlay shape-3"></div>
    <div class="shape-overlay shape-4"></div>

    <header>
        <nav>
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHR Logo">
                </div>
                <div class="app-name">
                    MHRPCI
                </div>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/properties') }}" class="{{ request()->is('properties*') ? 'active' : '' }}">Properties</a></li>
                <li>
                    <a href="{{ url('/saved-properties') }}" class="{{ request()->is('saved-properties') ? 'active' : '' }}">
                        Saved Properties
                        <span class="badge saved-properties-count">0</span>
                    </a>
                </li>
            </ul>
            <div class="auth-buttons">
                @if(Auth::guard('google')->check())
                    <div class="user-info">
                        <img src="{{ Auth::guard('google')->user()->avatar }}" alt="{{ Auth::guard('google')->user()->name }}" class="avatar">
                        <span class="user-name">{{ Auth::guard('google')->user()->name }}</span>
                        <div class="user-dropdown">
                            <form action="{{ route('google.logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('google.login') }}" class="google-login-btn">
                        <i class="fab fa-google"></i> Login with Google
                    </a>
                @endif
            </div>
            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <div class="property-header" style="margin-top: 60px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->property_name }}</li>
                </ol>
            </nav>
            <h1 class="property-title">{{ $property->property_name }}</h1>
            <div class="property-meta">
                <span class="me-3"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</span>
                <span><i class="fas fa-home"></i> {{ ucfirst($property->type) }}</span>
            </div>
            <div class="property-actions">
                <button class="btn btn-primary btn-contact" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Agent</button>
                <button class="btn btn-outline-secondary save-property" data-property-id="{{ $property->id }}">
                    <i class="fas fa-bookmark me-1"></i>
                    <span class="button-text">Save</span>
                </button>
                <!-- Add share button if needed -->
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Property Description and Details Column -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
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

                        <h2 class="section-title mt-4">Property Description</h2>
                        <div class="property-description">
                            {!! nl2br(e($property->description)) !!}
                        </div>

                        <h2 class="section-title mt-5">Property Details</h2>
                        <div class="property-details">
                            <p><strong>Type:</strong> {{ ucfirst($property->type) }}</p>
                            <p><strong>Location:</strong> {{ $property->location }}</p>
                            <p><strong>Contact Info:</strong> {{ $property->contact_info }}</p>
                            <p><strong>Email:</strong> {{ $property->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Properties Column -->
            <div class="col-lg-4">
                <div class="card related-properties-card h-100">
                    <div class="card-body">
                        <h3 class="section-title">Related Properties</h3>
                        <div class="related-properties-container">
                            @forelse($relatedProperties as $relatedProperty)
                                <div class="card mb-3 border-0 shadow-sm related-property-item">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $relatedProperty->property_name }}</h5>
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
                            @empty
                                <p>No related properties found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
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
