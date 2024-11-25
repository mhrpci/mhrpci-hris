<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHR Property Conglomerate Inc. (MHRPCI)</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.8;
            color: #2c3e50;
            background-color: #f9fafb;
            font-size: 18px;
        }
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Updated Header styles */
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            padding: 1.25rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s;
        }
        .logo:hover {
            color: #f0f0f0;
        }
        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        .nav-link:hover {
            color: #8b09db;
            background-color: #ffffff;
        }

        /* Hero section styles */
        .hero-section {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            padding: 200px 0 120px;
            text-align: center;
        }
        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .hero-text h1 {
            font-size: 3.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .hero-text h3 {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.95;
            max-width: 600px;
            margin-bottom: 30px;
        }
        .hero-image img {
            max-width: 100%;
            height: auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        /* Main content styles */
        .main-content {
            padding: 60px 0;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .about-section, .related-subsidiaries {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 1px solid #f0f0f0;
            transition: transform 0.3s ease;
        }
        .about-section:hover, .related-subsidiaries:hover {
            transform: translateY(-5px);
        }
        h2 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #8b09db;
        }
        h2::after {
            display: none;
        }
        p {
            margin-bottom: 20px;
            line-height: 1.8;
        }
        ul {
            list-style-type: none;
        }
        li {
            margin-bottom: 15px;
            padding-left: 25px;
            position: relative;
        }
        li::before {
            content: '\f054';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            color: #8b09db;
        }

        /* Subsidiary card styles */
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .subsidiary-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .subsidiary-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .subsidiary-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 15px;
        }
        .subsidiary-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 20px;
        }
        .subsidiary-card p {
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }
        .btn-primary {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #8b09db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(139, 9, 219, 0.2);
        }
        .btn-primary:hover {
            background-color: #a64dff;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Footer styles */
        .footer {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: #ffffff;
            padding: 5rem 0 2rem;
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .footer-section h2 {
            color: #ffffff;
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }
        .footer-section h2::after {
            background-color: #fff;
        }
        .footer-section p {
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }
        .footer-section a {
            color: #fff;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .footer-section a:hover {
            opacity: 0.8;
        }
        .footer-bottom {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            opacity: 0.8;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }
            .hero-text h3 {
                font-size: 1rem;
            }
            .content-grid, .footer-content {
                grid-template-columns: 1fr;
            }
            .about-section, .related-subsidiaries {
                padding: 20px;
            }
            .subsidiary-card {
                padding: 15px;
            }
        }
        @media (min-width: 1024px) {
            .hero-content {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
            }
            .hero-text {
                max-width: 60%;
            }
            .hero-image {
                margin-left: 40px;
            }
        }

        /* Add these new styles before the responsive styles */
        .timeline-section {
            padding: 50px 0;
            position: relative;
        }

        .timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            background: #8b09db;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline-item {
            padding: 20px 40px;
            position: relative;
            width: 50%;
            margin-bottom: 40px;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
        }

        .timeline-content {
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: relative;
            border: 1px solid #f0f0f0;
        }

        .timeline-content::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #8b09db;
            border-radius: 50%;
            top: 50%;
        }

        .timeline-item:nth-child(odd) .timeline-content::after {
            right: -60px;
            transform: translateY(-50%);
        }

        .timeline-item:nth-child(even) .timeline-content::after {
            left: -60px;
            transform: translateY(-50%);
        }

        .timeline-year {
            font-size: 2rem;
            font-weight: 600;
            color: #8b09db;
            margin-bottom: 0.75rem;
        }

        /* Add this to your existing media queries */
        @media (max-width: 768px) {
            .timeline::before {
                left: 30px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 20px;
            }

            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                left: 0;
                text-align: left;
            }

            .timeline-item:nth-child(odd) .timeline-content::after,
            .timeline-item:nth-child(even) .timeline-content::after {
                left: -50px;
                transform: translateY(-50%);
            }
        }

        /* Add spacing utilities */
        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .py-6 {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        :root {
            --primary-color: #8b09db;
            --secondary-color: #f39c12;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
        }

        /* Header and Navigation */
        header {
            background: #ffffff;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo img {
            height: 35px;
            width: auto;
        }

        .app-name {
            color: #8b09db;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-links li {
            margin: 0 1rem;
            padding: 0;
        }

        .nav-links li::before {
            display: none;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary-color);
            opacity: 1;
        }

        /* Google Sign In Button */
        .google-login-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #ffffff;
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .google-login-btn:hover {
            background-color: #f5f5f5;
        }

        .google-login-btn i {
            color: #4285f4;
        }

        /* Mobile Menu */
        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .auth-buttons {
                display: none;
            }

            .hamburger {
                display: block;
                margin-left: auto;
            }

            /* Mobile Sidebar Styles */
            .sidebar {
                padding-top: 1rem;
            }

            .sidebar .nav-links {
                display: flex;
                flex-direction: column;
                padding: 1rem;
            }

            .sidebar .nav-links li {
                margin: 0.5rem 0;
                width: 100%;
            }

            .sidebar .nav-links a {
                color: #333;
                display: block;
                padding: 0.75rem 1rem;
                border-radius: 4px;
            }

            .sidebar .nav-links a:hover {
                color: var(--primary-color);
                background: var(--light-bg);
            }

            /* Mobile Auth Buttons */
            .sidebar .auth-buttons {
                display: flex;
                flex-direction: column;
                padding: 1rem;
            }

            .sidebar .google-login-btn {
                width: 100%;
                justify-content: center;
            }

            .sidebar .user-info {
                width: 100%;
                justify-content: space-between;
            }
        }

        /* Larger screens */
        @media (min-width: 769px) {
            .sidebar {
                display: none;
            }

            .hamburger {
                display: none;
            }

            .nav-links {
                display: flex !important;
            }

            .auth-buttons {
                display: flex !important;
            }
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            background-color: var(--white);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
            z-index: 1001;
            overflow-y: auto;
            padding-top: 1rem;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar .nav-links {
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar .nav-links li {
            margin: 0.5rem 0;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .overlay.active {
            display: block;
        }

        /* Update these styles in your CSS */
        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-name {
            color: #333;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Update mobile styles */
        @media (max-width: 768px) {
            .user-info {
                padding: 0.375rem 0.75rem;
            }

            .avatar {
                width: 28px;
                height: 28px;
            }

            .user-name {
                font-size: 0.85rem;
            }

            .mobile-user-info {
                justify-content: space-between;
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .mobile-user-dropdown {
                background: #ffffff;
                border-radius: 4px;
                padding: 1rem;
                margin-top: 0.5rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        }

        /* Add this new media query for header */
        @media (max-width: 768px) {
            header nav {
                justify-content: space-between;
                padding: 0.4rem 1rem;
            }

            /* Hide all nav elements except logo and hamburger in mobile */
            header .nav-links,
            header .auth-buttons {
                display: none !important; /* Use !important to override other styles */
            }

            /* Ensure logo and hamburger are visible */
            header .logo-container,
            header .hamburger {
                display: flex;
                align-items: center;
            }

            header .hamburger {
                margin-left: auto;
                font-size: 1.5rem;
                padding: 0.5rem;
                cursor: pointer;
            }
        }

        /* Enhanced sidebar styles for mobile */
        @media (max-width: 768px) {
            .sidebar {
                padding-top: 2rem; /* More space at top */
            }

            .sidebar .nav-links {
                display: flex !important; /* Always show nav links in sidebar */
                flex-direction: column;
                padding: 1rem;
            }

            .sidebar .nav-links li {
                margin: 0.5rem 0;
                width: 100%;
            }

            .sidebar .nav-links a {
                display: block;
                padding: 1rem;
                color: #333;
                font-size: 1.1rem;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .sidebar .nav-links a:hover {
                background-color: var(--light-bg);
                color: var(--primary-color);
                padding-left: 1.5rem;
            }

            /* Enhanced mobile auth buttons */
            .sidebar .auth-buttons {
                display: flex !important;
                flex-direction: column;
                padding: 1rem;
                margin-top: 1rem;
                border-top: 1px solid #eee;
            }

            .sidebar .google-login-btn,
            .sidebar .user-info {
                width: 100%;
                justify-content: center;
                padding: 0.75rem;
                margin: 0.5rem 0;
            }
        }

        /* Update the app-name class */
        .app-name {
            color: #8b09db;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Also update the sidebar version */
        .sidebar .app-name {
            color: #8b09db;
        }

        /* Add hover effect if desired */
        .logo-link:hover .app-name {
            color: #a64dff;
        }

        /* Update logo link styles */
        .logo-link {
            text-decoration: none; /* Remove underline */
        }

        .logo-link:hover {
            text-decoration: none; /* Ensure no underline on hover */
        }

        /* Update nav link styles */
        .nav-links a {
            color: #333;
            text-decoration: none; /* Remove underline */
            font-weight: 500;
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary-color);
            text-decoration: none; /* Ensure no underline on hover */
            opacity: 1;
        }

        /* Update sidebar nav link styles */
        .sidebar .nav-links a {
            text-decoration: none; /* Remove underline */
            display: block;
            padding: 1rem;
            color: #333;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-links a:hover {
            text-decoration: none; /* Ensure no underline on hover */
            background-color: var(--light-bg);
            color: var(--primary-color);
            padding-left: 1.5rem;
        }

        /* Add these new styles after your existing CSS */
        .strategy-section {
            padding: 80px 0;
            background: #fff;
        }

        .strategy-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .strategy-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .strategy-header h2 {
            font-size: 2.8rem;
            color: #8b09db;
            margin-bottom: 20px;
            border: none;
        }

        .strategy-header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }

        .strategy-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .strategy-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #eee;
            position: relative;
            overflow: hidden;
        }

        .strategy-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #8b09db 0%, #a64dff 100%);
        }

        .strategy-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(139, 9, 219, 0.1);
        }

        .strategy-icon {
            font-size: 3rem;
            color: #8b09db;
            margin-bottom: 20px;
        }

        .strategy-card h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }

        .strategy-card p {
            color: #666;
            line-height: 1.6;
        }

        @media (max-width: 992px) {
            .strategy-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .strategy-grid {
                grid-template-columns: 1fr;
            }
            
            .strategy-header h2 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    @include('preloader')
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo-link">
                    <div class="logo-container">
                        <div class="logo">
                            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHRPCI Logo">
                        </div>
                        <div class="app-name">
                            MHRPCI
                        </div>
                    </div>
                </a>
                <ul class="nav-links">
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="#company-profile">Company Profile</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#brand">Our Brand</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#milestones">Milestones</a></li>
                </ul>
                <div class="auth-buttons">
                    @if(Auth::guard('google')->check())
                        <div class="user-info">
                            <img src="{{ Auth::guard('google')->user()->avatar }}" alt="{{ Auth::guard('google')->user()->name }}" class="avatar">
                            <span class="user-name">{{ Auth::guard('google')->user()->name }}</span>
                        </div>
                    @else
                        <a href="{{ route('google.login') }}" class="google-login-btn">
                            <i class="fab fa-google"></i>
                            Sign in with Google
                        </a>
                    @endif
                </div>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Add Mobile Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHRPCI Logo">
                </div>
                <div class="app-name">
                    MHRPCI
                </div>
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}" class="nav-link" title="Home">Home</a></li>
            <li><a href="#company-profile" class="nav-link" title="Company Profile">Company Profile</a></li>
            <li><a href="#about" class="nav-link" title="About Us">About Us</a></li>
            <li><a href="#brand" class="nav-link" title="Our Brand">Our Brand</a></li>
            <li><a href="#partners" class="nav-link" title="Partners">Partners</a></li>
            <li><a href="#milestones" class="nav-link" title="Milestones">Milestones</a></li>
        </ul>
        <div class="auth-buttons mobile-only">
            @if(Auth::guard('google')->check())
                <div class="user-info mobile-user-info">
                    <img src="{{ Auth::guard('google')->user()->avatar }}"
                         alt="{{ Auth::guard('google')->user()->name }}"
                         class="avatar">
                    <span class="user-name">{{ Auth::guard('google')->user()->name }}</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <div class="user-dropdown mobile-user-dropdown">
                    <div class="user-dropdown-header">
                        <div class="user-name">{{ Auth::guard('google')->user()->name }}</div>
                        <div class="user-email">{{ Auth::guard('google')->user()->email }}</div>
                    </div>
                    <form action="{{ route('google.logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('google.login') }}" class="google-login-btn">
                    <i class="fab fa-google"></i> Sign in with Google
                </a>
            @endif
        </div>
    </div>

    <!-- Add Overlay -->
    <div class="overlay"></div>

    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>MHR Property Conglomerate Inc.</h1>
                    <h3>Transforming Industries, Empowering Growth</h3>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('vendor/adminlte/dist/img/whiteLOGO4.png') }}" alt="MHRPCI Logo">
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="content-grid">
                <div class="content-column">
                    <div id="company-profile" class="about-section">
                        <h2>Company Profile</h2>
                        <p>MHRPCI (MHR Property Conglomerate Inc.) is the parent company of a diverse group of businesses operating across several industries, including healthcare, fuel distribution, construction, and hospitality. With a vision for continuous growth and innovation, MHRPCI remains dedicated to delivering quality products and services to both private and government sectors.</p>
                    </div>

                    <div id="about" class="about-section">
                        <h2>About MHRPCI</h2>
                        <p>MHR Property Conglomerate Inc. (MHRPCI) began in the year 2000 with the establishment of Cebic Trading, a single proprietorship that started with just a 20,000-peso capital, primarily dealing in hospital and office medical supplies.</p>
                        <p>In 2003, MHRPCI expanded its operations in Cebu by forming Medical & Hospital Resources Health Care, Inc. (MHRHCI) to focus on medical supplies and forge international partnerships.</p>
                        <p>Over the years, MHRPCI has continued to grow, spreading its wings to various regions and industries, acquiring businesses in hospitality, pharmaceuticals, hauling, and more, eventually becoming a conglomerate with 10 companies working in synergy.</p>
                    </div>

                    <div id="brand" class="about-section">
                        <h2>About the Brand</h2>
                        <p>MHRPCI represents a commitment to excellence, innovation, and reliability. Across all our subsidiaries and sectors, we strive to uphold these values while building long-lasting relationships with our clients and partners. Each of our companies brings expertise and passion to their respective fields, driving success and growth across the conglomerate.</p>
                    </div>

                    {{-- <div id="subsidiaries" class="related-subsidiaries">
                        <h2>Our Subsidiaries</h2>
                        @if($subsidiaries->isEmpty())
                            <p>No subsidiaries found at the moment.</p>
                        @else
                            <div class="related-grid">
                                @foreach($subsidiaries->take(8) as $subsidiary)
                                    <div class="subsidiary-card">
                                        <h3>{{ $subsidiary->abbr }}</h3>
                                        @if($subsidiary->main_image)
                                            <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="{{ $subsidiary->name }} Logo" class="subsidiary-logo">
                                        @endif
                                        <p>{{ Str::limit($subsidiary->description, 60) }}</p>
                                        <a href="{{ route('subsidiaries_details', $subsidiary->id) }}" class="btn btn-primary">Learn More</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div> --}}

                    <div id="partners" class="about-section">
                        <h2>Our Partners</h2>
                        <p>MHRPCI works closely with a network of trusted local and international partners to ensure that we deliver the highest quality products and services across industries. Our partners span healthcare, construction, petroleum, and hospitality, allowing us to provide tailored solutions to meet the evolving needs of our clients.</p>
                    </div>

                    <div id="milestones" class="about-section">
                        <h2>Key Milestones</h2>
                        <ul>
                            <li>2000: Establishment of Cebic Trading</li>
                            <li>2003: Formation of Medical & Hospital Resources Health Care, Inc. (MHRHCI)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="strategy-section">
        <div class="strategy-container">
            <div class="strategy-header">
                <h2>Our Strategy</h2>
                <p>Building on our strong foundation, we continue to expand our reach and impact through strategic initiatives that drive sustainable growth and value creation.</p>
            </div>
            <div class="strategy-grid">
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Sustainable Growth</h3>
                    <p>We focus on expanding our business portfolio while maintaining sustainable practices and responsible resource management.</p>
                </div>
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Strategic Partnerships</h3>
                    <p>Building strong relationships with key stakeholders and partners to create synergies and drive mutual growth.</p>
                </div>
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Innovation Leadership</h3>
                    <p>Continuously innovating across our businesses to stay ahead of market trends and meet evolving customer needs.</p>
                </div>
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>People Development</h3>
                    <p>Investing in our people through training and development programs to build a high-performing organization.</p>
                </div>
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Market Expansion</h3>
                    <p>Strategically expanding our presence in key markets while strengthening our existing market positions.</p>
                </div>
                <div class="strategy-card">
                    <div class="strategy-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Sustainability Focus</h3>
                    <p>Implementing environmentally responsible practices across our operations while supporting community development.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 40px;">Our Journey Through Time</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2000</h3>
                        <p>Establishment of Cebic Trading</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2003</h3>
                        <p>Formation of Medical & Hospital Resources Health Care, Inc. (MHRHCI)</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2005</h3>
                        <p>Expansion of operations in Cebu</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2008</h3>
                        <p>Acquisition of businesses in hospitality</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2010</h3>
                        <p>Formation of Medical & Hospital Resources Health Care, Inc. (MHRHCI)</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2012</h3>
                        <p>Acquisition of businesses in pharmaceuticals</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2015</h3>
                        <p>Expansion of operations in Manila</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2018</h3>
                        <p>Formation of Medical & Hospital Resources Health Care, Inc. (MHRHCI)</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2020</h3>
                        <p>Acquisition of businesses in hauling</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3 class="timeline-year">2022</h3>
                        <p>Formation of Medical & Hospital Resources Health Care, Inc. (MHRHCI)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h2>Contact Us</h2>
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ config('app.company_phone') }}</p>
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <a href="mailto:{{ config('app.company_email') }}">{{ config('app.company_email') }}</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong>{{ config('app.company_address') }}, {{ config('app.company_city') }}, Cebu, Philippines 6000</p>
                </div>
                <div class="footer-section">
                    <h2>Connect With Us</h2>
                    <p><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/mhrpciofficial" target="_blank">Facebook</a></p>
                    <p><i class="fab fa-youtube"></i> <a href="https://www.youtube.com/@MHRPCI-tr3dy" target="_blank">YouTube</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MHR Property Conglomerate Inc. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Updated scroll-based header background
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.backgroundColor = 'rgba(139, 9, 219, 0.9)';
            } else {
                header.style.backgroundColor = 'var(--primary-color)';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            const body = document.body;

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                body.style.overflow = '';
            }

            hamburger.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking a nav link
            const sidebarNavLinks = sidebar.querySelectorAll('.nav-link');
            sidebarNavLinks.forEach(link => {
                link.addEventListener('click', closeSidebar);
            });

            // Close sidebar when window is resized to desktop size
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });

            // Handle dropdown in mobile sidebar
            const userInfo = document.querySelector('.mobile-user-info');
            const userDropdown = document.querySelector('.mobile-user-dropdown');

            if (userInfo && userDropdown) {
                userInfo.addEventListener('click', () => {
                    userDropdown.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
