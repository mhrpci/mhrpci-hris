<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHRHCI - Medical & Hospital Resources Health Care, Inc.</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #0052CC;
            --secondary: #2684FF;
            --accent: #4C9AFF;
            --background: #F5F9FF;
            --text: #172B4D;
            --white: #ffffff;
            --gray-light: #F4F5F7;
            --shadow: 0 8px 30px rgba(0, 82, 204, 0.12);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            line-height: 1.6;
        }

        /* Navigation */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 80px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 9999;
        }

        .nav-container {
            position: static;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            background: none;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .logo img {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .nav-menu {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            margin-left: auto;
        }

        .nav-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            padding: 0.5rem 0;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary);
            border-bottom: 2px solid var(--secondary);
        }

        .nav-link i {
            margin-right: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            padding-top: 80px;
        }

        /* Hero Section */
        .hero {
            height: 60vh;
            background: linear-gradient(rgba(0, 82, 204, 0.9), rgba(38, 132, 255, 0.8)),
                        url('{{ asset('vendor/adminlte/dist/img/frontmhrhci.jpg') }}') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
            text-align: center;
            padding: 2rem;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeIn 1.5s ease-out;
            color: var(--white);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Sections */
        .section {
            padding: 5rem 2rem;
        }

        .section-light {
            background-color: var(--light-bg);
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-align: center;
            color: var(--primary);
        }

        /* About Section */
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-left: 4px solid var(--accent);
        }

        .about-card i {
            font-size: 2.5rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-left: 4px solid var(--accent);
        }

        .service-card i {
            font-size: 2.5rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        /* Location Section */
        .location-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .location-info {
            padding: 2rem;
        }

        .location-map {
            background-color: #ddd;
            min-height: 400px;
            border-radius: 10px;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0052CC, #2684FF);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .nav-container {
                width: 80px;
            }

            .main-content {
                margin-left: 80px;
            }

            .logo img {
                width: 60px;
                height: 60px;
            }

            .nav-link span {
                display: none;
            }

            .location-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .nav-menu {
                display: none;
            }
        }

        /* Add these new animation keyframes */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 10px;
        }

        .mobile-menu-btn span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        /* Updated Responsive Design */
        @media (max-width: 1024px) {
            .nav-container {
                padding: 0.5rem 1rem;
            }

            .location-container {
                grid-template-columns: 1fr;
            }

            .about-grid, .services-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
            }

            .nav-menu {
                display: none;
                position: fixed;
                top: 80px;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 2rem;
                gap: 1.5rem;
                box-shadow: var(--shadow);
            }

            .nav-menu.active {
                display: flex;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section {
                padding: 3rem 1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 1.5rem;
            }

            .logo img {
                width: 40px;
                height: 40px;
            }

            .hero h1 {
                font-size: 1.75rem;
            }

            .about-card, .service-card {
                padding: 1.5rem;
            }
        }

        /* Add these utility classes */
        .no-scroll {
            overflow: hidden;
        }

        /* Add smooth transitions */
        .nav-menu, .hero-content, .about-card, .service-card {
            transition: var(--transition);
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <img src="{{ asset('vendor/adminlte/dist/img/mhrhci.png') }}" alt="MHRHCI Logo">
                <h1>MHRHCI</h1>
            </div>
            <ul class="nav-menu">
                <li><a href="{{route('welcome')}}" class="nav-link">Home</a></li>
                <li><a href="#who-we-are" class="nav-link">Who We Are</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#location" class="nav-link">Location</a></li>
            </ul>
            <div class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>Welcome to MHRHCI</h1>
                <p>Your trusted partner in medical and hospital supplies distribution</p>
            </div>
        </section>

        <section id="who-we-are" class="section section-light">
            <h2 class="section-title">Who We Are</h2>
            <div style="max-width: 1000px; margin: 0 auto; text-align: justify; padding: 0 2rem;" data-aos="fade-up">
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                    Medical & Hospital Resources Health Care, Inc. (MHRHCI) is a leading distributor of medical and hospital supplies in the Philippines. With our extensive network spanning Cebu, Bicol, Iloilo, and Manila, we serve healthcare facilities across the nation with high-quality medical products and equipment.
                </p>
                <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                    Since our establishment, we have grown into a reliable partner in the healthcare industry, serving hospitals, clinics, and medical facilities. Our commitment to quality and reliability has made us the preferred choice for healthcare institutions seeking dependable medical supply solutions.
                </p>
                <p style="font-size: 1.1rem;">
                    With our modern warehousing facilities and dedicated team, we maintain the highest standards of product quality and service excellence. Our passion for healthcare and commitment to patient care has helped us build a strong reputation in the medical supply industry.
                </p>
            </div>
        </section>
        <section id="about" class="section">
            <h2 class="section-title">About Us</h2>
            <div class="about-grid">
                <div class="about-card" data-aos="fade-up">
                    <i class="fas fa-box-open"></i>
                    <h3>Our Products</h3>
                    <p>Comprehensive range of high-quality medical supplies and equipment sourced from trusted manufacturers worldwide.</p>
                </div>
                <div class="about-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-users"></i>
                    <h3>Our Team</h3>
                    <p>Experienced healthcare professionals and logistics experts dedicated to ensuring timely delivery of medical supplies.</p>
                </div>
                <div class="about-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-star"></i>
                    <h3>Excellence</h3>
                    <p>Known for our commitment to quality, reliability, and exceptional service in the medical supply industry.</p>
                </div>
            </div>
        </section>

        <section id="services" class="section section-light">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up">
                    <i class="fas fa-hospital-user"></i>
                    <h3>Hospital Supplies</h3>
                    <p>Complete range of hospital equipment and supplies</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-truck-loading"></i>
                    <h3>Distribution</h3>
                    <p>Nationwide distribution network covering key regions</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-boxes"></i>
                    <h3>Supply Management</h3>
                    <p>Efficient inventory and supply chain solutions</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-clock"></i>
                    <h3>24/7 Support</h3>
                    <p>Round-the-clock customer service and support</p>
                </div>
            </div>
        </section>

        <section id="location" class="section">
            <h2 class="section-title">Our Location</h2>
            <div class="location-container">
                <div class="location-info" data-aos="fade-right">
                    <h3>Find Us Here</h3>
                    <p><i class="fas fa-map-marker-alt"></i> MHR Building - Jose L. Briones St., NRA, Cebu City, Philippines 6000</p>
                    <p><i class="fas fa-phone"></i> Contact Number: (032) 238-1887</p>
                    <p><i class="fas fa-envelope"></i> Email: mhrhci@mhrpci.ph</p>
                </div>
                <div class="location-map" data-aos="fade-left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.5387498183766!2d123.91307217489656!3d10.307817389484169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9996ee62ab953%3A0x940c202ffc675cc3!2sMHR%20Health%20Care%2C%20Co.!5e0!3m2!1sen!2sph!4v1710830058813!5m2!1sen!2sph"
                        width="100%"
                        height="100%"
                        style="border:0; border-radius: 10px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 MHRHCI (Medical & Hospital Resources Health Care, Inc.). All rights reserved.</p>
            <p>A subsidiary of MHR Properties Conglomerate, Inc.</p>
        </footer>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add VHI's mobile menu toggle code
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');
        const body = document.body;

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                body.classList.remove('no-scroll');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        });
    </script>
</body>
</html>
