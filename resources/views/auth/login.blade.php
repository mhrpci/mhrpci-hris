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

        /* Terms Checkbox Styles */
        .terms-checkbox-container {
            margin-bottom: 1.5rem;
        }

        .terms-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 0.9rem;
            color: #666;
        }

        .terms-label input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            cursor: pointer;
        }

        .terms-text {
            line-height: 1.4;
        }

        .terms-text a {
            color: #0066ff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .terms-text a:hover {
            color: #0052cc;
            text-decoration: underline;
        }

        /* Terms Modal Styles */
        .terms-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .terms-modal-content {
            position: relative;
            background: white;
            margin: 5% auto;
            padding: 2.5rem;
            width: 90%;
            max-width: 800px;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-height: 80vh;
            overflow-y: auto;
        }

        .terms-content {
            margin: 1.5rem 0;
            color: #333;
            font-size: 0.95rem;
            line-height: 1.6;
            text-align: justify;
        }

        .terms-content .terms-intro {
            font-weight: 500;
            margin-bottom: 2rem;
            color: #1a1a1a;
            text-align: justify;
        }

        .terms-content h3 {
            color: #0066ff;
            margin: 2rem 0 1rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .terms-content ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .terms-content li {
            margin-bottom: 0.5rem;
            color: #444;
        }

        .terms-content .contact-info {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            font-style: italic;
            color: #666;
        }

        .close-modal {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #333;
        }

        .accept-terms-btn {
            background: linear-gradient(45deg, #0066ff, #0052cc);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .accept-terms-btn:hover {
            background: linear-gradient(45deg, #0052cc, #003d99);
            transform: translateY(-2px);
        }

        /* Scrollbar Styling */
        .terms-modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .terms-modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .terms-modal-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .terms-modal-content::-webkit-scrollbar-thumb:hover {
            background: #666;
        }

        /* Loader Button Styles */
        #submit-btn {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            min-height: 48px;  /* Ensure consistent height */
        }

        #submit-btn:disabled {
            background: linear-gradient(45deg, #999, #777);
            cursor: not-allowed;
            opacity: 0.8;
        }

        .button-loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .button-text {
            transition: opacity 0.2s ease;
        }

        /* Loading state styles */
        #submit-btn.loading .button-text {
            opacity: 0.7;
        }

        #submit-btn.loading .button-loader {
            display: inline-block;
        }

        /* Disable Accept Button */
        .accept-terms-btn:disabled {
            background: linear-gradient(45deg, #999, #777);
            cursor: not-allowed;
            transform: none !important;
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
                <div class="terms-checkbox-container">
                    <label class="terms-label">
                        <input type="checkbox" id="terms-checkbox" required>
                        <span class="checkmark"></span>
                        <span class="terms-text">I agree to the <a href="#" id="terms-link">Terms and Conditions</a></span>
                    </label>
                </div>
                <button type="submit" id="submit-btn">
                    <span class="button-text">Sign In</span>
                    <span class="button-loader"></span>
                </button>
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

    <div id="terms-modal" class="terms-modal">
        <div class="terms-modal-content">
            <span class="close-modal">&times;</span>
            <h2>HRIS Terms and Conditions</h2>
            <div class="terms-content">
                <p class="terms-intro">
                    Welcome to the Human Resource Information System (HRIS). This platform is designed to help you manage and access important work-related information such as Payroll, Attendance, Leaves, Loans, Employee Information, and Contributions. By using this system, you agree to follow these guidelines to ensure its secure and proper use.
                </p>

                <h3>1. Purpose of the HRIS</h3>
                <p>The HRIS is provided to facilitate employee access to:</p>
                <ul>
                    <li>Payroll and payslips</li>
                    <li>Attendance records and schedules</li>
                    <li>Leave balances and applications</li>
                    <li>Loan applications and tracking</li>
                    <li>Personal and employment information</li>
                    <li>Government contributions (e.g., SSS, PhilHealth, Pag-IBIG)</li>
                </ul>
                <p>Use the system responsibly and only for its intended purposes.</p>

                <h3>2. Access and Security</h3>
                <ul>
                    <li>Authorized Access Only: Access is granted to employees for official use. Unauthorized access is strictly prohibited.</li>
                    <li>Protect Your Login: Do not share your username or password with anyone. You are responsible for all activities under your account.</li>
                    <li>Secure Your Session: Always log out after using the HRIS, especially on shared or public devices.</li>
                    <li>Report Issues: Notify HR or IT immediately if you notice suspicious activity or unauthorized access.</li>
                </ul>

                <h3>3. Data Privacy and Confidentiality</h3>
                <ul>
                    <li>Protect Personal Data: The HRIS contains confidential information. Do not download, share, or copy data unless authorized.</li>
                    <li>Work-Related Use Only: Use the HRIS exclusively for work-related tasks. Personal or inappropriate use is not allowed.</li>
                    <li>Follow Privacy Laws: Comply with the Data Privacy Act of 2012 and company policies regarding the handling of sensitive information.</li>
                </ul>

                <h3>4. Information Accuracy</h3>
                <ul>
                    <li>Provide Accurate Information: Ensure that all data you input, such as leave applications, attendance logs, or personal details, is accurate and truthful.</li>
                    <li>Avoid Falsification: Deliberately providing false information is a serious violation and may result in disciplinary action.</li>
                </ul>

                <h3>5. Prohibited Actions</h3>
                <p>To maintain the integrity of the HRIS, the following actions are not allowed:</p>
                <ul>
                    <li>Sharing payroll or employee data with unauthorized individuals.</li>
                    <li>Altering or tampering with attendance, payroll, or leave records.</li>
                    <li>Using the HRIS for personal gain, inappropriate activities, or illegal purposes.</li>
                    <li>Uploading, installing, or introducing unauthorized files or programs into the system.</li>
                </ul>

                <h3>6. System Monitoring and Maintenance</h3>
                <ul>
                    <li>Activity Monitoring: Your use of the HRIS is monitored to ensure compliance with these terms.</li>
                    <li>Maintenance Downtime: The HRIS may occasionally be unavailable for updates or repairs. Whenever possible, you will be informed in advance.</li>
                </ul>

                <h3>7. Non-Compliance and Consequences</h3>
                <ul>
                    <li>Disciplinary Action: Misuse of the HRIS or failure to follow these guidelines may result in warnings, access restrictions, or termination of employment.</li>
                    <li>Legal Action: Violations of data privacy laws may lead to criminal or civil liability.</li>
                </ul>

                <h3>8. Updates to Terms</h3>
                <p>The company may update these Terms and Conditions as necessary. You will be notified of any changes, and continued use of the HRIS indicates your acceptance of the updated terms.</p>

                <h3>9. Acceptance of Terms</h3>
                <p>By logging into and using the HRIS, you confirm that you have read, understood, and agreed to these Terms and Conditions.</p>
                
                <p class="contact-info">For questions or concerns, please contact the HR Department or IT Support.</p>
            </div>
            <button id="accept-terms" class="accept-terms-btn">I Accept</button>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            if (!termsCheckbox.checked) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terms & Conditions Required',
                    text: 'Please read and accept the Terms and Conditions to continue.',
                    confirmButtonColor: '#0066ff'
                });
                return;
            }

            // Show loader
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

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
                    // Reset button state
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;

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
                // Reset button state
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;

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

        // Terms and Conditions Modal
        const termsModal = document.getElementById('terms-modal');
        const termsLink = document.getElementById('terms-link');
        const closeModal = document.querySelector('.close-modal');
        const acceptTermsBtn = document.getElementById('accept-terms');
        const termsCheckbox = document.getElementById('terms-checkbox');
        const submitBtn = document.getElementById('submit-btn');
        const termsContent = document.querySelector('.terms-modal-content');

        // Disable accept button initially
        acceptTermsBtn.disabled = true;

        // Handle checkbox click
        termsCheckbox.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent direct checkbox checking
            termsModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        // Track scrolling in terms modal
        termsContent.addEventListener('scroll', function() {
            const scrollPercentage = (termsContent.scrollTop / (termsContent.scrollHeight - termsContent.clientHeight)) * 100;
            
            // Enable accept button when scrolled to bottom (95% threshold)
            if (scrollPercentage > 95) {
                acceptTermsBtn.disabled = false;
            }
        });

        closeModal.addEventListener('click', function() {
            if (!termsCheckbox.checked) {
                termsModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        acceptTermsBtn.addEventListener('click', function() {
            termsCheckbox.checked = true;
            termsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Prevent closing modal by clicking outside if not accepted
        window.addEventListener('click', function(e) {
            if (e.target === termsModal && !termsCheckbox.checked) {
                termsModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Reset scroll position when opening modal
        termsLink.addEventListener('click', function(e) {
            e.preventDefault();
            termsModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            termsContent.scrollTop = 0;
            acceptTermsBtn.disabled = true;
        });
    </script>
</body>
</html>
