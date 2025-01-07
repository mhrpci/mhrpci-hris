<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Policies | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --background-color: #f0f9ff;
            --text-color: #1e293b;
            --accent-color: #3b82f6;
            --hover-color: #2563eb;
        }
        body {
            background-color: var(--background-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
        }
        .container-fluid {
            max-width: 1200px;
            padding: 2rem 1rem;
        }
        .section-title {
            color: var(--secondary-color);
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 0.5rem;
            margin-top: 3rem;
            font-weight: 600;
            font-size: 1.8rem;
        }
        .policy-page {
            background-color: #fff;
            border-radius: 15px;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .policy-page:hover {
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }
        .policy-title {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            padding: 1.5rem;
            background-color: #e0f2fe;
            margin: 0;
            border-bottom: 2px solid var(--accent-color);
        }
        .policy-content {
            font-size: 1rem;
            line-height: 1.8;
            padding: 2rem;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .policy-content p,
        .policy-content li {
            margin-bottom: 1rem;
        }
        .policy-content h1, .policy-content h2, .policy-content h3,
        .policy-content h4, .policy-content h5, .policy-content h6 {
            color: var(--secondary-color);
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .policy-content ul, .policy-content ol {
            padding-left: 2rem;
        }
        .policy-content li {
            margin-bottom: 0.5rem;
        }
        .policy-content table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }
        .policy-content th, .policy-content td {
            border: 1px solid #e2e8f0;
            padding: 0.75rem;
            text-align: left;
        }
        .policy-content th {
            background-color: #e0f2fe;
            font-weight: 600;
            color: var(--secondary-color);
        }
        .btn-back {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
            font-weight: 500;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-back:hover {
            background-color: var(--hover-color);
            color: white;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .last-updated {
            font-size: 0.9rem;
            color: #64748b;
            font-style: italic;
            margin-top: 1rem;
        }
        .company-logo {
            max-width: 200px;
            margin-bottom: 2rem;
        }
        .sticky-search {
            position: sticky;
            top: 0;
            background-color: rgba(240, 249, 255, 0.95);
            padding: 1rem 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }
        #policies-container {
            padding-top: 2rem;
        }
        #search-results {
            font-weight: 500;
            padding: 1rem;
            background-color: #e0f2fe;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .highlight {
            background-color: #fef08a;
            padding: 0.1rem 0.2rem;
            border-radius: 3px;
        }
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
            .policy-title {
                font-size: 1.3rem;
            }
            .section-title {
                font-size: 1.5rem;
            }
            .btn-back {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            pointer-events: none;
            z-index: 10000;
        }
        .dynamic-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.02;
            z-index: 9999;
        }
    </style>
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <a href="javascript:history.back()" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="company-logo">
        </div>

        <h1 class="text-center mb-5" style="color: var(--secondary-color); font-weight: 700; font-size: 2.5rem;">Terms of Use and Privacy Policy</h1>

        <div id="policies-container">
            <div class="policy-page">
                <h3 class="policy-title">Terms of Use</h3>
                <div class="policy-content">
                    <h4>1. Acceptance of Terms</h4>
                    <p>By accessing and using the Human Resources and Information System (HRIS) ("the System"), you agree to comply with these Terms of Use. If you do not agree, you may not use the System.</p>
                    
                    <h4>2. Purpose of the System</h4>
                    <p>The System is designed to manage and streamline human resource activities, including but not limited to employee management, attendance tracking, payroll processing, and performance evaluations.</p>

                    <h4>3. User Responsibilities</h4>
                    <p>3.1 Authorized Access: Access to the System is restricted to authorized personnel only. Sharing login credentials is strictly prohibited.</p>
                    
                    <p>3.2 Accurate Information: Users are responsible for ensuring the accuracy of the data entered into the System. Deliberate entry of false information may result in disciplinary or legal action.</p>
                    
                    <p>3.3 Prohibited Activities: Users must not:</p>
                    <ul>
                        <li>Attempt to hack, disrupt, or manipulate the System.</li>
                        <li>Use the System for any unlawful activities.</li>
                        <li>Share confidential data accessed through the System without proper authorization.</li>
                    </ul>

                    <h4>4. System Availability</h4>
                    <p>The System may experience periodic downtime for maintenance or upgrades. We are not liable for any loss resulting from such downtime.</p>

                    <h4>5. Intellectual Property</h4>
                    <p>All content, software, and features within the System are the intellectual property of [Your Company Name] and are protected by applicable laws. Unauthorized reproduction or redistribution is strictly prohibited.</p>

                    <h4>6. Termination of Access</h4>
                    <p>Access to the System may be terminated or suspended at the discretion of the organization for non-compliance with these terms or misuse of the System.</p>

                    <h4>7. Limitation of Liability</h4>
                    <p>The organization is not responsible for any direct, indirect, incidental, or consequential damages arising from the use of the System.</p>
                </div>
            </div>

            <div class="policy-page">
                <h3 class="policy-title">Privacy Policy</h3>
                <div class="policy-content">
                    <h4>1. Introduction</h4>
                    <p>This Privacy Policy outlines how the System collects, uses, and protects your personal information.</p>

                    <h4>2. Information Collection</h4>
                    <p>2.1 Personal Information: The System collects personal information such as name, address, contact details, job title, and payroll details.</p>
                    
                    <p>2.2 Usage Data: The System automatically collects data about your activities within the System, including log-in times and actions performed.</p>

                    <h4>3. Use of Information</h4>
                    <p>3.1 Purpose of Use: Information collected is used for HR management purposes, including payroll processing, compliance reporting, attendance tracking, and employee evaluations.</p>
                    
                    <p>3.2 Data Sharing: Personal information may be shared with third-party vendors or government agencies only when required for payroll, tax, or legal compliance purposes.</p>

                    <h4>4. Data Protection</h4>
                    <p>4.1 Security Measures: The System employs encryption, firewalls, and access controls to safeguard your data.</p>
                    
                    <p>4.2 User Responsibility: Users are responsible for maintaining the confidentiality of their login credentials and promptly reporting any suspected unauthorized access.</p>

                    <h4>5. Data Retention</h4>
                    <p>Personal data is retained for the duration of employment and as required by applicable laws. Data may be anonymized or securely deleted after retention periods lapse.</p>

                    <h4>6. Rights of Users</h4>
                    <p>Users have the right to:</p>
                    <ul>
                        <li>Access their personal information.</li>
                        <li>Request corrections to inaccuracies.</li>
                        <li>Withdraw consent for specific data uses, where applicable.</li>
                    </ul>

                    <h4>7. Cookies and Tracking</h4>
                    <p>The System may use cookies or similar technologies to improve user experience. You may disable cookies via browser settings, but this may impact functionality.</p>

                    <h4>8. Changes to Privacy Policy</h4>
                    <p>We reserve the right to modify this Privacy Policy at any time. Changes will be communicated via email or an in-System notification.</p>

                    <h4>9. Contact Information</h4>
                    <p>For inquiries regarding these terms or your data, contact us at:</p>
                    <p>{{ config('app.company_name') }}<br>
                    {{ config('app.company_address') }}<br>
                    {{ config('app.company_email') }}<br>
                    {{ config('app.company_phone') }}</p>

                    <p>By using the System, you acknowledge that you have read, understood, and agreed to these Terms of Use and Privacy Policy.</p>
                </div>
            </div>
        </div>
    </div>

    <canvas id="dynamic-bg" class="dynamic-bg"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.keyCode === 44) {
                event.preventDefault();
                return false;
            }
            
            if ((event.ctrlKey && event.shiftKey && (event.keyCode === 73 || event.keyCode === 74 || event.keyCode === 67)) ||
                (event.ctrlKey && event.keyCode === 80) ||
                (event.ctrlKey && event.shiftKey && event.keyCode === 83)) {
                event.preventDefault();
                return false;
            }
        });

        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        setInterval(function() {
            if (window.devtools.isOpen) {
                window.location.href = '/unauthorized';
            }
        }, 1000);

        (function() {
            const devtools = {
                isOpen: false,
                orientation: undefined
            };
            
            const threshold = 160;
            
            const emitEvent = (isOpen, orientation) => {
                window.devtools = {
                    isOpen: isOpen,
                    orientation: orientation
                };
            };
            
            setInterval(function() {
                const widthThreshold = window.outerWidth - window.innerWidth > threshold;
                const heightThreshold = window.outerHeight - window.innerHeight > threshold;
                const orientation = widthThreshold ? 'vertical' : 'horizontal';
                
                if (!(heightThreshold && widthThreshold) && 
                    ((window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized) || 
                    widthThreshold || heightThreshold)) {
                    if (!devtools.isOpen || devtools.orientation !== orientation) {
                        emitEvent(true, orientation);
                    }
                } else {
                    if (devtools.isOpen) {
                        emitEvent(false, undefined);
                    }
                }
            }, 500);
        })();

        const canvas = document.getElementById('dynamic-bg');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }

        function drawPattern() {
            resizeCanvas();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const timestamp = new Date().getTime();
            const text = `DO NOT COPY ${timestamp}`;
            
            ctx.font = '14px Arial';
            ctx.rotate(-15 * Math.PI / 180);
            
            for(let i = -100; i < canvas.width + 100; i += 100) {
                for(let j = -100; j < canvas.height + 100; j += 40) {
                    ctx.fillText(text, i, j);
                }
            }
        }

        setInterval(drawPattern, 1000);
        window.addEventListener('resize', drawPattern);

        document.addEventListener('keyup', function(e) {
            if (e.key === 'PrintScreen' || e.key === 'Snapshot') {
                navigator.clipboard.writeText('');
                alert('Screenshots are not allowed!');
            }
        });

        let blurTimeout;
        window.addEventListener('blur', function() {
            blurTimeout = setTimeout(function() {
                alert('Screen capture detected! This action is not allowed.');
            }, 100);
        });

        window.addEventListener('focus', function() {
            clearTimeout(blurTimeout);
        });

        function protectScreen() {
            if (window.outerWidth - window.innerWidth > 160 || 
                window.outerHeight - window.innerHeight > 160) {
                document.documentElement.style.display = 'none';
                alert('Screen capture detected! This action is not allowed.');
                location.reload();
            }
        }

        setInterval(protectScreen, 100);
    </script>
</body>
</html>
