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
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            font-size: 16px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* Updated Header styles */
        .header {
            background-color: #8b09db;
            padding: 15px 0;
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
            padding: 10px 15px;
            border-radius: 5px;
        }
        .nav-link:hover {
            color: #8b09db;
            background-color: #ffffff;
        }

        /* Hero section styles */
        .hero-section {
            background: linear-gradient(135deg, #8b09db, #a64dff);
            color: #fff;
            padding: 180px 0 100px;
            text-align: center;
        }
        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .hero-text h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .hero-text h3 {
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 30px;
            opacity: 0.9;
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
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .about-section:hover, .related-subsidiaries:hover {
            transform: translateY(-5px);
        }
        h2 {
            color: #8b09db;
            font-size: 1.8rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #8b09db;
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
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
            font-size: 1.2rem;
            margin-bottom: 15px;
            text-align: center;
            color: #8b09db;
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
            padding: 10px 20px;
            background-color: #8b09db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #a64dff;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Footer styles */
        .footer {
            background-color: #8b09db;
            color: #fff;
            padding: 60px 0 30px;
        }
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        .footer-section h2 {
            color: #fff;
            font-size: 1.4rem;
            margin-bottom: 20px;
        }
        .footer-section h2::after {
            background-color: #fff;
        }
        .footer-section p {
            margin-bottom: 15px;
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
    </style>
</head>
<body>
    @include('preloader')
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="#" class="logo">MHRPCI</a>
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

                    <div id="subsidiaries" class="related-subsidiaries">
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
                    </div>

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
                header.style.backgroundColor = '#8b09db';
            }
        });
    </script>
</body>
</html>
