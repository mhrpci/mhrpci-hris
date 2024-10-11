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
            background-color: #f5f7fa;
        }

        /* Header section */
        .header {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 10px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            text-decoration: none;
        }
        .main-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .nav-link {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: #3182ce;
        }

        /* Hero section */
        .hero-section {
            background-color: #f0f4f8;
            padding: 60px 0;
        }
        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }
        .hero-text {
            flex: 1;
        }
        .hero-text h1 {
            font-size: 2.5rem;
            color: #1a202c;
            margin-bottom: 1rem;
        }
        .hero-text p {
            font-size: 1.1rem;
            color: #4a5568;
            margin-bottom: 2rem;
        }
        .cta-button {
            display: inline-block;
            background-color: #3182ce;
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #2c5282;
        }
        .hero-image {
            flex: 1;
            max-width: 500px;
        }
        .hero-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Stats section */
        .stats-section {
            background-color: #fff;
            padding: 40px 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #3182ce;
        }
        .stat-label {
            font-size: 1rem;
            color: #4a5568;
        }

        /* Main content */
        .main-content {
            padding: 60px 0;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }
        .about-section, .related-subsidiaries, .contact-info {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        h2 {
            font-size: 1.5rem;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-content, .content-grid {
                flex-direction: column;
                grid-template-columns: 1fr;
            }
            .hero-image {
                order: -1;
                margin-bottom: 20px;
            }
            .hero-text h1 {
                font-size: 2rem;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .related-item.card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .related-item-content {
            padding: 20px;
            flex-grow: 1;
        }

        .related-logo {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .related-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .related-description {
            font-size: 0.9rem;
            color: #4a5568;
            margin-bottom: 15px;
        }

        .related-meta {
            font-size: 0.8rem;
            color: #718096;
        }

        .related-location, .related-year {
            display: block;
            margin-bottom: 5px;
        }

        .related-button {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #3182ce;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .related-button:hover {
            background-color: #2c5282;
        }

        /* Footer styles */
        .footer {
            background-color: #2d3748;
            color: #fff;
            padding: 40px 0;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .footer-section {
            flex: 1;
            margin-bottom: 20px;
            min-width: 200px;
        }
        .footer h2 {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .footer p {
            margin-bottom: 10px;
        }
        .footer a {
            color: #63b3ed;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }

        /* Updated Image Slider Styles */
        .image-slider-section {
            margin-bottom: 30px;
        }
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
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
        }
        .slide img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain; /* Changed from cover to contain */
            background-color: #f0f4f8; /* Light background color */
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
        .slider-button.prev {
            left: 10px;
        }
        .slider-button.next {
            right: 10px;
        }
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .slide {
                padding-top: 75%; /* 4:3 Aspect Ratio for smaller screens */
            }
        }

        /* Updated and new styles */
        body {
            color: #333;
            background-color: #f8fafc;
            padding-top: 80px; /* Adjust this value based on your header height */
        }

        .header {
            background-color: #fff;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo {
            font-size: 1.75rem;
        }

        .hero-section {
            background-color: #edf2f7;
            padding: 80px 0;
            margin-top: -80px; /* Negative margin to offset body padding */
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .hero-text h3 {
            font-size: 1.5rem;
            color: #4a5568;
            margin-bottom: 2rem;
        }

        .main-content {
            padding: 80px 0;
        }

        .content-grid {
            gap: 60px;
        }

        .about-section, .image-slider-section, .related-subsidiaries {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 40px;
            margin-bottom: 40px;
        }

        h2 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 0.5rem;
        }

        .about-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4a5568;
        }

        .slider-container {
            margin-top: 20px;
        }

        .related-grid {
            gap: 30px;
        }

        .related-item.card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .related-item.card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .related-logo {
            height: 180px;
        }

        .related-title {
            font-size: 1.4rem;
            color: #2d3748;
        }

        .related-description {
            font-size: 1rem;
            line-height: 1.6;
        }

        .related-button {
            margin-top: 15px;
        }

        .footer {
            background-color: #2d3748;
            padding: 60px 0 30px;
        }

        .footer h2 {
            border-bottom: none;
            padding-bottom: 0;
        }

        .footer-bottom {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #4a5568;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="#" class="logo">{{ $subsidiary->name }}</a>
                <nav class="main-nav">
                    <a href="{{ route('welcome') }}" class="nav-link"><i class="fas fa-home"></i> Back to Home</a>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>{{ $subsidiary->name }}</h1>
                    <h3>{{ $subsidiary->abbr }} - {{ $subsidiary->tagline ?? 'Transforming Global Learning' }}</h3>
                </div>
                <div class="hero-image">
                    @if($subsidiary->main_image)
                        <img src="{{ asset('storage/' . $subsidiary->main_image) }}" alt="{{ $subsidiary->name }}">
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
                                @foreach($relatedSubsidiaries as $relatedSubsidiary)
                                    <div class="related-item card">
                                        <div class="related-item-content">
                                            @if($relatedSubsidiary->logo)
                                                <img src="{{ asset('storage/' . $relatedSubsidiary->logo) }}" alt="{{ $relatedSubsidiary->name }} Logo" class="related-logo">
                                            @endif
                                            <h3 class="related-title">{{ $relatedSubsidiary->name }}</h3>
                                            <p class="related-description">{{ Str::limit($relatedSubsidiary->description, 120) }}</p>
                                            <div class="related-meta">
                                                @if($relatedSubsidiary->location)
                                                    <span class="related-location"><i class="fas fa-map-marker-alt"></i> {{ $relatedSubsidiary->location }}</span>
                                                @endif
                                                @if($relatedSubsidiary->founded_year)
                                                    <span class="related-year"><i class="fas fa-calendar-alt"></i> Est. {{ $relatedSubsidiary->founded_year }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('subsidiaries_details', $relatedSubsidiary) }}" class="related-button">Learn More <i class="fas fa-arrow-right"></i></a>
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
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong>
                        @if($subsidiary->contact_no)
                            @php
                                $contact_no = preg_replace('/[^0-9]/', '', $subsidiary->contact_no);
                                if(strlen($contact_no) == 10 && substr($contact_no, 0, 2) == '09') {
                                    // Mobile number
                                    $formatted_number = substr($contact_no, 0, 4) . ' ' . substr($contact_no, 4, 3) . ' ' . substr($contact_no, 7);
                                } elseif(strlen($contact_no) == 11 && substr($contact_no, 0, 3) == '639') {
                                    // Mobile number with country code
                                    $formatted_number = '+' . substr($contact_no, 0, 3) . ' ' . substr($contact_no, 3, 3) . ' ' . substr($contact_no, 6, 3) . ' ' . substr($contact_no, 9);
                                } elseif(strlen($contact_no) == 8) {
                                    // Landline in Metro Manila
                                    $formatted_number = '(02) ' . substr($contact_no, 0, 4) . ' ' . substr($contact_no, 4);
                                } elseif(strlen($contact_no) >= 9 && strlen($contact_no) <= 10) {
                                    // Landline in other areas
                                    $area_code = substr($contact_no, 0, strlen($contact_no) - 7);
                                    $formatted_number = '(' . $area_code . ') ' . substr($contact_no, -7, 3) . ' ' . substr($contact_no, -4);
                                } else {
                                    $formatted_number = $subsidiary->contact_no;
                                }
                            @endphp
                            {{ $formatted_number }}
                        @else
                            N/A
                        @endif
                    </p>
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
                    <h2>Connect With Us</h2>
                    @if($subsidiary->facebook_page)
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
    </script>
</body>
</html>
