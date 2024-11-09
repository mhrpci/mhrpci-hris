<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verbena Hotel Inc.</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2e7d32;
            --secondary: #4caf50;
            --accent: #ffd700;
            --background: #f8f9fa;
            --text: #2c3e50;
            --white: #ffffff;
            --gray-light: #f4f6f8;
            --shadow: 0 8px 30px rgba(0,0,0,0.12);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            line-height: 1.6;
            color: var(--text);
            background: var(--background);
            padding-top: 80px;
        }

        /* Header & Navigation */
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

        .header.scroll-down {
            transform: translateY(-100%);
        }

        .header.scroll-up {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
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

        .logo h1 {
            font-size: 1.5rem;
            color: var(--primary);
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
            transition: var(--transition);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('{{ asset('vendor/adminlte/dist/img/frontvhi.jpg') }}') center/cover fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            padding-top: 0;
        }

        .hero-content {
            max-width: 1000px;
            animation: fadeInUp 1s ease-out;
            padding: 4rem 2rem;
        }

        .hero h2 {
            font-size: 5rem;
            font-weight: 800;
            letter-spacing: -1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 1.5rem;
            line-height: 1.2;
            font-family: 'Playfair Display', serif;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Sections */
        .section {
            padding: 6rem 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 3rem;
        }

        /* Cards Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .card h3 {
            margin-bottom: 1rem;
            color: var(--primary);
        }

        /* Location Section */
        .location-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .location-info {
            padding: 3rem;
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .location-info p {
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .location-map {
            border-radius: 24px;
            box-shadow: var(--shadow);
            height: 500px;
        }

        /* Footer */
        .footer {
            background: var(--primary);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
        }

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu-btn span {
            display: block;
            width: 25px;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero h2 {
                font-size: 3rem;
            }

            .section {
                padding: 4rem 1.5rem;
            }

            .location-container {
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                transition: 0.3s ease-in-out;
                gap: 2.5rem;
                z-index: 9998;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-link {
                font-size: 1.2rem;
                width: 100%;
                text-align: center;
                padding: 1rem;
            }

            .nav-link:hover {
                background: var(--gray-light);
                border-radius: 8px;
            }

            .hero h2 {
                font-size: 2.5rem;
            }

            .location-container {
                grid-template-columns: 1fr;
            }

            .location-map {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .hero h2 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .card {
                padding: 2rem;
            }

            .location-info {
                padding: 2rem;
            }
        }

        /* Updated Card Styles */
        .card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Add Room Cards Specific Styling */
        .room-card {
            position: relative;
            height: 400px;
            padding: 0;
            overflow: hidden;
        }

        .room-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .room-card:hover img {
            transform: scale(1.05);
        }

        .room-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
            color: var(--white);
        }

        /* Enhanced Responsive Layout */
        @media (max-width: 1024px) {
            .grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                padding: 0 1rem;
            }

            .location-container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                padding: 1rem;
            }

            .logo h1 {
                font-size: 1.25rem;
            }

            .logo img {
                width: 48px;
                height: 48px;
            }

            .section {
                padding: 4rem 1rem;
            }
        }

        /* Add this to fix fade-in animation */
        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Improve card transitions */
        .card {
            opacity: 1;  /* Change from 0 to 1 to prevent initial hiding */
            transform: translateY(0);  /* Reset initial transform */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        /* Add to your existing styles */
        .room-info ul {
            list-style: none;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .room-info ul li {
            margin: 0.2rem 0;
        }

        .card ul {
            list-style: none;
            margin-top: 1rem;
        }

        .card ul li {
            margin: 0.5rem 0;
            font-size: 0.9rem;
            color: var(--text);
        }

        /* Update room-info styles */
        .room-info {
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
            padding: 2rem;
        }

        /* Who We Are Section */
        .who-we-are-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .vhi-letters {
            display: flex;
            justify-content: center;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .letter-block {
            flex: 1;
            max-width: 300px;
        }

        .letter-block h3 {
            font-size: 4rem;
            color: var(--primary);
            font-family: 'Playfair Display', serif;
            margin-bottom: 1rem;
        }

        .letter-block p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text);
        }

        .vhi-description {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--text);
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        @media (max-width: 768px) {
            .vhi-letters {
                flex-direction: column;
                gap: 2rem;
                align-items: center;
            }

            .letter-block {
                max-width: 100%;
                padding: 0 2rem;
            }

            .letter-block h3 {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <img src="{{ asset('vendor/adminlte/dist/img/verbena.jpg') }}" alt="Verbena Hotel Inc.">
                <h1>Verbena Hotel Inc.</h1>
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

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h2>Verbena Hotel Inc.</h2>
                <p>Comfortable and affordable accommodation in the heart of the city</p>
            </div>
        </section>

        <section id="who-we-are" class="section">
            <h2 class="section-title">Who We Are</h2>
            <div class="who-we-are-content">
                <div class="vhi-letters">
                    <div class="letter-block">
                        <h3>V</h3>
                        <p>Valued commitment to excellence in healthcare innovation and service.</p>
                    </div>
                    <div class="letter-block">
                        <h3>H</h3>
                        <p>Healthcare solutions that enhance efficiency and effectiveness.</p>
                    </div>
                    <div class="letter-block">
                        <h3>I</h3>
                        <p>Innovative approaches to medical services and patient care.</p>
                    </div>
                </div>
                <p class="vhi-description">
                    VHI (Valued Healthcare Innovations) is dedicated to revolutionizing the healthcare industry through innovative solutions. We specialize in providing cutting-edge medical devices, equipment, and software that optimize healthcare delivery and improve patient outcomes.
                </p>
            </div>
        </section>

        <section id="about" class="section">
            <h2 class="section-title">About Us</h2>
            <div class="grid">
                <div class="card">
                    <i class="fas fa-home"></i>
                    <h3>Comfortable Stay</h3>
                    <p>Clean, cozy rooms for a good night's rest.</p>
                </div>
                <div class="card">
                    <i class="fas fa-clock"></i>
                    <h3>24/7 Service</h3>
                    <p>Front desk available round the clock for your convenience.</p>
                </div>
                <div class="card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Great Location</h3>
                    <p>Easy access to public transport and local attractions.</p>
                </div>
            </div>
        </section>

        {{-- <section id="rooms" class="section">
            <h2 class="section-title">Room Accommodations</h2>
            <div class="grid">
                <div class="card room-card">
                    <img src="{{ asset('vendor/adminlte/dist/img/g1.png') }}">
                </div>
                <div class="card room-card">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b" alt="Double Room">
                </div>
                <div class="card room-card">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b" alt="Family Room">
                </div>
            </div>
        </section>

        <section id="amenities" class="section">
            <h2 class="section-title">Amenities</h2>
            <div class="grid">
                <div class="card">
                    <i class="fas fa-wifi"></i>
                    <h3>Free WiFi</h3>
                    <p>Complimentary WiFi in all rooms and common areas</p>
                    <ul>
                        <li>Available 24/7</li>
                        <li>Basic streaming speed</li>
                    </ul>
                </div>
                <div class="card">
                    <i class="fas fa-coffee"></i>
                    <h3>Dining</h3>
                    <p>Basic dining facilities available</p>
                    <ul>
                        <li>Simple breakfast (7:00 AM - 10:00 AM)</li>
                        <li>Vending machines</li>
                        <li>Nearby local restaurants</li>
                    </ul>
                </div>
                <div class="card">
                    <i class="fas fa-parking"></i>
                    <h3>Facilities</h3>
                    <p>Essential amenities for your stay</p>
                    <ul>
                        <li>Limited parking space</li>
                        <li>Daily housekeeping</li>
                        <li>Luggage storage</li>
                    </ul>
                </div>
                <div class="card">
                    <i class="fas fa-concierge-bell"></i>
                    <h3>Services</h3>
                    <p>Basic guest services</p>
                    <ul>
                        <li>24/7 front desk</li>
                        <li>Tour assistance</li>
                        <li>Local calls</li>
                    </ul>
                </div>
            </div>
        </section> --}}

        <section id="location" class="section">
            <h2 class="section-title">Our Location</h2>
            <div class="location-container">
                <div class="location-info">
                    <h3>Find Us Here</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 584 Don Gil Garcia St, Cebu City, 6000 Cebu</p>
                    <p><i class="fas fa-phone"></i> Contact Number: (032) 253 3430</p>
                    <p><i class="fas fa-envelope"></i> Email: verbenahi@mhrpci.ph</p>

                    <h3>Connect With Us</h3>
                    <p><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/verbenahiofficial/" target="_blank">Verbena Hotel Cebu</a></p>
                </div>
                <div class="location-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d981.3559869794633!2d123.89088431039374!3d10.312292699999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9994eaa67ed35%3A0x751eec2e949851e5!2sVerbena%20Hotel!5e0!3m2!1sen!2sph!4v1710830900955!5m2!1sen!2sph"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Verbena Hotel Inc. All rights reserved.</p>
        <p>A subsidiary of MHR Properties Conglomerate, Inc.</p>
    </footer>

    <script>
        // Enhanced Mobile Menu Toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');
        const body = document.body;

        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            mobileMenuBtn.classList.toggle('active');
            // Prevent body scroll when menu is open
            body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                navMenu.classList.remove('active');
                mobileMenuBtn.classList.remove('active');
                body.style.overflow = '';
            }
        });

        // Header scroll behavior
        let lastScroll = 0;
        const header = document.querySelector('.header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll <= 0) {
                header.classList.remove('scroll-up');
                return;
            }

            if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
                // Scrolling down
                header.classList.remove('scroll-up');
                header.classList.add('scroll-down');
            } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
                // Scrolling up
                header.classList.remove('scroll-down');
                header.classList.add('scroll-up');
            }

            lastScroll = currentScroll;
        });

        // Update the observer code to handle animations better
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card, .section-title, .location-container').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>
</html>
