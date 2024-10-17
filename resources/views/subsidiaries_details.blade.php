<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subsidiary->name }} - Portfolio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and base styles */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            font-size: 16px;
            padding-top: 80px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* Header styles */
        .header {
            background-color: #4a148c; /* Deep Purple */
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }
        .main-nav {
            display: flex;
            align-items: center;
        }
        .nav-link {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
            margin-left: 20px;
        }
        .nav-link:hover {
            opacity: 0.8;
        }
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        /* Updated Hero section styles */
        .hero-section {
            background: linear-gradient(135deg, #4a148c 0%, #1a237e 100%);
            color: #fff;
            padding: 120px 0 80px;
            margin-top: -80px;
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .hero-text {
            text-align: center;
            max-width: 800px;
            margin-bottom: 40px;
        }
        .hero-text h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .hero-text h3 {
            font-size: 1.4rem;
            font-weight: 400;
            margin-bottom: 30px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .hero-image {
            position: relative;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 5px solid rgba(255, 255, 255, 0.1);
        }
        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-cta {
            margin-top: 40px;
        }
        .hero-btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #fff;
            color: #4a148c; /* Deep Purple */
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.1;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        }

        /* Responsive styles for hero section */
        @media (min-width: 768px) {
            .hero-content {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
            .hero-text {
                text-align: left;
                margin-bottom: 0;
                margin-right: 40px;
            }
            .hero-text h3 {
                margin-left: 0;
                margin-right: 0;
            }
        }
        @media (max-width: 767px) {
            .hero-section {
                padding: 100px 0 60px;
            }
            .hero-text h1 {
                font-size: 2.5rem;
            }
            .hero-text h3 {
                font-size: 1.2rem;
            }
            .hero-image {
                width: 250px;
                height: 250px;
            }
        }

        /* Main content styles */
        .main-content {
            padding: 80px 0;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 60px;
        }
        .about-section, .image-slider-section, .related-subsidiaries {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        h2 {
            color: #4a148c; /* Deep Purple */
            font-size: 1.8rem;
            margin-bottom: 25px;
        }
        p {
            margin-bottom: 15px;
        }

        /* Image slider styles */
        .slider-container {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            flex: 0 0 100%;
            max-width: 100%;
            position: relative;
            padding-top: 56.25%;
        }
        .slide img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background-color: #f0f4f8;
        }
        .slider-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            font-size: 1.5rem;
            color: #fff;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            transition: background-color 0.3s, color 0.3s;
            z-index: 10;
        }
        .slider-button:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }
        .slider-button.prev { left: 10px; }
        .slider-button.next { right: 10px; }
        .slider-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .slider-dot.active {
            background-color: #fff;
        }

        /* Related subsidiaries styles */
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .subsidiary-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .subsidiary-card:hover {
            transform: translateY(-5px);
        }
        .subsidiary-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: center;
        }
        .subsidiary-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .subsidiary-card p {
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 15px;
        }
        .btn-primary {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4a148c; /* Deep Purple */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
        }
        .btn-primary:hover {
            background-color: #6a1b9a; /* Purple */
        }

        /* Footer styles */
        .footer {
            background: linear-gradient(135deg, #4a148c 0%, #1a237e 100%);
            color: #fff;
            padding: 60px 0 30px;
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 50px;
        }
        .footer-section h2 {
            color: #fff;
            font-size: 1.4rem;
            margin-bottom: 15px;
        }
        .footer-section p {
            margin-bottom: 10px;
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
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .hero-text h1 {
                font-size: 2rem;
            }
            .hero-text h3 {
                font-size: 1rem;
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
            .slide {
                padding-top: 75%;
            }
            .menu-toggle {
                display: block;
            }
            .main-nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #4a148c;
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                display: none;
            }
            .main-nav.active {
                display: flex;
            }
            .nav-link {
                margin: 10px 0;
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

        /* Add scroll-based header background */
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.backgroundColor = 'rgba(74, 20, 140, 0.9)'; /* Deep Purple with opacity */
            } else {
                header.style.backgroundColor = '#4a148c'; /* Deep Purple */
            }
        });

        // Add this script at the end of your body tag or in your existing script section
        function goBack() {
            window.history.back();
        }

        /* Logo styles */
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
        }
        .logo-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
        }
    </style>
</head>
<body>
    @include('preloader')
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="#" class="logo">
                    @if($subsidiary->main_image)
                        <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="{{ $subsidiary->abbr }} Logo" class="logo-image">
                    @endif
                    <span class="logo-text">{{ $subsidiary->abbr }}</span>
                </a>
                <button class="menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
                <nav class="main-nav">
                    <a href="#" class="nav-link" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#gallery" class="nav-link">Gallery</a>
                    @if($relatedSubsidiaries->isNotEmpty())
                        <a href="#related" class="nav-link">Related</a>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>{{ $subsidiary->name }}</h1>
                    <h3>{{ $subsidiary->abbr }} - {{ $subsidiary->tagline ?? 'Transforming Industries' }}</h3>
                    <div class="hero-cta">
                        <a href="#about" class="hero-btn">Learn More</a>
                    </div>
                </div>
                <div class="hero-image">
                    @if($subsidiary->main_image)
                        <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="{{ $subsidiary->name }}">
                    @else
                        <img src="{{ asset('images/default-subsidiary.jpg') }}" alt="{{ $subsidiary->name }}">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="content-grid">
                <div class="content-column">
                    <div id="about" class="about-section">
                        <h2>About {{ $subsidiary->name }}</h2>
                        @php
                            $sentences = preg_split('/(?<=[.!?])\s+/', $subsidiary->description, -1, PREG_SPLIT_NO_EMPTY);
                            $paragraphs = array_chunk($sentences, 4);
                        @endphp
                        @foreach($paragraphs as $paragraph)
                            <p>{{ implode(' ', $paragraph) }}</p>
                        @endforeach
                    </div>

                    <div id="gallery" class="image-slider-section">
                        <h2>Gallery</h2>
                        <div class="slider-container">
                            <div class="slider">
                                @if($subsidiary->first_image)
                                    <div class="slide"><img src="{{ asset('storage/' . $subsidiary->first_image) }}" alt="First Image"></div>
                                @endif
                                @if($subsidiary->second_image)
                                    <div class="slide"><img src="{{ asset('storage/' . $subsidiary->second_image) }}" alt="Second Image"></div>
                                @endif
                                @if($subsidiary->third_image)
                                    <div class="slide"><img src="{{ asset('storage/' . $subsidiary->third_image) }}" alt="Third Image"></div>
                                @endif
                            </div>
                            <button class="slider-button prev" aria-label="Previous slide">&lt;</button>
                            <button class="slider-button next" aria-label="Next slide">&gt;</button>
                            <div class="slider-dots"></div>
                        </div>
                    </div>
                </div>
                <div class="content-column">
                    @if($relatedSubsidiaries->isNotEmpty())
                        <div id="related" class="related-subsidiaries">
                            <h2>Related Subsidiaries</h2>
                            <div class="related-grid">
                                @php
                                    $randomSubsidiaries = $relatedSubsidiaries->shuffle()->take(2);
                                @endphp
                                @foreach($randomSubsidiaries as $relatedSubsidiary)
                                    <div class="subsidiary-card">
                                        <h3>{{ $relatedSubsidiary->abbr }}</h3>
                                        @if($relatedSubsidiary->main_image)
                                            <img src="{{ asset('storage/' . $relatedSubsidiary->main_image) }}" alt="{{ $relatedSubsidiary->name }} Logo" class="subsidiary-logo">
                                        @endif
                                        <p>{{ Str::limit($relatedSubsidiary->description, 60) }}</p>
                                        <a href="{{ route('subsidiaries_details', $relatedSubsidiary->id) }}" class="btn btn-primary">Learn More</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h2>Contact Us</h2>
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $subsidiary->contact_no ?? 'N/A' }}</p>
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong>
                        @if($subsidiary->email_address)
                            <a href="mailto:{{ $subsidiary->email_address }}">{{ $subsidiary->email_address }}</a>
                        @else
                            N/A
                        @endif
                    </p>
                    @if($subsidiary->location)
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $subsidiary->location }}</p>
                    @endif
                </div>
                <div class="footer-section">
                    @if($subsidiary->facebook_page)
                    <h2>Connect With Us</h2>
                        <p><i class="fab fa-facebook"></i> <a href="{{ $subsidiary->facebook_page }}" target="_blank">Facebook</a></p>
                    @endif
                    @if($subsidiary->website)
                        <p><i class="fas fa-globe"></i> <a href="{{ $subsidiary->website }}" target="_blank">Website</a></p>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $subsidiary->name }}. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Image slider script (same as before)
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slide');
            const prevButton = document.querySelector('.prev');
            const nextButton = document.querySelector('.next');
            const dotsContainer = document.querySelector('.slider-dots');
            let currentIndex = 0;

            // Create dots
            slides.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.classList.add('slider-dot');
                dot.addEventListener('click', () => goToSlide(index));
                dotsContainer.appendChild(dot);
            });

            const dots = document.querySelectorAll('.slider-dot');

            function updateDots() {
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            }

            function showSlide(index) {
                slider.style.transform = `translateX(-${index * 100}%)`;
                updateDots();
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slides.length;
                showSlide(currentIndex);
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(currentIndex);
            }

            function goToSlide(index) {
                currentIndex = index;
                showSlide(currentIndex);
            }

            nextButton.addEventListener('click', nextSlide);
            prevButton.addEventListener('click', prevSlide);

            // Auto-advance slides every 5 seconds
            let slideInterval = setInterval(nextSlide, 5000);

            // Pause auto-advance on hover
            slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
            slider.addEventListener('mouseleave', () => slideInterval = setInterval(nextSlide, 5000));

            // Initial setup
            updateDots();
        });

        // Smooth scrolling for in-page links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add scroll-based header background
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.backgroundColor = 'rgba(74, 20, 140, 0.9)'; /* Deep Purple with opacity */
            } else {
                header.style.backgroundColor = '#4a148c'; /* Deep Purple */
            }
        });

        // Add this script at the end of your body tag or in your existing script section
        function goBack() {
            window.history.back();
        }

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.querySelector('.main-nav');

            menuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.header-content')) {
                    mainNav.classList.remove('active');
                }
            });

            // Close menu when clicking on a nav link
            mainNav.addEventListener('click', function(event) {
                if (event.target.classList.contains('nav-link')) {
                    mainNav.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
