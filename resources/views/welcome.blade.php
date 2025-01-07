<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHR Property Conglomerates, Inc. - Revolutionize Your Business</title>
    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #8b09db;
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
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: var(--text-color);
            font-size: 18px; /* Increased base font size */
        }

        /* Increase font size for headings */
        h1 {
            font-size: 2.8rem; /* 50.4px if base font size is 18px */
        }

        h2 {
            font-size: 2.2rem; /* 39.6px if base font size is 18px */
        }

        h3 {
            font-size: 1.7rem; /* 30.6px if base font size is 18px */
        }

        /* Adjust paragraph and list item font sizes */
        p, li {
            font-size: 1.1rem; /* 19.8px */
        }

        /* Ensure buttons and inputs have readable text */
        button, input, select, textarea {
            font-size: 1.1rem; /* 19.8px */
        }

        /* Adjust navigation links */
        .nav-links a {
            font-size: 1.3rem; /* 23.4px */
        }

        /* Adjust footer text */
        footer {
            font-size: 1rem; /* 18px */
        }

        /* Responsive font sizes */
        @media (max-width: 768px) {
            body {
                font-size: 16px; /* Slightly smaller base font size for mobile */
            }

            h1 {
                font-size: 2.5rem; /* 40px if base font size is 16px */
            }

            h2 {
                font-size: 2rem; /* 32px if base font size is 16px */
            }

            h3 {
                font-size: 1.5rem; /* 24px if base font size is 16px */
            }
        }

        /* Ensure minimum font size for very small screens */
        @media (max-width: 320px) {
            body {
                font-size: 14px;
            }
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

        /* Login Button */
        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 30px;
            background-color: var(--white);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .user-info .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .user-info .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .user-info .dropdown-icon {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .user-info.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            min-width: 200px;
            margin-top: 10px;
            padding: 10px;
        }

        .user-dropdown.active {
            display: block;
        }

        .user-dropdown-header {
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .user-dropdown-header .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .user-dropdown-header .user-email {
            font-size: 0.9rem;
            color: #666;
        }

        .logout-btn {
            width: 100%;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn i {
            margin-right: 10px;
        }

        .logout-btn:hover {
            background-color: #3a7bd5;
        }

        .google-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--white);
            color: var(--text-color);
            border: 1px solid #dadce0;
            padding: 10px 16px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .google-login-btn::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            z-index: -1;
            filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .google-login-btn:hover::before {
            opacity: 1;
        }

        .google-login-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--white);
            z-index: -1;
            border-radius: 28px;
        }

        .google-login-btn i {
            margin-right: 10px;
            color: #4285F4;
            transition: color 0.3s ease;
        }

        .google-login-btn:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transform: translateY(-2px);
        }

        .google-login-btn:hover i {
            animation: rotate 0.7s ease-in-out;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Seasonal variations */
        .season-spring .google-login-btn::before {
            background: linear-gradient(45deg, #ff69b4, #ff1493, #00fa9a, #00ff7f);
        }

        .season-summer .google-login-btn::before {
            background: linear-gradient(45deg, #ff4500, #ffa500, #ffff00, #00ced1);
        }

        .season-autumn .google-login-btn::before {
            background: linear-gradient(45deg, #8b4513, #cd853f, #daa520, #ff8c00);
        }

        .season-winter .google-login-btn::before {
            background: linear-gradient(45deg, #4169e1, #1e90ff, #87ceeb, #e0ffff);
        }

        /* Enhanced Alert Styles */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 350px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            transform: translateY(-20px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
        }

        .alert.show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-close {
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
            color: inherit;
            text-shadow: none;
            opacity: .5;
            text-decoration: none;
            margin-left: 15px;
        }

        .alert-close:hover {
            color: inherit;
            text-decoration: none;
            opacity: .75;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .auth-buttons {
                margin-top: 10px;
            }

            .user-info, .google-login-btn {
                width: 100%;
                justify-content: center;
            }

            .user-dropdown {
                position: fixed;
                top: auto;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                margin-top: 0;
                border-radius: 15px 15px 0 0;
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                padding: 20px;
            }

            .user-dropdown-header {
                text-align: center;
            }

            .alert {
                left: 20px;
                right: 20px;
                max-width: none;
            }
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
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
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

        /* Mobile Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: var(--white);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: left 0.3s ease;
            z-index: 1001;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .sidebar .nav-links {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar .nav-links li {
            margin: 0.5rem 0;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .nav-links, .auth-buttons {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .sidebar .nav-links,
            .sidebar .auth-buttons {
                display: flex;
            }

            .sidebar .auth-buttons {
                padding: 1rem;
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .overlay.active {
            display: block;
        }
                /* Chatbot styles */
                #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        #chatbot-header {
            background-color: var(--primary-color);
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chatbot-close {
            cursor: pointer;
        }

        #chatbot-content {
            padding: 20px;
            text-align: center;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        /* Subsidiaries Section Styles */
        #subsidiaries {
            background-color: var(--light-bg);
            padding: 4rem 0;
        }

        .section-description {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 2rem;
            color: var(--text-color);
            font-size: 1rem;
        }

        .subsidiaries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .subsidiary-card-wrapper {
            display: flex;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-grow: 1;
        }

        .subsidiary-card {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .subsidiary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .subsidiary-image {
            position: relative;
            width: 100%;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            overflow: hidden;
        }

        .subsidiary-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .subsidiary-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            color: #999;
            font-size: 3rem;
        }

        .subsidiary-info {
            padding: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .subsidiary-name {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .subsidiary-abbr {
            font-size: 1rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .subsidiary-description {
            font-size: 1rem;
            color: var(--text-color);
            line-height: 1.5;
        }

        .no-subsidiaries-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .no-subsidiaries-message i {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .no-subsidiaries-message p {
            font-size: 1rem;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .subsidiaries-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .subsidiaries-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Announcements Section */
        #latest-posts {
            background-color: var(--light-bg);
            padding: 6rem 0;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .post-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-card h3 {
            font-size: 1.4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .post-card p {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .subsidiary-card {
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .subsidiary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .subsidiary-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .subsidiary-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .subsidiary-card:hover .subsidiary-img {
            transform: scale(1.05);
        }

        .subsidiary-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            color: #999;
            font-size: 3rem;
        }

        .subsidiary-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .subsidiary-info h3 {
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .subsidiary-description {
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .subsidiary-link {
            display: inline-block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .subsidiary-link:hover {
            color: var(--secondary-color);
        }

        .subsidiary-established {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0;
        }

        .subsidiary-footer {
            padding: 1rem 1.5rem;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }

        .read-more-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .read-more-btn:hover {
            background-color: var(--secondary-color);
        }

        .subsidiary-card {
            display: flex;
            flex-direction: column;
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .subsidiary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .subsidiary-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .subsidiary-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .subsidiary-card:hover .subsidiary-img {
            transform: scale(1.05);
        }

        .subsidiary-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .subsidiary-info h3 {
            font-size: 1.3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .subsidiary-info p {
            font-size: 1rem;
            color: var(--text-color);
            line-height: 1.5;
        }

        .no-subsidiaries-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .no-subsidiaries-message i {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .no-subsidiaries-message p {
            font-size: 1.1rem;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
        }

        .read-more {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .read-more:hover {
            background-color: #3a7bd5;
        }

        .today-posts-badge {
            display: inline-block;
            background-color: var(--secondary-color);
            color: var(--white);
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
            vertical-align: top;
        }

        /* Posts Slider Styles */
        .container {
            position: relative;
        }

        .posts-slider-container {
            width: 100%;
            overflow: hidden;
        }

        .posts-slider {
            display: flex;
            transition: transform 0.3s ease;
        }

        .post-card {
            flex: 0 0 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            transition: background-color 0.3s ease;
        }

        .slider-btn:hover {
            background-color: #3a7bd5;
        }

        .prev-btn {
            left: -50px;
        }

        .next-btn {
            right: -50px;
        }

        @media (max-width: 1300px) {
            .prev-btn {
                left: 10px;
            }

            .next-btn {
                right: 10px;
            }
        }

        @media (max-width: 768px) {
            .slider-btn {
                padding: 5px 10px;
                font-size: 16px;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #modalTitle {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        #modalContent {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        #modalMeta {
            font-size: 0.9em;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }

        /* Animation Styles */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero Section Animation */
        .hero h1 {
            animation: fadeInDown 1s ease-out;
        }

        .hero p {
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .hero .cta-btn {
            animation: fadeInUp 1s ease-out 1s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* About Section Animation */
        .about-item {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .about-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Subsidiaries and Partners Section Animation */
        .card {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        /* Footer Animation */
        .footer-col {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .footer-col:nth-child(1) { animation-delay: 0.1s; }
        .footer-col:nth-child(2) { animation-delay: 0.3s; }
        .footer-col:nth-child(3) { animation-delay: 0.5s; }
        .footer-col:nth-child(4) { animation-delay: 0.7s; }

        /* Smooth Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }

        .logo-link {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
        }

        .logo-link:hover {
            text-decoration: none;
            color: inherit;
        }

        /* Parallax Animation Styles */
        .parallax-section {
            position: relative;
            overflow: hidden;
        }

        .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 120%;
            background-size: cover;
            background-position: center;
            transform: translateY(0);
            will-change: transform;
            z-index: -1;
        }

        /* Adjust section padding for parallax effect */
        section {
            padding: 8rem 0;
        }

        /* Enhanced Animation for Section Content */
        .section-content {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .section-content.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Property Section Styles */
        #properties {
            padding: 6rem 0;
            background-color: var(--light-bg);
        }

        .properties-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .filter-btn {
            background-color: var(--white);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .property-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .property-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .property-card:hover .property-image img {
            transform: scale(1.05);
        }

        .property-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .property-details {
            padding: 1.5rem;
        }

        .property-details h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .property-location {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .property-description {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .read-more-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .read-more-btn:hover {
            background-color: #3a7bd5;
        }

        .load-more-container {
            text-align: center;
            margin-top: 2rem;
        }

        #load-more {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        #load-more:hover {
            background-color: #3a7bd5;
        }

        @media (max-width: 768px) {
            .properties-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-btn {
                margin: 0.25rem 0;
            }

            .properties-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .properties-grid {
                grid-template-columns: 1fr;
            }

            .property-details h3 {
                font-size: 1.1rem;
            }

            .property-location,
            .property-description {
                font-size: 0.85rem;
            }

            .read-more-btn {
                font-size: 0.85rem;
            }
        }

        /* No Properties Message */
        .no-properties-message {
            text-align: center;
            padding: 2rem;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .no-properties-message i {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .no-properties-message p {
            font-size: 1.1rem;
            color: var(--text-color);
        }

        /* Google Auth Styles */
        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            position: relative;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 30px;
            background-color: var(--white);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .user-info:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .user-info .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .user-info .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .user-info .dropdown-icon {
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .user-info.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            min-width: 200px;
            margin-top: 10px;
            padding: 10px;
        }

        .user-dropdown.active {
            display: block;
        }

        .user-dropdown-header {
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .user-dropdown-header .user-name {
            font-weight: 600;
            color: var(--text-color);
        }

        .user-dropdown-header .user-email {
            font-size: 0.9rem;
            color: #666;
        }

        .logout-btn {
            width: 100%;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn i {
            margin-right: 10px;
        }

        .logout-btn:hover {
            background-color: #3a7bd5;
        }

        .google-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--white);
            color: var(--text-color);
            border: 1px solid #dadce0;
            padding: 10px 16px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .google-login-btn::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            z-index: -1;
            filter: blur(5px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .google-login-btn:hover::before {
            opacity: 1;
        }

        .google-login-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--white);
            z-index: -1;
            border-radius: 28px;
        }

        .google-login-btn i {
            margin-right: 10px;
            color: #4285F4;
            transition: color 0.3s ease;
        }

        .google-login-btn:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transform: translateY(-2px);
        }

        .google-login-btn:hover i {
            animation: rotate 0.7s ease-in-out;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Seasonal variations */
        .season-spring .google-login-btn::before {
            background: linear-gradient(45deg, #ff69b4, #ff1493, #00fa9a, #00ff7f);
        }

        .season-summer .google-login-btn::before {
            background: linear-gradient(45deg, #ff4500, #ffa500, #ffff00, #00ced1);
        }

        .season-autumn .google-login-btn::before {
            background: linear-gradient(45deg, #8b4513, #cd853f, #daa520, #ff8c00);
        }

        .season-winter .google-login-btn::before {
            background: linear-gradient(45deg, #4169e1, #1e90ff, #87ceeb, #e0ffff);
        }

        /* Enhanced Alert Styles */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 350px;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            transform: translateY(-20px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
        }

        .alert.show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-close {
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
            color: inherit;
            text-shadow: none;
            opacity: .5;
            text-decoration: none;
            margin-left: 15px;
        }

        .alert-close:hover {
            color: inherit;
            text-decoration: none;
            opacity: .75;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .auth-buttons {
                margin-top: 10px;
            }

            .user-info, .google-login-btn {
                width: 100%;
                justify-content: center;
            }

            .user-dropdown {
                position: fixed;
                top: auto;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                margin-top: 0;
                border-radius: 15px 15px 0 0;
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                padding: 20px;
            }

            .user-dropdown-header {
                text-align: center;
            }

            .alert {
                left: 20px;
                right: 20px;
                max-width: none;
            }
        }

        .centered-text {
                text-align: center;
                max-width: 800px;
                margin: 0 auto 2rem;
            }

        /* Hide Google auth buttons on mobile */
        @media (max-width: 768px) {
            .auth-buttons {
                display: none;
            }
        }

        /* Show auth buttons in mobile sidebar */
        .sidebar .auth-buttons {
            display: block;
            margin-top: 20px;
        }

        /* Enhanced Subsidiaries Section Styles */
        .subsidiaries-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .subsidiary-card {
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .subsidiary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .subsidiary-image {
            position: relative;
            padding-top: 60%; /* Adjusted aspect ratio */
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .subsidiary-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain; /* Changed to contain for better logo display */
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .subsidiary-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
        }

        .subsidiary-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .subsidiary-name::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .subsidiary-description {
            color: #666;
            line-height: 1.6;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .card-link:hover {
            text-decoration: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .subsidiaries-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .subsidiary-name {
                font-size: 1.2rem;
            }

            .subsidiary-description {
                font-size: 0.9rem;
            }
        }

        /* Read More Link */
        .read-more-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            font-weight: 500;
            font-size: 0.9rem;
            margin-top: auto;
            transition: all 0.3s ease;
        }

        .read-more-link i {
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .subsidiary-card:hover .read-more-link i {
            transform: translateX(5px);
        }

        /* Active state for navigation links */
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .nav-link.active::after {
            width: 100% !important;
        }
    </style>
</head>
<body>
    @include('preloader')
    <!-- Alerts -->
    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            <span>{{ session('success') }}</span>
            <a href="#" class="alert-close" onclick="closeAlert('successAlert')">&times;</a>
        </div>
    @endif

    @if(session('error'))
        <div id="errorAlert" class="alert alert-error">
            <span>{{ session('error') }}</span>
            <a href="#" class="alert-close" onclick="closeAlert('errorAlert')">&times;</a>
        </div>
    @endif

    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo-link" title="Home">
                    <div class="logo-container">
                        <div class="logo">
                            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHRPCI Logo">
                        </div>
                        <div class="app-name">
                            MHRPCI
                        </div>
                    </div>
                </a>
                <ul class="nav-links">
                    <li><a href="#about" class="nav-link" data-section="about" title="Learn About Us">About Us</a></li>
                    <li><a href="#subsidiaries" class="nav-link" data-section="subsidiaries" title="Our Subsidiaries">Subsidiaries</a></li>
                    <li><a href="{{ route('careers') }}" title="Join Our Team">Careers</a></li>
                </ul>
                <div class="auth-buttons">
                    @if(Auth::guard('google')->check())
                        <div class="user-info">
                            <img src="{{ Auth::guard('google')->user()->avatar }}" alt="{{ Auth::guard('google')->user()->name }}" class="avatar">
                            <span class="user-name">{{ Auth::guard('google')->user()->name }}</span>
                            <i class="fas fa-chevron-down dropdown-icon"></i>
                        </div>
                        <div class="user-dropdown">
                            <div class="user-dropdown-header">
                                <div class="user-name">{{ Auth::guard('google')->user()->name }}</div>
                                <div class="user-email">{{ Auth::guard('google')->user()->email }}</div>
                            </div>
                            <form action="{{ route('google.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('google.login') }}" class="google-login-btn">
                            <i class="fab fa-google"></i> Sign in with Google
                        </a>
                    @endif
                </div>
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Mobile Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHRPCI Logo">
                </div>
                <div class="app-name">
                    MHRPCI
                </div>
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="#about" class="nav-link" data-section="about" title="Learn About Us">About Us</a></li>
            <li><a href="#subsidiaries" class="nav-link" data-section="subsidiaries" title="Our Subsidiaries">Subsidiaries</a></li>
            <li><a href="{{ route('careers') }}" title="Join Our Team">Careers</a></li>
        </ul>
        <div class="auth-buttons mobile-only">
            @if(Auth::guard('google')->check())
                <div class="user-info mobile-user-info">
                    <img src="{{ Auth::guard('google')->user()->avatar }}" alt="{{ Auth::guard('google')->user()->name }}" class="avatar">
                    <span class="user-name">{{ Auth::guard('google')->user()->name }}</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <div class="user-dropdown mobile-user-dropdown">
                    <div class="user-dropdown-header">
                        <div class="user-name">{{ Auth::guard('google')->user()->name }}</div>
                        <div class="user-email">{{ Auth::guard('google')->user()->email }}</div>
                    </div>
                    <form action="{{ route('google.logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('google.login') }}" class="google-login-btn">
                    <i class="fab fa-google"></i> Sign in with Google
                </a>
            @endif
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay"></div>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Welcome to MHR Property Conglomerates, Inc.</h1>
                <p style="font-size: 2.5rem;">Good Success!</p>
                <a href="#about" class="cta-btn">Discover More</a>
            </div>
        </section>

        <section id="about" class="parallax-section">
            <div class="parallax-bg"></div>
            <div class="container">
                <div class="section-content">
                    <h2 class="animate-on-scroll">About Us</h2>
                    <div class="animate-on-scroll">
                        <p>MHR Property Conglomerate Inc. (MHRPCI) began in the year 2000 with the establishment of Cebic Trading, a single proprietorship that started with just a 20,000-peso capital, primarily dealing in hospital and office medical supplies. In 2003, MHRPCI expanded its operations in Cebu by forming Medical & Hospital Resources Health Care, Inc. (MHRHCI) to focus on medical supplies and forge international partnerships. Over the years, MHRPCI has continued to grow, spreading its wings to various regions and industries, acquiring businesses in hospitality, pharmaceuticals, hauling, and more, eventually becoming a conglomerate with 10 companies working in synergy.
                        </p>
                        <a href="{{ route('mhrpci') }}" class="read-more-btn">Read More</a>
                    </div>
                    <div class="about-grid">
                        <div class="about-item animate-on-scroll">
                            <i class="fas fa-lightbulb"></i>
                            <h3>Motivation</h3>
                            <p>Driven by a passion for excellence and innovation</p>
                        </div>
                        <div class="about-item animate-on-scroll">
                            <i class="fas fa-users"></i>
                            <h3>Humanity</h3>
                            <p>Committed to making a positive impact on people's lives</p>
                        </div>
                        <div class="about-item animate-on-scroll">
                            <i class="fas fa-cogs"></i>
                            <h3>Resourcefulness</h3>
                            <p>Adapting and thriving in dynamic business environments</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="subsidiaries" class="parallax-section">
            <div class="parallax-bg"></div>
            <div class="container">
                <div class="section-content">
                    <h2 class="animate-on-scroll">Our Subsidiaries</h2>
                    <p class="section-description animate-on-scroll">Discover the diverse portfolio of companies that make up MHR Property Conglomerates, Inc.</p>
                    <div class="subsidiaries-grid">
                        <!-- Subsidiary 1 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('cio') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/cebic.png') }}"
                                             alt="Cebic Industries OPC"
                                             class="subsidiary-img"
                                             loading="lazy">
                                    </div>
                                    <div class="subsidiary-info">
                                        <div>
                                            <h3 class="subsidiary-name">CIO</h3>
                                            <p class="subsidiary-description">{{ Str::limit('Cebic Trading is the original business that laid the foundation for MHRPCI. Initially focused on hospital and office medical supplies, the company now deals in a wide range of products and continues to be a trusted supplier to healthcare providers.', 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 2 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('mhrhci') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/mhrhci.png') }}"
                                             alt="MHRHCI"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">MHRHCI</h3>
                                        <p class="subsidiary-description">{{ Str::limit('MHRHCI (Medical & Hospital Resources Health Care, Inc.) MHRHCI specializes in the importation and distribution of hospital and medical supplies. With a network that spans Cebu, Bicol, Iloilo, and Manila, the company has become a leading supplier to hospitals, clinics, and healthcare facilities across the Philippines.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 3 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('bgpdi') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/baygas.jpg') }}"
                                             alt="BGPDI"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">BGPDI</h3>
                                        <p class="subsidiary-description">{{ Str::limit('BGPDI (Bay Gas Petroleum Distribution Inc.) Founded in 2015, BGPDI started as a small fuel distribution business catering to local transport needs in Cebu. Over time, the company expanded its services and became a key player in providing fuel to various sectors, including public transport and government agencies.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 4 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('vhi') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/verbena.jpg') }}"
                                             alt="VHI"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">VHI</h3>
                                        <p class="subsidiary-description">{{ Str::limit('VHI (Valued Healthcare Innovations) VHI focuses on providing innovative solutions for the healthcare industry, offering a range of medical devices, equipment, and software designed to enhance the efficiency and effectiveness of healthcare services.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 5 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('max') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/max.png') }}"
                                             alt="MAX"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">MAX</h3>
                                        <p class="subsidiary-description">{{ Str::limit('MAX (Max Hauling and Logistics) MAX was born out of necessity during the pandemic, turning a challenging situation into an opportunity. The company specializes in hauling, quarrying, and logistics services, offering efficient and reliable solutions to meet the demands of various industries. With a focus on resource management and transportation, MAX plays a critical role in the supply chain, ensuring the smooth movement of goods and materials across different regions.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 6 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('rcg') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/rcg.png') }}"
                                             alt="RCG"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">RCG</h3>
                                        <p class="subsidiary-description">{{ Str::limit('RCG is an investment arm under MHRPCI, responsible for managing the conglomerates financial assets, acquiring strategic business interests, and overseeing key partnerships in various industries.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 7 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('lus') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/lus.png') }}"
                                             alt="LUCIOUS"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">LUCIOUS</h3>
                                        <p class="subsidiary-description">{{ Str::limit('Luscious Co. operates in the food and hospitality sector, offering high-quality dining experiences and catering services. The company is known for its focus on customer satisfaction and premium products.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Subsidiary 8 -->
                        <div class="subsidiary-card-wrapper animate-on-scroll">
                            <a href="{{ route('mhrcons') }}" class="card-link">
                                <div class="subsidiary-card">
                                    <div class="subsidiary-image">
                                        <img src="{{ asset('vendor/adminlte/dist/img/mhrconstruction.jpg') }}"
                                             alt="MHRCONS"
                                             class="subsidiary-img"
                                             loading="lazy"
                                             width="200"
                                             height="200"
                                             onerror="this.onerror=null; this.src='{{ asset('vendor/adminlte/dist/img/default-subsidiary.png') }}';">
                                    </div>
                                    <div class="subsidiary-info">
                                        <h3 class="subsidiary-name">MHRCONS</h3>
                                        <p class="subsidiary-description">{{ Str::limit('MHR Construction handles various infrastructure projects, including the development of commercial, residential, and industrial properties. The company also manages construction projects for internal expansion and external clients, contributing to the rapid urbanization of key cities in the Philippines.', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer id="contact">
            <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>About MHRPCI</h4>
                    <p>MHR Property Conglomerates, Inc. is a dynamic group of companies with expertise across multiple industries, committed to innovation and excellence.</p>
                        </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#subsidiaries">Our Subsidiaries</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                    </ul>
                        </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-map-marker-alt"></i> {{ config('app.company_address') }}, {{ config('app.company_city') }}, Cebu, Philippines 6000</p>
                    <p><i class="fas fa-phone"></i> <a>{{ config('app.company_phone') }}</a></p>
                    <p><i class="fas fa-envelope"></i> <a href="mailto:mhrpciofficial@gmail.com">{{ config('app.company_email') }}</a></p>
                        </div>
                <div class="footer-col">
                    <h4>Connect With Us</h4>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/mhrpciofficial" target="_blank" rel="noopener noreferrer" class="social-icon" title="Follow us on Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@MHRPCI-tr3dy" target="_blank" rel="noopener noreferrer" class="social-icon" title="Subscribe to our YouTube channel"><i class="fab fa-youtube"></i></a>
                        </div>
                        </div>
                        </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MHR Property Conglomerates, Inc. All rights reserved.</p>
                        </div>
                        </div>
    </footer>

    <script>
        // Add preloader script
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        // Mobile Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            hamburger.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking a nav link
            const sidebarNavLinks = sidebar.querySelectorAll('.nav-link');
            sidebarNavLinks.forEach(link => {
                link.addEventListener('click', toggleSidebar);
            });
        });

        // Chatbot toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const chatbotToggle = document.getElementById('chatbot-toggle');
            const chatbotContainer = document.getElementById('chatbot-container');
            const chatbotClose = document.getElementById('chatbot-close');

            if (chatbotToggle && chatbotContainer && chatbotClose) {
                chatbotToggle.addEventListener('click', function() {
                    chatbotContainer.style.display = chatbotContainer.style.display === 'none' ? 'block' : 'none';
                });

                chatbotClose.addEventListener('click', function() {
                    chatbotContainer.style.display = 'none';
                });
            }

            // Posts slider functionality
            const slider = document.querySelector('.posts-slider');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            const postCards = document.querySelectorAll('.post-card');

            if (slider && prevBtn && nextBtn && postCards.length > 0) {
                let currentIndex = 0;
                let autoSlideInterval;

                function updateSliderPosition() {
                    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                }

                function showPrevPost() {
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = postCards.length - 1;
                    }
                    updateSliderPosition();
                    resetAutoSlide();
                }

                function showNextPost() {
                    if (currentIndex < postCards.length - 1) {
                        currentIndex++;
                    } else {
                        currentIndex = 0;
                    }
                    updateSliderPosition();
                    resetAutoSlide();
                }

                function startAutoSlide() {
                    autoSlideInterval = setInterval(showNextPost, 10000); // 10 seconds
                }

                function resetAutoSlide() {
                    clearInterval(autoSlideInterval);
                    startAutoSlide();
                }

                prevBtn.addEventListener('click', showPrevPost);
                nextBtn.addEventListener('click', showNextPost);

                // Optional: Add keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowLeft') {
                        showPrevPost();
                    } else if (e.key === 'ArrowRight') {
                        showNextPost();
                    }
                });

                // Optional: Add touch swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                slider.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                });

                slider.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                });

                function handleSwipe() {
                    if (touchStartX - touchEndX > 50) {
                        showNextPost();
                    }
                    if (touchEndX - touchStartX > 50) {
                        showPrevPost();
                    }
                }

                // Start the automatic slide
                startAutoSlide();

                // Pause auto-slide when hovering over the slider
                slider.addEventListener('mouseenter', function() {
                    clearInterval(autoSlideInterval);
                });

                // Resume auto-slide when mouse leaves the slider
                slider.addEventListener('mouseleave', function() {
                    startAutoSlide();
                });
            }

            // Modal functionality
            const modal = document.getElementById('postModal');
            const closeBtn = document.querySelector('.close');
            const readMoreButtons = document.querySelectorAll('.read-more');

            if (modal && closeBtn) {
                readMoreButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const postId = this.getAttribute('data-post-id');
                        fetchPostDetails(postId);
                    });
                });

                closeBtn.addEventListener('click', closeModal);
                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            // Alert handling
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            if (successAlert) {
                showAlert(successAlert);
            }
            if (errorAlert) {
                showAlert(errorAlert);
            }

            // ... rest of the code ...
        });

        // Scroll Animation
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-on-scroll');

            function checkScroll() {
                animateElements.forEach(el => {
                    const elementTop = el.getBoundingClientRect().top;
                    const elementVisible = 150;

                    if (elementTop < window.innerHeight - elementVisible) {
                        el.classList.add('is-visible');
                    }
                });
            }

            // Initial check
            checkScroll();

            // Check on scroll
            window.addEventListener('scroll', checkScroll);
        });

        // Smooth Scroll for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Enhanced Scroll Animation with Parallax Effect
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-on-scroll');
            const parallaxSections = document.querySelectorAll('.parallax-section');

            function checkScroll() {
                animateElements.forEach(el => {
                    const elementTop = el.getBoundingClientRect().top;
                    const elementVisible = 150;

                    if (elementTop < window.innerHeight - elementVisible) {
                        el.classList.add('is-visible');
                    }
                });

                parallaxSections.forEach(section => {
                    const sectionTop = section.getBoundingClientRect().top;
                    const parallaxBg = section.querySelector('.parallax-bg');
                    const sectionContent = section.querySelector('.section-content');

                    // Parallax effect
                    if (sectionTop < window.innerHeight && sectionTop > -section.offsetHeight) {
                        const yPos = -(sectionTop / 5);
                        parallaxBg.style.transform = `translateY(${yPos}px)`;
                    }

                    // Fade in and slide up effect for section content
                    if (sectionTop < window.innerHeight - 100) {
                        sectionContent.classList.add('is-visible');
                    }
                });
            }

            // Initial check
            checkScroll();

            // Check on scroll
            window.addEventListener('scroll', checkScroll);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const userInfo = document.querySelector('.user-info');
            const userDropdown = document.querySelector('.user-dropdown');
            const mobileUserInfo = document.querySelector('.mobile-user-info');
            const mobileUserDropdown = document.querySelector('.mobile-user-dropdown');

            function toggleDropdown(info, dropdown) {
                if (info && dropdown) {
                    info.addEventListener('click', function(e) {
                        e.stopPropagation();
                        info.classList.toggle('active');
                        dropdown.classList.toggle('active');
                    });
                }
            }

            // Toggle for desktop
            toggleDropdown(userInfo, userDropdown);

            // Toggle for mobile
            toggleDropdown(mobileUserInfo, mobileUserDropdown);

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (userInfo && userDropdown && !userInfo.contains(e.target) && !userDropdown.contains(e.target)) {
                    userInfo.classList.remove('active');
                    userDropdown.classList.remove('active');
                }
                if (mobileUserInfo && mobileUserDropdown && !mobileUserInfo.contains(e.target) && !mobileUserDropdown.contains(e.target)) {
                    mobileUserInfo.classList.remove('active');
                    mobileUserDropdown.classList.remove('active');
                }
            });
        });

        // Enhanced alert handling
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            function showAlert(alertElement) {
                if (alertElement) {
                    setTimeout(() => {
                        alertElement.classList.add('show');
                    }, 100);
                    setTimeout(() => {
                        closeAlert(alertElement.id);
                    }, 5000);
                }
            }

            showAlert(successAlert);
            showAlert(errorAlert);
        });

        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            alert.classList.remove('show');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Determine current season
            const now = new Date();
            const month = now.getMonth();
            let season;

            if (month >= 2 && month <= 4) {
                season = 'spring';
            } else if (month >= 5 && month <= 7) {
                season = 'summer';
            } else if (month >= 8 && month <= 10) {
                season = 'autumn';
            } else {
                season = 'winter';
            }

            // Apply seasonal class to body
            document.body.classList.add(`season-${season}`);

            // Add hover effect to Google login button
            const googleBtn = document.querySelector('.google-login-btn');
            if (googleBtn) {
                googleBtn.addEventListener('mouseover', function() {
                    this.style.color = getSeasonalColor(season);
                });

                googleBtn.addEventListener('mouseout', function() {
                    this.style.color = 'var(--text-color)';
                });
            }

            function getSeasonalColor(season) {
                switch(season) {
                    case 'spring': return '#ff69b4';
                    case 'summer': return '#ff4500';
                    case 'autumn': return '#daa520';
                    case 'winter': return '#4169e1';
                    default: return '#4285F4';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Get all sections and navigation links
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            // Function to update active state
            function updateActiveLink() {
                let current = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - sectionHeight/3)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === current) {
                        link.classList.add('active');
                    }
                });
            }

            // Add scroll event listener
            window.addEventListener('scroll', updateActiveLink);

            // Initial call to set active state on page load
            updateActiveLink();

            // Update active state when clicking navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    targetSection.scrollIntoView({
                        behavior: 'smooth'
                    });

                    // Update active state
                    navLinks.forEach(navLink => navLink.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
