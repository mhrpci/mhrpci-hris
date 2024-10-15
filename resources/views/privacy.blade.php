<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - MHRPCI</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7f9;
        }
        .container {
            max-width: 900px;
            background-color: #fff;
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 700;
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
        }
        h2 {
            color: #2980b9;
            margin-top: 30px;
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 1.5rem;
        }
        p, li {
            margin-bottom: 15px;
            font-weight: 300;
            font-size: 1rem;
        }
        .section {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
        }
        .last-updated {
            font-style: italic;
            color: #7f8c8d;
            margin-top: 30px;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            h1 {
                font-size: 1.8rem;
            }
            h2 {
                font-size: 1.3rem;
            }
            p, li {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    @include('preloader')
    <div class="container">
        <h1 class="text-center">Privacy Policy</h1>

        <div class="section">
            <h2>1. Information We Collect</h2>
            <p>We collect information you provide directly to us, such as when you create an account, submit a job application, or communicate with us. This may include:</p>
            <ul>
                <li>Personal identification information (Name, email address, phone number, etc.)</li>
                <li>Professional information (Resume, work history, education, etc.)</li>
                <li>Any other information you choose to provide</li>
            </ul>
        </div>

        <div class="section">
            <h2>2. How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Process your job application</li>
                <li>Communicate with you about potential opportunities</li>
                <li>Improve our services and user experience</li>
                <li>Comply with legal obligations</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Information Sharing and Disclosure</h2>
            <p>We do not share your personal information with third parties except as described in this policy or with your explicit consent. We may share information with:</p>
            <ul>
                <li>Potential employers (only with your permission)</li>
                <li>Service providers who assist us in operating our platform</li>
                <li>Law enforcement or other authorities if required by law</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Data Security</h2>
            <p>We implement industry-standard security measures to protect the confidentiality and integrity of your personal information. These measures include encryption, secure servers, and regular security audits.</p>
        </div>

        <div class="section">
            <h2>5. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal information</li>
                <li>Correct inaccuracies in your personal information</li>
                <li>Delete your personal information</li>
                <li>Object to the processing of your personal information</li>
                <li>Request a copy of your personal information</li>
            </ul>
            <p>To exercise these rights, please contact us using the information provided at the end of this policy.</p>
        </div>

        <div class="section">
            <h2>6. Changes to This Policy</h2>
            <p>We may update this privacy policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We will notify you of any material changes by posting the new privacy policy on this page and updating the "Last Updated" date.</p>
        </div>

        <p class="last-updated">Last Updated: {{ date('F d, Y') }}</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
