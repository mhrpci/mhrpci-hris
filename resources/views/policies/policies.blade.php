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
            --primary-color: #0f2c5c;    /* Darker blue for professionalism */
            --secondary-color: #1a365d;
            --background-color: #f8fafc;  /* Lighter, cleaner background */
            --text-color: #1e293b;
            --accent-color: #2563eb;
            --hover-color: #1e40af;
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
            max-width: 1000px;  /* Slightly narrower for better readability */
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
        
        /* New header section */
        .policy-header {
            text-align: center;
            padding: 2rem 0;
            margin-bottom: 3rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .policy-header .company-logo {
            max-width: 180px;
            margin-bottom: 1.5rem;
        }
        
        .policy-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .policy-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            font-size: 0.9rem;
            color: #64748b;
            margin-top: 1rem;
        }
        
        /* Enhanced policy page styling */
        .policy-page {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .policy-title {
            background-color: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.75rem 2rem;
        }
        
        .policy-content {
            padding: 2.5rem;
            font-size: 1.05rem;
        }
        
        /* Enhanced typography */
        .policy-content h4 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-top: 2rem;
            margin-bottom: 1.25rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
        }
        
        .policy-content ul {
            margin-bottom: 1.5rem;
        }
        
        .policy-content li {
            margin-bottom: 0.75rem;
            line-height: 1.7;
        }
        
        /* Official document footer */
        .policy-footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 0.9rem;
            color: #64748b;
        }
    </style>
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div class="container-fluid">
        <a href="javascript:history.back()" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
        
        <div class="policy-header">
            <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="company-logo">
            <h1>Terms of Use and Privacy Policy</h1>
            <div class="policy-meta">
                <span><i class="fas fa-calendar-alt me-2"></i> Last Updated: {{ date('F d, Y') }}</span>
                <span><i class="fas fa-file-alt me-2"></i> Document Version: 1.0</span>
            </div>
        </div>
        
        <div id="policies-container">
            <div class="policy-page">
                <h3 class="policy-title">Terms of Use</h3>
                <div class="policy-content">
                    <p>Welcome to the Human Resource Information System (HRIS). This platform is designed to help you manage and access important work-related information such as Payroll, Attendance, Leaves, Loans, Employee Information, and Contributions. By using this system, you agree to follow these guidelines to ensure its secure and proper use.</p>

                    <h4>1. Purpose of the HRIS</h4>
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

                    <h4>2. Access and Security</h4>
                    <ul>
                        <li>Authorized Access Only: Access is granted to employees for official use. Unauthorized access is strictly prohibited.</li>
                        <li>Protect Your Login: Do not share your username or password with anyone. You are responsible for all activities under your account.</li>
                        <li>Secure Your Session: Always log out after using the HRIS, especially on shared or public devices.</li>
                        <li>Report Issues: Notify HR or IT immediately if you notice suspicious activity or unauthorized access.</li>
                    </ul>

                    <h4>3. Data Privacy and Confidentiality</h4>
                    <ul>
                        <li>Protect Personal Data: The HRIS contains confidential information. Do not download, share, or copy data unless authorized.</li>
                        <li>Work-Related Use Only: Use the HRIS exclusively for work-related tasks. Personal or inappropriate use is not allowed.</li>
                        <li>Follow Privacy Laws: Comply with the Data Privacy Act of 2012 and company policies regarding the handling of sensitive information.</li>
                    </ul>

                    <h4>4. Information Accuracy</h4>
                    <ul>
                        <li>Provide Accurate Information: Ensure that all data you input, such as leave applications, attendance logs, or personal details, is accurate and truthful.</li>
                        <li>Avoid Falsification: Deliberately providing false information is a serious violation and may result in disciplinary action.</li>
                    </ul>

                    <h4>5. Prohibited Actions</h4>
                    <p>To maintain the integrity of the HRIS, the following actions are not allowed:</p>
                    <ul>
                        <li>Sharing payroll or employee data with unauthorized individuals.</li>
                        <li>Altering or tampering with attendance, payroll, or leave records.</li>
                        <li>Using the HRIS for personal gain, inappropriate activities, or illegal purposes.</li>
                        <li>Uploading, installing, or introducing unauthorized files or programs into the system.</li>
                    </ul>

                    <h4>6. System Monitoring and Maintenance</h4>
                    <ul>
                        <li>Activity Monitoring: Your use of the HRIS is monitored to ensure compliance with these terms.</li>
                        <li>Maintenance Downtime: The HRIS may occasionally be unavailable for updates or repairs. Whenever possible, you will be informed in advance.</li>
                    </ul>

                    <h4>7. Non-Compliance and Consequences</h4>
                    <ul>
                        <li>Disciplinary Action: Misuse of the HRIS or failure to follow these guidelines may result in warnings, access restrictions, or termination of employment.</li>
                        <li>Legal Action: Violations of data privacy laws may lead to criminal or civil liability.</li>
                    </ul>

                    <h4>8. Updates to Terms</h4>
                    <p>The company may update these Terms and Conditions as necessary. You will be notified of any changes, and continued use of the HRIS indicates your acceptance of the updated terms.</p>

                    <h4>9. Acceptance of Terms</h4>
                    <p>By logging into and using the HRIS, you confirm that you have read, understood, and agreed to these Terms and Conditions.</p>
                    <p>For questions or concerns, please contact the HR Department or IT Support.</p>
                </div>
            </div>
        </div>
        
        <div class="policy-footer">
            <p>This document is officially maintained by {{ config('app.name') }} Human Resources Department</p>
            <p>For inquiries, contact us on Telegram: <a href="https://t.me/MhrHrDepartment" target="_blank">
                <i class="fab fa-telegram"></i> HR DEPARTMENT</a></p>
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
