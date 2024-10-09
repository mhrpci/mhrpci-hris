<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subsidiary->name }} - Portfolio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Base styles remain the same */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #f5f7fa;
        }

        /* Hero section styles remain largely the same */
        .hero-section {
            position: relative;
            height: 85vh;
            min-height: 500px;
            overflow: hidden;
            background-color: #1a1a1a;
        }
        /* ... other hero styles remain the same ... */

        /* Updated Container and Card styles */
        .container {
            width: 100%;
            max-width: 100%;
            padding: 40px 20px;
        }
        .cards-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            margin-bottom: 60px;
        }
        .card {
            flex: 1;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            max-width: calc(50% - 20px);
        }
        .card-left {
            position: relative;
        }
        .card-right {
            position: relative;
        }
        .card h2 {
            color: #1a1a1a;
            margin-bottom: 25px;
            font-size: 2.25rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .card p {
            margin-bottom: 20px;
            font-size: 1.15rem;
            line-height: 1.8;
            color: #4a4a4a;
        }

        /* Contact info styles updated for card layout */
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .contact-info i {
            margin-right: 15px;
            color: #007aff;
            font-size: 1.4rem;
            width: 25px;
            text-align: center;
        }
        .contact-info a {
            color: #007aff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .contact-info a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Related subsidiaries section adjusted for new layout */
        .related-subsidiaries {
            background-color: #f8f9fa;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 60px;
        }
        .related-subsidiaries h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        .related-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .related-item {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .related-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .container { max-width: 95%; }
            .cards-container { gap: 30px; }
            .card { padding: 30px; }
        }
        @media (max-width: 968px) {
            .cards-container {
                flex-direction: column;
            }
            .card {
                max-width: 100%;
            }
        }
        @media (max-width: 768px) {
            .container { padding: 50px 20px; }
            .card, .related-subsidiaries { padding: 30px; }
            h2 { font-size: 2rem; }
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1a1a1a;
            background-color: #f5f7fa;
        }

        /* Enhanced Hero section */
        .hero-section {
            position: relative;
            height: 85vh;
            min-height: 500px;
            overflow: hidden;
            background-color: #1a1a1a;
        }
        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        .hero-slide.active {
            opacity: 1;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
            color: #fff;
        }
        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: -0.02em;
        }
        .hero-content .tagline {
            font-size: 1.75rem;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            margin-bottom: 2.5rem;
            max-width: 600px;
        }
        .cta-button {
            display: inline-block;
            background-color: #007aff;
            color: #fff;
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1.1rem;
        }
        .cta-button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        /* Container and content styles */
        .container {
            width: 100%;
            max-width: 100%;
            padding: 40px 20px;
        }
        .main-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .content-column {
            flex: 1;
            min-width: 300px;
        }
        .full-width {
            width: 100%;
        }
        .about-section, .related-subsidiaries, .contact-info {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            height: 100%;
        }
        .related-subsidiaries {
            margin-top: 0;
        }
        .contact-info {
            margin-top: 40px;
        }

        @media (max-width: 1200px) {
            .main-content {
                max-width: 95%;
            }
        }
        @media (max-width: 768px) {
            .content-column {
                flex: 100%;
            }
            .container {
                padding: 20px 10px;
            }
        }

        /* Enhanced Contact info styles */
        .contact-info {
            margin-top: 60px;
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .contact-info p {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }
        .contact-info i {
            margin-right: 20px;
            color: #007aff;
            font-size: 1.5rem;
            width: 30px;
            text-align: center;
        }
        .contact-info a {
            color: #007aff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .contact-info a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Enhanced Related subsidiaries section */
        .related-subsidiaries {
            margin-top: 80px;
            padding: 60px;
            background-color: #f8f9fa;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .related-subsidiaries h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        .related-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }
        .related-item {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        .related-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .related-item h3 {
            font-size: 1.75rem;
            color: #1a1a1a;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .related-item .btn {
            align-self: flex-start;
            padding: 12px 25px;
            background-color: #007aff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.95rem;
        }
        .related-item .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .container { max-width: 95%; }
            .hero-content h1 { font-size: 3.5rem; }
        }
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.75rem; }
            .hero-content .tagline { font-size: 1.4rem; }
            .container { padding: 50px 20px; }
            .main-content, .related-subsidiaries { padding: 40px 30px; }
            h2 { font-size: 2.25rem; }
        }
        @media (max-width: 480px) {
            .hero-content h1 { font-size: 2.25rem; }
            .hero-content .tagline { font-size: 1.2rem; }
            .main-content, .related-subsidiaries { padding: 30px 20px; }
            .related-item { padding: 25px; }
            .related-item h3 { font-size: 1.5rem; }
        }

        /* Add styles for the home link */
        .home-link {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 30px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .home-link:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .home-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <!-- Add the home link here -->
        <a href="{{ route('welcome') }}" class="home-link">
            <i class="fas fa-home"></i> Home
        </a>

        <div class="hero-slideshow">
            @if($subsidiary->main_image)
                <div class="hero-slide" style="background-image: url('{{ asset('storage/' . $subsidiary->main_image) }}');"></div>
            @endif
            @if($subsidiary->first_image)
                <div class="hero-slide" style="background-image: url('{{ asset('storage/' . $subsidiary->first_image) }}');"></div>
            @endif
            @if($subsidiary->second_image)
                <div class="hero-slide" style="background-image: url('{{ asset('storage/' . $subsidiary->second_image) }}');"></div>
            @endif
            @if($subsidiary->third_image)
                <div class="hero-slide" style="background-image: url('{{ asset('storage/' . $subsidiary->third_image) }}');"></div>
            @endif
        </div>
        <div class="hero-content">
            <h1>{{ $subsidiary->name }}</h1>
            <p class="tagline"><strong>{{ $subsidiary->abbr }}</strong> - Pioneering Solutions for Tomorrow's Challenges</p>
            <a href="#about" class="cta-button">Discover Our Vision</a>
        </div>
    </div>

    <div class="container">
        <div class="main-content">
            <div class="content-column">
                <div class="about-section" id="about">
                    <h2>ABOUT</h2>
                    <p>{{ $subsidiary->description }}</p>
                </div>
            </div>
            <div class="content-column">
                @if($relatedSubsidiaries->isNotEmpty())
                    <div class="related-subsidiaries">
                        <h2>RELATED SUBSIDIARIES</h2>
                        <div class="related-list">
                            @foreach($relatedSubsidiaries as $relatedSubsidiary)
                                <div class="related-item">
                                    <div class="related-content">
                                        <h3>{{ $relatedSubsidiary->name }}</h3>
                                        <p>{{ Str::limit($relatedSubsidiary->description, 120) }}</p>
                                    </div>
                                    <a href="{{ route('subsidiaries_details', $relatedSubsidiary) }}" class="btn">Learn More</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="full-width">
                <div class="contact-info" id="contact">
                    <h2>GET IN TOUCH</h2>
                    <p><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $subsidiary->contact_no ?? 'N/A' }}</p>
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $subsidiary->email_address ?? 'N/A' }}</p>
                    <p><i class="fab fa-facebook"></i> <strong>Facebook:</strong> <a href="{{ $subsidiary->facebook_page ?? '#' }}" target="_blank">{{ $subsidiary->facebook_page ?? 'N/A' }}</a></p>
                    <p><i class="fas fa-globe"></i> <strong>Website:</strong> <a href="{{ $subsidiary->website ?? '#' }}" target="_blank">{{ $subsidiary->website ?? 'N/A' }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide');
            if (slides.length > 0) {
                let currentIndex = 0;

                function showNextSlide() {
                    slides[currentIndex].classList.remove('active');
                    currentIndex = (currentIndex + 1) % slides.length;
                    slides[currentIndex].classList.add('active');
                }

                slides[0].classList.add('active');
                setInterval(showNextSlide, 5000);
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>
