<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Jobs - MHR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f39c12;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --gray: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header and Navigation styles */
        header {
            background-color: var(--white);
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
            color: var(--primary-color);
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
            color: var(--text-color);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 0.5rem 0;
            display: inline-block;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .nav-links a:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .nav-links a.active {
            color: var(--primary-color);
            font-weight: 700;
        }

        .nav-links a.active::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.25em 0.6em;
            border-radius: 50%;
            vertical-align: top;
            margin-left: 5px;
            background-color: var(--primary-color);
            color: var(--white);
        }

        .saved-jobs-count {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
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
                background-color: var(--white);
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
        }

        /* Content styles */
        .content-wrapper {
            flex: 1;
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .saved-job-item {
            background-color: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .saved-job-item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        .saved-job-item h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .saved-job-item p {
            color: var(--gray);
            margin-bottom: 20px;
        }

        /* Button styles */
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        /* Footer styles */
        footer {
            background-color: var(--white);
            color: var(--gray);
            padding: 20px 0;
            text-align: center;
        }

        /* Background shapes */
        .bg-shape {
            position: fixed;
            z-index: -1;
        }

        .bg-shape-1 {
            top: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            background-color: rgba(74, 144, 226, 0.1);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        .bg-shape-2 {
            bottom: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background-color: rgba(243, 156, 18, 0.1);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
                font-size: 1.5rem;
                color: var(--primary-color);
                cursor: pointer;
            }

            .mobile-menu {
                display: none;
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                background-color: var(--white);
                padding: 1rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .mobile-menu.show {
                display: block;
            }

            .mobile-menu a {
                display: block;
                padding: 0.5rem 0;
                color: var(--text-color);
                text-decoration: none;
                font-weight: 500;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        /* Add these preloader styles */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid var(--primary-color);
            border-top: 3px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Google Auth Styles */
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
            color: var(--text-color);
            cursor: pointer;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
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
            background-color: var(--primary-color);
            color: var(--white);
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
            color: var(--white);
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
    </style>
</head>
<body>
    <!-- Add this preloader HTML right after the opening body tag -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>

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
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/careers') }}" class="{{ request()->is('careers') ? 'active' : '' }}">Careers</a></li>
                <li><a href="{{ url('/saved-jobs') }}" class="{{ request()->is('saved-jobs') ? 'active' : '' }}">Saved Jobs </a></li>
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
            <div class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <h1 class="mb-4 text-center">Your Saved Jobs</h1>

            @if($savedJobs->count() > 0)
                <div class="row">
                    @foreach($savedJobs as $job)
                        <div class="col-md-6 mb-4">
                            <div class="saved-job-item">
                                <h2 class="h4">{{ $job->position }}</h2>
                                <p>{{ Str::limit($job->description, 150) }}</p>
                                <a href="{{ route('careers.show', $job->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-info-circle me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    <p class="mb-0">You haven't saved any jobs yet. <a href="{{ url('/careers') }}">Browse available positions</a>.</p>
                </div>
            @endif
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} MHR. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add this preloader script at the beginning of your existing script
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced mobile menu toggle
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
                }
            });

            // Allow right-click but prevent default context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            // Disable F12, Ctrl+Shift+I, Ctrl+U
            document.addEventListener('keydown', function(e) {
                if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I') || (e.ctrlKey && e.key === 'U')) {
                    e.preventDefault();
                }
            });

            const userInfo = document.querySelector('.user-info');
            const userDropdown = document.querySelector('.user-dropdown');

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
