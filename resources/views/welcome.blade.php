<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHR - Revolutionize Your HR Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f39c12;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header and Navigation */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
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

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: var(--text-color);
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 0;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Active Navigation Link */
        .nav-links a.active {
            color: var(--primary-color);
        }

        .nav-links a.active::after {
            width: 100%;
        }

        /* Login Button */
        .auth-buttons .login-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .auth-buttons .login-btn:hover {
            background-color: #3a7bd5;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), #3a7bd5);
            color: var(--white);
            text-align: center;
            padding: 10rem 0 8rem;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }

        .cta-btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #e67e22;
            transform: translateY(-3px);
        }

        /* Sections */
        section {
            padding: 6rem 0;
        }

        section h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--primary-color);
        }

        /* Grid Layouts */
        .grid {
            display: grid;
            gap: 2rem;
        }

        .benefits-grid,
        .feature-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        /* Cards */
        .card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-col h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* Footer Links */
        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease, padding-left 0.3s ease;
            display: inline-block;
        }

        .footer-col a:hover {
            color: var(--white);
            padding-left: 5px;
        }

        /* Social Icons */
        .social-icons {
            margin-top: 1rem;
        }

        .social-icon {
            display: inline-block;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icon:hover {
            color: var(--white);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .auth-buttons {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }

        /* About Section */
        #about {
            background-color: var(--light-bg);
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .about-item {
            text-align: center;
        }

        .about-item i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .about-item h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        /* Testimonials Section */
        #testimonials {
            background-color: var(--light-bg);
        }

        .testimonial-slider {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
            -webkit-scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-scroll-behavior: smooth;
        }

        .testimonial {
            flex: 0 0 100%;
            scroll-snap-align: start;
            -webkit-scroll-snap-align: start;
            padding: 2rem;
            border-radius: 10px;
            background-color: var(--white);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin-right: 2rem;
        }

        .testimonial p {
            font-style: italic;
            margin-bottom: 1rem;
        }

        .testimonial cite {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Call-to-Action Section */
        #cta {
            background-color: var(--primary-color);
            color: var(--white);
            text-align: center;
            padding: 6rem 0;
        }

        #cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        #cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        #cta .cta-btn {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #cta .cta-btn:hover {
            background-color: #e67e22;
            transform: translateY(-3px);
        }

        /* Preloader styles */
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
    </style>
</head>
<body>
    <!-- Add preloader HTML -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    <header>
        <div class="container">
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
                    <li><a href="#services" class="nav-link" title="Explore Our Services">Services</a></li>
                    <li><a href="#about" class="nav-link" title="Learn About Us">About Us</a></li>
                    <li><a href="#contact" class="nav-link" title="Get in Touch">Contact</a></li>
                    <li><a href="{{ route('careers') }}" title="Join Our Team">Careers</a></li>
                </ul>
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="login-btn" title="Log In to Your Account">Log In</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Welcome to MHR</h1>
                <p>Your trusted partner in Human Resource Management and Payroll Services.</p>
                <a href="#about" class="cta-btn">Get Started</a>
            </div>
        </section>

        <section id="about">
            <div class="container">
                <h2>About MHR</h2>
                <p>MHR is a leading provider of HR and payroll solutions, dedicated to empowering businesses of all sizes. With over 20 years of experience, we combine cutting-edge technology with expert knowledge to streamline your HR processes.</p>
                <div class="about-grid">
                    <div class="about-item">
                        <i class="fas fa-trophy"></i>
                        <h3>Industry Leader</h3>
                        <p>Recognized for excellence in HR and payroll services</p>
                    </div>
                    <div class="about-item">
                        <i class="fas fa-users"></i>
                        <h3>Expert Team</h3>
                        <p>Dedicated professionals with years of industry experience</p>
                    </div>
                    <div class="about-item">
                        <i class="fas fa-globe"></i>
                        <h3>Global Reach</h3>
                        <p>Serving clients across multiple industries worldwide</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <h2>Our Services</h2>
                <div class="grid benefits-grid">
                    <div class="card">
                        <i class="fas fa-users"></i>
                        <h3>HR Management</h3>
                        <p>Comprehensive HR solutions tailored to your needs.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>Payroll Services</h3>
                        <p>Accurate and timely payroll processing for your business.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-laptop-code"></i>
                        <h3>IT Solutions</h3>
                        <p>Custom software development and IT support.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-chart-line"></i>
                        <h3>Business Solutions</h3>
                        <p>Strategic consulting to drive your business forward.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <h2>Powerful Features</h2>
                <div class="grid feature-grid">
                    <div class="card">
                        <i class="fas fa-database"></i>
                        <h3>Centralized Database</h3>
                        <p>Store and manage employee data securely in one place.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>Payroll Integration</h3>
                        <p>Seamlessly integrate with major payroll systems.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-tasks"></i>
                        <h3>Performance Management</h3>
                        <p>Set goals, conduct reviews, and track employee development.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h3>Recruitment & Onboarding</h3>
                        <p>Streamline hiring and create smooth onboarding experiences.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-clock"></i>
                        <h3>Time & Attendance</h3>
                        <p>Track work hours and manage leave effortlessly.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-chart-bar"></i>
                        <h3>Advanced Analytics</h3>
                        <p>Generate insightful reports and visualize key HR metrics.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p>MHR Building: Jose L. Briones St., North Reclamation Area, Cebu City, Cebu, Philippines 6000</p>
                    <p>Phone: <a href="tel:+63322381887">(032) 238-1887</a></p>
                    <p>Email: <a href="mailto:info@mhrpci.ph">info@mhrpci.ph</a></p>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/mhrpci" target="_blank" rel="noopener noreferrer" class="social-icon" title="Follow us on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@MHRPCI-tr3dy" target="_blank" rel="noopener noreferrer" class="social-icon" title="Subscribe to our YouTube channel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MHR. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // JavaScript to handle active navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            function changeLinkState() {
                let index = sections.length;

                while(--index && window.scrollY + 50 < sections[index].offsetTop) {}

                navLinks.forEach((link) => link.classList.remove('active'));
                navLinks[index].classList.add('active');
            }

            changeLinkState();
            window.addEventListener('scroll', changeLinkState);
        });

        // Add preloader script
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });
    </script>
</body>
</html>
