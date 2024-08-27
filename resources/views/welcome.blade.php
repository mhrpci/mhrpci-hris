<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Advanced HRIS Solution</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --text-color: #333;
            --light-bg: #f5f7fa;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
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
            font-weight: bold;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--secondary-color);
        }

        .auth-buttons .login-btn {
            background-color: #3366cc;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .auth-buttons .login-btn:hover {
            background-color: #254785;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: var(--primary-color);
            margin: 2px 0;
            transition: 0.3s;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            text-align: center;
            padding: 8rem 0 6rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .cta-btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            background-color: var(--accent-color);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #c0392b;
        }

        /* Sections */
        section {
            padding: 4rem 0;
        }

        section h2 {
            text-align: center;
            margin-bottom: 3rem;
        }

        /* Grid Layouts */
        .grid {
            display: grid;
            gap: 2rem;
        }

        .benefits-grid,
        .feature-grid,
        .faq-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        /* Cards */
        .card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .card h3 {
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        /* FAQ Section */
        .faq-item h3 {
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .faq-item p {
            display: none;
        }

        .faq-item.open p {
            display: block;
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
            margin-bottom: 1rem;
        }

        .footer-col ul li {
            margin-bottom: 0.5rem;
        }

        .footer-col a {
            color: #bdc3c7;
            transition: color 0.3s ease;
        }

        .footer-col a:hover {
            color: var(--white);
        }

        .social-icons {
            margin-top: 1rem;
        }

        .social-icon {
            display: inline-block;
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: var(--white);
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links li {
                margin: 1rem 0;
            }

            .auth-buttons {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }

        /* Loader */
.loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-content {
    text-align: center;
}

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad;
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}

/* Box Loader */
.box-loader {
    width: 50px;
    height: 50px;
    margin: auto;
    position: relative;
}

.box-loader > div {
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: #8e44ad;
    animation: box-loader 2s infinite ease-in-out;
}

.box-loader > div:nth-child(1) {
    top: 0;
    left: 0;
}

.box-loader > div:nth-child(2) {
    top: 0;
    right: 0;
    animation-delay: 0.5s;
}

.box-loader > div:nth-child(3) {
    bottom: 0;
    left: 0;
    animation-delay: 1.5s;
}

.box-loader > div:nth-child(4) {
    bottom: 0;
    right: 0;
    animation-delay: 1s;
}

@keyframes box-loader {
    0%, 100% {
        transform: scale(0.5);
        opacity: 0.5;
    }
    50% {
        transform: scale(1);
        opacity: 1;
    }
}
    </style>
</head>
<body>
    <div id="loader" class="loader">
        <div class="loader-content">
            <!-- Wave Loader -->
            <div class="wave-loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <nav>
                <div class="logo-container">
                    <div class="logo">
                        <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="HRFlow Logo">
                    </div>
                    <div class="app-name">
                        {{ env('APP_NAME') }}
                    </div>
                </div>
                <ul class="nav-links">
                    <li><a href="#why-hris">Why HRIS?</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="login-btn">Log In</a>
                </div>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Transform Your HR with Advanced HRIS</h1>
                <p>Streamline HR processes, boost productivity, and make data-driven decisions with HRFlow's comprehensive HRIS solution.</p>
                <a href="{{ route('login') }}" class="cta-btn">Get Started</a>
            </div>
        </section>

        <section id="why-hris">
            <div class="container">
                <h2>Why Choose an HRIS?</h2>
                <div class="grid benefits-grid">
                    <div class="card">
                        <i class="fas fa-cogs"></i>
                        <h3>Increased Efficiency</h3>
                        <p>Automate repetitive tasks and streamline HR processes.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-chart-line"></i>
                        <h3>Data-Driven Decisions</h3>
                        <p>Gain insights from comprehensive HR analytics and reporting.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Ensure Compliance</h3>
                        <p>Stay up-to-date with labor laws and regulations.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-tie"></i>
                        <h3>Enhance Employee Experience</h3>
                        <p>Provide self-service options and improve communication.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features">
            <div class="container">
                <h2>Comprehensive HRIS Features</h2>
                <div class="grid feature-grid">
                    <div class="card">
                        <i class="fas fa-users"></i>
                        <h3>Employee Database</h3>
                        <p>Centralize employee data with customizable fields and secure storage.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>Payroll & Benefits</h3>
                        <p>Manage compensation, benefits, and integrations with major payroll systems.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-tachometer-alt"></i>
                        <h3>Performance Management</h3>
                        <p>Set goals, conduct reviews, and track employee development.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-user-plus"></i>
                        <h3>Recruitment & Onboarding</h3>
                        <p>Streamline hiring processes and create smooth onboarding experiences.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-clock"></i>
                        <h3>Time & Attendance</h3>
                        <p>Track work hours, manage leave, and generate accurate timesheets.</p>
                    </div>
                    <div class="card">
                        <i class="fas fa-chart-bar"></i>
                        <h3>HR Analytics & Reporting</h3>
                        <p>Generate insightful reports and visualize key HR metrics.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq">
            <div class="container">
                <h2>Frequently Asked Questions</h2>
                <div class="grid faq-grid">
                    <div class="faq-item">
                        <h3>How long does implementation take?</h3>
                        <p>Typical implementation takes 4-6 weeks, depending on your organization's size and complexity.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Is my data secure?</h3>
                        <p>Yes, we use bank-level encryption and comply with all major data protection regulations.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Can I integrate with other systems?</h3>
                        <p>Absolutely! We offer integrations with popular payroll, accounting, and productivity tools.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Do you offer mobile access?</h3>
                        <p>Yes, our mobile app allows employees to access key features on-the-go.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p>MHR Building: Jose L. Briones St., North Reclamation Area, Cebu City, Cebu, Philippines 6000</p>
                    <p>Phone: (032) 238-1887</p>
                    <p>Email: <a href="mailto:info@mhrpci.ph">info@mhrpci.ph</a></p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#why-hris">Why HRIS?</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');

            // Mobile menu toggle
            hamburger.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                hamburger.classList.toggle('active');
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // FAQ accordion
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('h3');
                question.addEventListener('click', () => {
                    const isOpen = item.classList.contains('open');
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('open');
                        }
                    });
                    item.classList.toggle('open');
                });
            });

            // Highlight active navigation link on scroll
            const sections = document.querySelectorAll('section');
            const navItems = document.querySelectorAll('.nav-links a');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= sectionTop - sectionHeight / 3) {
                        current = section.getAttribute('id');
                    }
                });

                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('href').slice(1) === current) {
                        item.classList.add('active');
                    }
                });
            });

            // Animate elements on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.animate-on-scroll');
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementBottom = element.getBoundingClientRect().bottom;
                    if (elementTop < window.innerHeight && elementBottom > 0) {
                        element.classList.add('animated');
                    } else {
                        element.classList.remove('animated');
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll(); // Initial check on page load
        });

    // Loader
    window.addEventListener('load', function() {
        const loader = document.getElementById('loader');
        setTimeout(function() {
            loader.style.opacity = '0';
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500); // Fade out transition time
        }, 2000); // Display loader for 2 seconds
    });
    </script>
</body>
</html>
