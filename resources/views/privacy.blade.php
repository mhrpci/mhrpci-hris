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
            <p>At MHR Property Conglomerates, Inc. (MHRPCI), we collect information necessary for our recruitment and business operations across our diverse portfolio of companies, including:</p>
            <ul>
                <li>Personal identification information (Name, email address, phone number, address)</li>
                <li>Professional credentials (Resume, work history, education, certifications, licenses)</li>
                <li>Employment eligibility documentation</li>
                <li>References and background check information</li>
                <li>Technical information when you use our career portal (IP address, browser type, device information)</li>
            </ul>
        </div>

        <div class="section">
            <h2>2. How We Use Your Information</h2>
            <p>As a conglomerate operating across multiple industries including healthcare, hospitality, petroleum, construction, and pharmaceuticals, we use your information to:</p>
            <ul>
                <li>Process applications across our subsidiary companies (MHRHCI, VHI, BGPDI, MAX, MHRCONS, CIO, LUSCO, RCG)</li>
                <li>Match candidates with appropriate positions within our group of companies</li>
                <li>Conduct necessary background checks and verification processes</li>
                <li>Communicate about opportunities within any of our subsidiary companies</li>
                <li>Maintain and improve our recruitment processes</li>
                <li>Comply with Philippine labor laws and regulations</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Information Sharing and Disclosure</h2>
            <p>As a conglomerate with multiple subsidiaries, we may share your information:</p>
            <ul>
                <li>Among our subsidiary companies for relevant job opportunities</li>
                <li>With our HR service providers and recruitment partners</li>
                <li>With background checking agencies (with your consent)</li>
                <li>With government authorities as required by Philippine law</li>
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

        <div class="section">
            <h2>7. Contact Information</h2>
            <p>For privacy-related inquiries or to exercise your rights, please contact us at:</p>
            <p>MHR Property Conglomerates, Inc.<br>
            MHR Building, Jose L. Briones St.,<br>
            North Reclamation Area, Cebu City,<br>
            Cebu, Philippines 6000<br>
            Phone: (032) 238-1887<br>
            Email: {{ config('app.company_email') }}</p>
        </div>

        <p class="last-updated">Last Updated: {{ date('F d, Y') }}</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
