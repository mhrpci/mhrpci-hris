@extends('layouts.main')

@section('meta')
<meta name="description" content="Industry-leading solutions for business growth. Explore our comprehensive services and global network of subsidiaries.">
<meta name="keywords" content="business solutions, global services, professional consulting">
@endsection

@section('title', 'Enterprise Solutions | Professional Services & Global Network')

@section('styles')
<style>
    :root {
        --purple-primary: #6b21a8;
        --purple-secondary: #7c3aed;
        --purple-light: #8b5cf6;
        --purple-dark: #4c1d95;
        --purple-gradient: linear-gradient(45deg, #6b21a8, #7c3aed);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .nav {
        background: rgba(255, 255, 255, 0.98);
        padding: 0.75rem 0;
        box-shadow: 0 2px 4px rgba(107, 33, 168, 0.1);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .nav.scrolled {
        padding: 0.5rem 0;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 4px 6px rgba(107, 33, 168, 0.1);
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
    }

    .brand {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--purple-dark);
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .brand:hover {
        background: rgba(107, 33, 168, 0.05);
    }

    .brand-logo {
        display: flex;
        align-items: center;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--purple-primary);
        gap: 0.5rem;
    }

    .nav-content {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-list {
        display: flex;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 1rem;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .nav-link:hover {
        color: var(--purple-primary);
        background: rgba(107, 33, 168, 0.05);
    }

    .nav-link.active {
        color: var(--purple-primary);
        background: rgba(107, 33, 168, 0.08);
    }

    .google-login {
        display: flex;
        align-items: center;
        background: #fff;
        border: 2px solid var(--purple-light);
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-size: 0.95rem;
        color: var(--purple-primary);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        gap: 0.5rem;
    }

    .google-login:hover {
        background: var(--purple-primary);
        color: white;
        border-color: var(--purple-primary);
    }

    .google-login:hover svg path {
        fill: white;
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        padding: 0.5rem;
        cursor: pointer;
        position: relative;
        z-index: 1001;
    }

    .menu-icon {
        display: block;
        width: 24px;
        height: 2px;
        background: var(--purple-primary);
        position: relative;
        transition: all 0.3s ease;
    }

    .menu-icon::before,
    .menu-icon::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 2px;
        background: var(--purple-primary);
        transition: all 0.3s ease;
    }

    .menu-icon::before {
        top: -6px;
    }

    .menu-icon::after {
        bottom: -6px;
    }

    /* Mobile Menu Open State */
    .mobile-menu-btn.active .menu-icon {
        background: transparent;
    }

    .mobile-menu-btn.active .menu-icon::before {
        top: 0;
        transform: rotate(45deg);
    }

    .mobile-menu-btn.active .menu-icon::after {
        bottom: 0;
        transform: rotate(-45deg);
    }

    @media (max-width: 768px) {
        .mobile-menu-btn {
            display: block;
        }

        .nav-content {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 400px;
            height: 100vh;
            background: white;
            flex-direction: column;
            padding: 5rem 2rem 2rem;
            transition: all 0.3s ease;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .nav-content.active {
            right: 0;
        }

        .nav-list {
            flex-direction: column;
            width: 100%;
            gap: 0.75rem;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            padding: 0.75rem 1rem;
            width: 100%;
            justify-content: flex-start;
            font-size: 1.1rem;
        }

        .google-login {
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
            padding: 0.75rem;
        }

        /* Overlay for mobile menu */
        .nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nav-overlay.active {
            display: block;
            opacity: 1;
        }
    }

    /* Small screen adjustments */
    @media (max-width: 480px) {
        .nav-container {
            padding: 0 1rem;
        }

        .brand-logo {
            font-size: 1.25rem;
        }

        .nav-content {
            width: 100%;
            padding: 4rem 1.5rem 2rem;
        }
    }

    .hero {
        background: var(--purple-gradient);
        color: white;
        padding: 6rem 1rem 3rem;
        text-align: center;
    }

    .hero h1 {
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .hero p {
        font-size: clamp(2.5rem, 3vw, 1.25rem);
    }

    .section {
        padding: 5rem 2rem;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        width: 100%;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
        font-size: 2.5rem;
        color: var(--purple-dark);
    }

    .section-subtitle {
        text-align: center;
        margin-bottom: 4rem;
        color: #666;
        font-size: 1.2rem;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 0 auto;
        max-width: 1200px;
    }

    .service-card {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(107, 33, 168, 0.1);
        transition: all 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(107, 33, 168, 0.15);
    }

    .service-icon {
        color: var(--purple-secondary);
        margin-bottom: 1rem;
    }

    .service-title {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--purple-dark);
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .about-text {
        font-size: 1.1rem;
        color: #444;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .contact-card {
        text-align: center;
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(107, 33, 168, 0.15);
    }

    .contact-icon {
        color: var(--purple-secondary);
        margin-bottom: 1rem;
    }

    .footer {
        background: var(--purple-dark);
        color: white;
        padding: 4rem 2rem 2rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        padding: 0 1.5rem;
    }

    .footer-section h3 {
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }

    .footer-links {
        list-style: none;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links a {
        color: #e2e8f0;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: var(--purple-light);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 2rem;
        margin-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 1280px) {
        .section-container {
            max-width: 100%;
        }
    }

    @keyframes fadeIn {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    @keyframes slideIn {
        from { 
            transform: translateX(-50px); 
            opacity: 0; 
        }
        to { 
            transform: translateX(0); 
            opacity: 1; 
        }
    }

    @keyframes scaleIn {
        from { 
            transform: scale(0.95); 
            opacity: 0; 
        }
        to { 
            transform: scale(1); 
            opacity: 1; 
        }
    }

    .animate-fade-in {
        animation: fadeIn 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-slide-in {
        animation: slideIn 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .animate-scale-in {
        animation: scaleIn 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    .delay-1 { animation-delay: 0.2s; }
    .delay-2 { animation-delay: 0.4s; }
    .delay-3 { animation-delay: 0.6s; }

    .subsidiaries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .subsidiary-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(107, 33, 168, 0.1);
        transition: all 0.3s ease;
    }

    .subsidiary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(107, 33, 168, 0.15);
    }

    .subsidiary-image {
        width: 100%;
        height: clamp(150px, 30vw, 200px);
        object-fit: cover;
    }

    .subsidiary-content {
        padding: 1.5rem;
    }

    .subsidiary-title {
        font-size: 1.25rem;
        color: var(--purple-dark);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .subsidiary-location {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .subsidiary-description {
        color: #444;
        line-height: 1.6;
    }

    /* Base responsive typography */
    html {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        html {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        html {
            font-size: 12px;
        }
    }

    /* Responsive section spacing */
    @media (max-width: 768px) {
        .section {
            padding: 3rem 1rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .section-subtitle {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
    }

    /* Touch-friendly interactions */
    @media (hover: none) {
        .service-card:hover,
        .subsidiary-card:hover,
        .contact-card:hover {
            transform: none;
        }

        .nav-link,
        .footer-links a {
            padding: 0.5rem;
        }
    }

    /* Improved card responsiveness */
    .service-card,
    .subsidiary-card,
    .contact-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .subsidiary-content,
    .service-card > div {
        flex: 1;
    }

    /* Ensure images are responsive */
    img {
        max-width: 100%;
        height: auto;
    }

    /* Animation optimizations for mobile */
    @media (prefers-reduced-motion: reduce) {
        .animate-fade-in,
        .animate-slide-in,
        .animate-scale-in {
            animation: none;
            opacity: 1;
        }
    }

    /* Enhanced scroll animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translate3d(50px, 0, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes scaleInCenter {
        from {
            opacity: 0;
            transform: scale3d(0.8, 0.8, 0.8);
        }
        to {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

    .scroll-fade-up {
        opacity: 0;
        transform: translateY(40px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-slide-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-scale-in {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-animate {
        opacity: 1;
        transform: translate(0) scale(1);
    }

    .delay-100 { transition-delay: 100ms; }
    .delay-200 { transition-delay: 200ms; }
    .delay-300 { transition-delay: 300ms; }
    .delay-400 { transition-delay: 400ms; }

    .subsidiary-link {
        margin-top: 1rem;
    }

    .learn-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--purple-primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .learn-more:hover {
        gap: 0.75rem;
        color: var(--purple-secondary);
    }

    .learn-more svg {
        transition: transform 0.3s ease;
    }

    .learn-more:hover svg {
        transform: translateX(4px);
    }

    .see-all-container {
        text-align: center;
        margin-top: 3rem;
    }

    .see-all-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--purple-primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem;
        border: 2px solid var(--purple-primary);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .see-all-link:hover {
        background: var(--purple-primary);
        color: white;
        gap: 0.75rem;
    }

    .see-all-link:hover svg {
        transform: translateX(4px);
    }

    .see-all-link svg {
        transition: transform 0.3s ease;
    }
</style>
@endsection

@section('content')
<header class="hero">
    <h1>Welcome to MHR Property Conglomerates, Inc.</h1>
    <p>Good Success!</p>
</header>

<section id="about" class="section" style="background: #f8fafc;">
    <div class="section-container">
        <h2 class="section-title">About Us</h2>
        <div class="about-content">
            <div class="about-text">
                <p>MHR Property Conglomerate Inc. (MHRPCI) began in the year 2000 with the establishment of Cebic Trading, a single proprietorship that started with just a 20,000-peso capital, primarily dealing in hospital and office medical supplies.</p>
                <br>
                <p>In 2003, MHRPCI expanded its operations in Cebu by forming Medical & Hospital Resources Health Care, Inc. (MHRHCI) to focus on medical supplies and forge international partnerships. Over the years, MHRPCI has continued to grow, spreading its wings to various regions and industries, acquiring businesses in hospitality, pharmaceuticals, hauling, and more, eventually becoming a conglomerate with 10 companies working in synergy.</p>
            </div>
            <div class="about-image">
                <img src="/vendor/adminlte/dist/img/LOGO4.png" alt="Team collaboration" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<section id="services" class="section">
    <div class="section-container">
        <h2 class="section-title">Our Services</h2>
        <p class="section-subtitle">Comprehensive solutions tailored to your business needs</p>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
                </div>
                <h3 class="service-title">Digital Transformation</h3>
                <p>Modernize your business with cutting-edge digital solutions and strategies.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </div>
                <h3 class="service-title">Process Optimization</h3>
                <p>Streamline operations and maximize efficiency with our expert solutions.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3 class="service-title">Enterprise Solutions</h3>
                <p>Custom enterprise software and solutions for complex business needs.</p>
            </div>
        </div>
    </div>
</section>

<section id="subsidiaries" class="section" style="background: #f8fafc;">
    <div class="section-container">
        <h2 class="section-title animate-fade-in">Our Subsidiaries</h2>
        <p class="section-subtitle animate-fade-in delay-1">Discover the diverse portfolio of companies that make up MHR Property Conglomerates, Inc.</p>
        
        <div class="subsidiaries-grid">
            <div class="subsidiary-card animate-slide-in delay-1">
                <img src="/vendor/adminlte/dist/img/cebic.png" alt="Cebic Industries" class="subsidiary-image">
                <div class="subsidiary-content">
                    <h3 class="subsidiary-title">Cebic Industries OPC</h3>
                    <div class="subsidiary-location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Cebu, Philippines
                    </div>
                    <p class="subsidiary-description">Cebic Trading is the original business that laid the foundation for MHRPCI. Initially focused on hospital and medical supplies.</p>
                </div>
            </div>

            <div class="subsidiary-card animate-slide-in delay-2">
                <img src="/vendor/adminlte/dist/img/mhrhci.png" alt="MHRHCI" class="subsidiary-image">
                <div class="subsidiary-content">
                    <h3 class="subsidiary-title">MHRHCI</h3>
                    <div class="subsidiary-location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Cebu, Philippines
                    </div>
                    <p class="subsidiary-description">Medical & Hospital Resources Health Care, Inc. specializes in the importation and distribution of medical supplies.</p>
                </div>
            </div>

            <div class="subsidiary-card animate-slide-in delay-3">
                <img src="/vendor/adminlte/dist/img/bgpdi.png" alt="BGPDI" class="subsidiary-image">
                <div class="subsidiary-content">
                    <h3 class="subsidiary-title">BGPDI</h3>
                    <div class="subsidiary-location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Philippines
                    </div>
                    <p class="subsidiary-description">Bay Gas Petroleum Distribution Inc. Founded in 2015, BGPDI started as a small fuel distribution company.</p>
                </div>
            </div>
        </div>
        <div class="see-all-container">
            <a href="{{ route('all_subsidiaries') }}" class="see-all-link">
                See All Subsidiaries
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<section id="contact" class="section">
    <div class="section-container">
        <h2 class="section-title">Contact Us</h2>
        <p class="section-subtitle">Get in touch with us</p>
        
        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </div>
                <h3>Email Us</h3>
                <p>info@mhrpci.com</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <h3>Call Us</h3>
                <p>(032) 238-1887</p>
            </div>
            <div class="contact-card">
                <div class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <h3>Visit Us</h3>
                <p>MHR Building<br>Jose L. Briones St., North Reclamation Area<br>Cebu City, Cebu, Philippines 6000</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-in, .animate-scale-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        animatedElements.forEach(element => {
            element.style.animationPlayState = 'paused';
            observer.observe(element);
        });

        // Navbar scroll effect
        const nav = document.querySelector('.nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Mobile menu functionality
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const navContent = document.querySelector('.nav-content');
        const overlay = document.querySelector('.nav-overlay');
        const navLinks = document.querySelectorAll('.nav-link');

        function toggleMenu() {
            menuBtn.classList.toggle('active');
            navContent.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = navContent.classList.contains('active') ? 'hidden' : '';
        }

        menuBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);

        // Close menu when clicking nav links
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (navContent.classList.contains('active')) {
                    toggleMenu();
                }
            });
        });

        // Active link highlighting
        const sections = document.querySelectorAll('section');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').slice(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        // Enhanced scroll animations
        const scrollElements = document.querySelectorAll('.scroll-fade-up, .scroll-slide-right, .scroll-scale-in');
        
        const elementInView = (el, offset = 0) => {
            const elementTop = el.getBoundingClientRect().top;
            return (
                elementTop <= (window.innerHeight || document.documentElement.clientHeight) * (1 - offset)
            );
        };

        const displayScrollElement = (element) => {
            element.classList.add('scroll-animate');
        };

        const hideScrollElement = (element) => {
            element.classList.remove('scroll-animate');
        };

        const handleScrollAnimation = () => {
            scrollElements.forEach((el) => {
                if (elementInView(el, 0.25)) {
                    displayScrollElement(el);
                } else {
                    hideScrollElement(el);
                }
            });
        };

        // Initialize scroll animations
        handleScrollAnimation();

        // Throttle scroll events
        let throttleTimer;
        window.addEventListener('scroll', () => {
            if (throttleTimer) return;
            
            throttleTimer = setTimeout(() => {
                handleScrollAnimation();
                throttleTimer = null;
            }, 50);
        });

        // Add smooth scroll behavior for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endsection