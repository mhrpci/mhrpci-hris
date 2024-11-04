<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHRPCI Careers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8b09db;
            --secondary-color: #6c757d;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --gray: #6c757d;
            --gradient-start: #8b09db;
            --gradient-end: #4a90e2;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
        }

        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: var(--text-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            font-size: 1.3rem;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color);
        }

        .hero {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: var(--white);
            padding: 6rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 100px;
            background: var(--light-bg);
            transform: skewY(-3deg);
        }

        .hero h1 {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 3rem;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .career-item {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .career-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .career-item h2 {
            color: var(--primary-color);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .career-item-content {
            padding: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border: none;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--gradient-end) 0%, var(--gradient-start) 100%);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--gradient-start);
            border: 2px solid var(--gradient-start);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: var(--white);
            border-color: transparent;
            transform: translateY(-2px);
        }

        #careerSearch {
            border-radius: 50px;
            padding: 1rem 1.5rem;
            border: 2px solid var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        #careerSearch:focus {
            box-shadow: 0 0 0 0.25rem rgba(0,86,179,0.25);
        }

        .footer {
            background-color: var(--white);
            color: var(--gray);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                background-color: var(--white);
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .hero {
                padding: 4rem 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .career-item {
                margin-bottom: 1.5rem;
            }

            .navbar-nav .nav-link {
                font-size: 1.1rem;
            }
        }

        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        @media (max-width: 767.98px) {
            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .card-text {
                font-size: 0.85rem;
            }

            .btn-sm {
                padding: 0.2rem 0.4rem;
                font-size: 0.8rem;
            }
        }

        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: none;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .card-text {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.5em 0.75em;
            border-radius: 50px;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 50px;
        }

        .save-job-btn {
            transition: color 0.2s ease-in-out;
        }

        .save-job-btn:hover {
            color: var(--primary-color) !important;
        }

        @media (max-width: 767.98px) {
            .card-body {
                padding: 1.25rem;
            }

            .card-title {
                font-size: 1.1rem;
            }

            .card-text {
                font-size: 0.85rem;
            }

            .btn-sm {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        /* Updated Preloader Styles */
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
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
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
            border-top: 4px solid var(--gradient-end);
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
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .btn-google-auth {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #fff;
            color: #3c4043;
            border: 1px solid #dadce0;
            border-radius: 24px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s, box-shadow 0.2s;
        }

        .btn-google-auth:hover {
            background-color: #f8f9fa;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
        }

        .google-icon {
            margin-right: 8px;
        }

        /* Enhanced Footer Styles */
        footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, #4a90e2 100%);
            color: var(--white);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-col h4 {
            color: var(--white);
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .footer-text {
            font-size: 0.9rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col ul li {
            margin-bottom: 0.5rem;
        }

        .footer-col ul li a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .footer-col ul li a:hover {
            opacity: 0.8;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icon:hover {
            color: var(--white);
        }

        .footer-bottom {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHR Logo" height="30" class="d-inline-block align-top me-2">
                MHRPCI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('careers*') ? 'active' : '' }}" href="{{ url('/careers') }}">Careers</a>
                    </li>
                </ul>
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    @if(Auth::guard('google')->check())
                        <div class="d-flex align-items-center">
                            <img src="{{ Auth::guard('google')->user()->avatar }}" alt="{{ Auth::guard('google')->user()->name }}" class="rounded-circle me-2" width="24" height="24">
                            <span class="me-3">{{ Auth::guard('google')->user()->name }}</span>
                            {{-- <form action="{{ route('google.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">Logout</button>
                            </form> --}}
                        </div>
                    @else
                        <a href="{{ route('google.login') }}" class="btn btn-google-auth">
                            <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                            </svg>
                            Sign in with Google
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container text-center">
            <h1>Join Our Team</h1>
            <p class="lead">Discover exciting career opportunities and help shape the future of MHR Property Conglomerates, Inc.</p>
        </div>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <input type="text" id="careerSearch" class="form-control form-control-lg" placeholder="Search for positions...">
        </div>

        @if($hirings->count() > 0)
            <div class="row g-4" id="careerList">
                @foreach($hirings as $hiring)
                    <div class="col-12 col-md-6 col-lg-4 career-item-container">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title h5 text-primary mb-3">{{ $hiring->position }}</h2>
                                <p class="card-text mb-3 flex-grow-1 text-secondary">{{ Str::limit($hiring->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ Str::limit($hiring->location, 45) }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-clock me-1"></i> {{ $hiring->employment_type }}
                                    </span>
                                </div>
                                <div class="d-flex gap-2 mt-auto">
                                    @if(Auth::guard('google')->check())
                                    <a href="{{ route('careers.show', $hiring->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">
                                        <i class="fas fa-info-circle me-1"></i> View Details
                                    </a>
                                    @else
                                    <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#loginModal" data-hiring-id="{{ $hiring->id }}">
                                        <i class="fas fa-info-circle me-1"></i> View Details
                                    </a>
                                    @endif
                                    @if(Auth::guard('google')->check())
                                        <button class="btn btn-primary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#applyModal" data-career-id="{{ $hiring->id }}">
                                            <i class="fas fa-paper-plane me-1"></i> Apply Now
                                        </button>
                                    @else
                                        <button class="btn btn-primary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="fas fa-paper-plane me-1"></i> Apply Now
                                        </button>
                                    @endif
                                </div>
                                {{-- @if(Auth::guard('google')->check())
                                    <button class="btn btn-link btn-sm text-muted mt-2 save-job-btn" data-hiring-id="{{ $hiring->id }}" data-saved="{{ in_array($hiring->id, $savedJobs) ? 'true' : 'false' }}">
                                        <i class="fas {{ in_array($hiring->id, $savedJobs) ? 'fa-bookmark' : 'fa-bookmark-o' }} me-1"></i>
                                        {{ in_array($hiring->id, $savedJobs) ? 'Saved' : 'Save Job' }}
                                    </button>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <p class="mb-0">There are currently no open positions. Please check back later.</p>
            </div>
        @endif
    </div>
    <!-- Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hiring_id" id="hiringIdInput">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn Profile (optional)</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="Enter your LinkedIn profile URL">
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
                        </div>
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume (PDF)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf" required>
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter (optional)</label>
                            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4" placeholder="Enter your cover letter"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the <a href="#" target="_blank">terms and conditions</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-1"></i> Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Sign In to Apply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-4">Please sign in with your Google account to apply for this position.</p>
                    <a href="{{ route('google.login') }}" class="btn btn-google-auth btn-lg">
                        <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                        </svg>
                        Sign in with Google
                    </a>
                    <p class="mt-3 text-muted small">By signing in, you agree to our <a href="{{ route('terms') }}" target="_blank">Terms of Service</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>.</p>
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
                    <p class="footer-text"><i class="fas fa-envelope"></i> <a href="mailto:{{ config('app.company_email') }}" style="color: white">{{ config('app.company_email') }}</a></p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loader = document.getElementById('loader');

            // Smooth fade out after 1 second
            setTimeout(function() {
                loader.classList.add('fade-out');
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500); // Match this to the transition duration in CSS
            }, 1000);

            var applyModal = document.getElementById('applyModal');
            applyModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var careerId = button.getAttribute('data-career-id');
                var hiringIdInput = document.getElementById('hiringIdInput');
                hiringIdInput.value = careerId;
            });

            var alertElements = document.querySelectorAll('.alert');
            alertElements.forEach(function(alertElement) {
                setTimeout(function() {
                    var alert = new bootstrap.Alert(alertElement);
                    alert.close();
                }, 5000);
            });

            var mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            var navLinks = document.querySelector('.nav-links');

            mobileMenuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('show');
                this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!navLinks.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                    navLinks.classList.remove('show');
                    mobileMenuToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Highlight current page in navigation
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-links a').forEach(link => {
                if (link.classList.contains('active')) {
                    link.setAttribute('aria-current', 'page');
                }
            });

        });
    </script>
    <script>
            // Allow right-click but prevent default context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault(); // Prevent the default context menu
                // Custom context menu logic can be added here if needed
            });

            // Disable F12, Ctrl+Shift+I, Ctrl+U
            document.addEventListener('keydown', function(e) {
                if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I') || (e.ctrlKey && e.key === 'U')) {
                    e.preventDefault();
                }
            });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('careerSearch');
    const careerList = document.getElementById('careerList');
    const careerItems = careerList.getElementsByClassName('career-item-container');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        Array.from(careerItems).forEach(function(item) {
            const position = item.querySelector('h2').textContent.toLowerCase();
            const description = item.querySelector('p').textContent.toLowerCase();

            if (position.includes(searchTerm) || description.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });

        // Show a message if no results are found
        const visibleItems = Array.from(careerItems).filter(item => item.style.display !== 'none');
        if (visibleItems.length === 0) {
            let noResultsMessage = document.getElementById('noResultsMessage');
            if (!noResultsMessage) {
                noResultsMessage = document.createElement('div');
                noResultsMessage.id = 'noResultsMessage';
                noResultsMessage.className = 'alert alert-info text-center mt-4';
                noResultsMessage.innerHTML = '<p class="mb-0">No positions found matching your search.</p>';
                careerList.parentNode.insertBefore(noResultsMessage, careerList.nextSibling);
            }
            noResultsMessage.style.display = '';
        } else {
            const existingMessage = document.getElementById('noResultsMessage');
            if (existingMessage) {
                existingMessage.style.display = 'none';
            }
        }
    });
});
    </script>
    <script>
        $(document).ready(function() {
            $('.save-job-btn').on('click', function() {
                var button = $(this);
                var hiringId = button.data('hiring-id');

                $.ajax({
                    url: '{{ route("toggle.save.job") }}',
                    method: 'POST',
                    data: {
                        hiring_id: hiringId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.isSaved) {
                            button.text('Unsave Job');
                            button.data('saved', 'true');
                        } else {
                            button.text('Save Job');
                            button.data('saved', 'false');
                        }
                        alert(response.message);
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
    @include('preloader')
</body>
</html>
