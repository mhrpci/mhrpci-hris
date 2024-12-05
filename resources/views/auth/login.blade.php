<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login-{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}">
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('vendor/adminlte/dist/img/frontmhrhci.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 4rem;
            align-items: center;
            border-radius: 24px;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        }

        .text-content {
            text-align: left;
            padding: 2.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .text-content:hover {
            transform: translateY(-5px);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .text-content .logo {
            width: 220px;
            height: 180px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .text-content .logo:hover {
            transform: scale(1.02);
            filter: drop-shadow(0 6px 8px rgba(0, 0, 0, 0.2));
        }

        .company-title {
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(45deg, #ffffff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            line-height: 1.6;
            margin-top: 1rem;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: clamp(2rem, 5vw, 3rem);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .form-card h1 {
            font-size: clamp(1.8rem, 3vw, 2.2rem);
            margin-bottom: 2rem;
            color: #1a1a1a;
            position: relative;
        }

        .form-card h1::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 60px;
            height: 4px;
            background: #0066ff;
            border-radius: 2px;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input:focus {
            border-color: #0066ff;
            box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #0066ff;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #0066ff, #0052cc);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 102, 255, 0.2);
        }

        button:hover {
            background: linear-gradient(45deg, #0052cc, #003d99);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.3);
        }

        /* Responsive Design */
        @media screen and (max-width: 1200px) {
            .container {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                padding: 2rem;
            }
        }

        @media screen and (max-width: 968px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 90%;
            }

            .text-content {
                text-align: center;
                padding: 1rem;
            }

            .text-content .logo {
                margin: 0 auto 2rem;
            }

            .form-card h1::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .form-card {
                padding: 2rem;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 1.5rem;
            }

            .text-content h2 {
                font-size: 1.5rem;
            }

            .form-card {
                padding: 1.5rem;
            }
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 2rem;
            border-radius: 12px;
            color: white;
            font-weight: 500;
            display: none;
            animation: slideIn 0.3s ease;
            z-index: 1000;
        }

        .notification.success {
            background: linear-gradient(45deg, #28a745, #218838);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        .notification.error {
            background: linear-gradient(45deg, #dc3545, #c82333);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.8));
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer p {
            margin: 0.5rem 0;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            line-height: 1.6;
            font-weight: 300;
        }

        .footer p:first-child {
            font-weight: 400;
        }

        @media screen and (max-width: 768px) {
            .footer {
                padding: 1rem;
            }
            
            .footer p {
                font-size: 0.85rem;
            }

            .footer-content {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
            
            .contact {
                flex-direction: column;
                gap: 0.3rem;
            }
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .address {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            font-weight: 300;
        }

        .contact {
            display: flex;
            gap: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            font-weight: 300;
        }

        /* Update media queries for footer */
        @media screen and (max-width: 1024px) {  /* Standard laptop breakpoint */
            .footer {
                display: none;  /* Hide footer for screens smaller than laptop */
            }
            
            /* Adjust container bottom padding when footer is hidden */
            .container {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-content">
            <div class="logo-container">
                <img src="vendor/adminlte/dist/img/whiteLOGO4.png" alt="Company Logo" class="logo">
            </div>
            <h2 class="company-title">{{ config('app.company_name') }}</h2>
            <p class="welcome-text">Welcome to our secure portal. Please sign in to access your account.</p>
        </div>

        <div class="form-card">
            <h1>Sign in</h1>
            <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required />
                    <span class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </span>
                </div>
                <div style="margin-bottom: 20px;">
                    <a href="{{ route('password.request') }}" style="color: #0066ff; text-decoration: none;">Forgot password?</a>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="address">{{ config('app.company_address') }} {{ config('app.company_city') }} {{ config('app.company_zip') }}</div>
            <div class="contact">
                <span>Phone: {{ config('app.company_phone') }}</span>
                <span>Email: {{ config('app.company_email') }}</span>
            </div>
        </div>
    </footer>

    <div id="notification" class="notification"></div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let form = event.target;
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                const notification = document.getElementById('notification');
                if (data.success) {
                    notification.className = 'notification success';
                    notification.innerHTML = 'Login Successful! Redirecting...';
                    notification.style.display = 'block';
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    let errorMessage = data.message === 'Your account is disabled.' ? 'Your account is disabled.' :
                                       data.field === 'email' ? 'Invalid email address' : 'Invalid password';
                    notification.className = 'notification error';
                    notification.innerHTML = errorMessage;
                    notification.style.display = 'block';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 3000);
                }
            })
            .catch(error => {
                const notification = document.getElementById('notification');
                notification.className = 'notification error';
                notification.innerHTML = 'Something went wrong. Please try again later.';
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            });
        });

        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            setTimeout(function() {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }, 1000);
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add this new function at the end of your script
        function checkForLogoutMessage() {
            const urlParams = new URLSearchParams(window.location.search);
            const logoutMessage = urlParams.get('logout');
            if (logoutMessage === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Logged Out',
                    text: 'You have been successfully logged out.',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        }

        // Call this function when the page loads
        window.addEventListener('load', function() {
            checkForLogoutMessage();
            // ... your existing load event listener content ...
        });
    </script>
</body>
</html>
