<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHRPCI - Your Trusted Business Partner</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --text-color: #1f2937;
            --light-bg: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #2563eb, #1e40af);
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease-in-out;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            line-height: 1.6;
            color: var(--text-color);
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            padding: 1.2rem 0;
            box-shadow: var(--box-shadow);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: var(--transition);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 2rem;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            display: inline-block;
            padding: 1.2rem 2.5rem;
            background: var(--gradient-primary);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.2);
        }

        /* About Section */
        .about {
            padding: 6rem 2rem;
            background: var(--light-bg);
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }

        /* Subsidiaries Section */
        .subsidiaries {
            padding: 6rem 2rem;
        }

        .subsidiaries-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .subsidiaries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .subsidiary-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .subsidiary-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .subsidiary-card i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        /* Location Section */
        .location {
            padding: 6rem 2rem;
            background: var(--light-bg);
        }

        .location-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .map-container {
            margin-top: 3rem;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1f2937, #111827);
            color: white;
            padding: 5rem 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .footer-section h3 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .about-container {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 1rem;
            }
            
            .nav-links {
                background: white;
                padding: 1rem;
                border-radius: 10px;
                box-shadow: var(--box-shadow);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="logo">MHRPCI</a>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#subsidiaries">Subsidiaries</a>
                <a href="#location">Location</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content" data-aos="fade-up">
            <h1>Welcome to MHRPCI</h1>
            <p>Your trusted partner in business excellence and innovation</p>
            <a href="#contact" class="cta-button">Get in Touch</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-container">
            <div class="about-content" data-aos="fade-right">
                <h2 class="section-title">About Us</h2>
                <p>MHRPCI is a leading business conglomerate with a diverse portfolio of subsidiaries across multiple industries. With decades of experience and a commitment to excellence, we continue to grow and innovate while maintaining our core values of integrity, quality, and customer satisfaction.</p>
                <p>Our mission is to deliver exceptional value to our stakeholders through sustainable business practices and innovative solutions.</p>
            </div>
            <div class="about-image" data-aos="fade-left">
                <img src="about-image.jpg" alt="About MHRPCI" style="width: 100%; border-radius: 10px;">
            </div>
        </div>
    </section>

    <!-- Subsidiaries Section -->
    <section id="subsidiaries" class="subsidiaries">
        <div class="subsidiaries-container">
            <h2 class="section-title" data-aos="fade-up">Our Subsidiaries</h2>
            <div class="subsidiaries-grid">
                <div class="subsidiary-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-building fa-3x" style="color: var(--primary-color);"></i>
                    <h3>Subsidiary 1</h3>
                    <p>Leading provider of innovative solutions in technology and digital transformation.</p>
                </div>
                <div class="subsidiary-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-industry fa-3x" style="color: var(--primary-color);"></i>
                    <h3>Subsidiary 2</h3>
                    <p>Manufacturing excellence with state-of-the-art facilities and sustainable practices.</p>
                </div>
                <div class="subsidiary-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-chart-line fa-3x" style="color: var(--primary-color);"></i>
                    <h3>Subsidiary 3</h3>
                    <p>Financial services and consulting for businesses and individuals.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location">
        <div class="location-container">
            <h2 class="section-title" data-aos="fade-up">Our Location</h2>
            <p data-aos="fade-up">Find us at our headquarters and various locations across the region</p>
            <div class="map-container" data-aos="zoom-in">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.802548850011!2d121.04788931744384!3d14.554743789828173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c8f8a749f3d3%3A0x7a3b3636e80f9b52!2sMakati%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1647827738045!5m2!1sen!2sph" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>MHRPCI</h3>
                <p>Your trusted business partner in excellence and innovation.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#subsidiaries">Subsidiaries</a></li>
                    <li><a href="#location">Location</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-phone"></i> +1 234 567 890</li>
                    <li><i class="fas fa-envelope"></i> info@mhrpci.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> Makati City, Philippines</li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Smooth scroll for navigation links
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
