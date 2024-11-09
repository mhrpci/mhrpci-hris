<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ $employee->first_name }}'s Portfolio</title>
 <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #3b82f6;
            --accent-color: #60a5fa;
            --text-color: #1f2937;
            --light-gray: #f3f4f6;
            --gradient: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --hover-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            background: var(--light-gray);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        .header {
            background: var(--gradient);
            padding: 2rem;
            border-radius: 1rem;
            margin: 1rem auto;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(8px);
            box-shadow: var(--card-shadow);
        }

        .app-name {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.025em;
        }

        .profile-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            display: grid;
            grid-template-columns: minmax(250px, 300px) 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.3s ease;
        }

        .profile-section:hover {
            box-shadow: var(--hover-shadow);
        }

        .profile-image-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            border-radius: 1rem;
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 1rem;
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.02);
        }

        .name {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            background: var(--light-gray);
            padding: 1.25rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-color);
            display: block;
            margin-bottom: 0.3rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .qr-container {
            position: relative;
        }

        .qr-section {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: var(--hover-shadow);
            margin-top: 1rem;
            text-align: center;
            display: none;
            animation: slideIn 0.3s ease;
            z-index: 100;
            min-width: 200px;
        }

        .toggle-qr-btn {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(4px);
        }

        .toggle-qr-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .portfolio-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .portfolio-section:hover {
            box-shadow: var(--hover-shadow);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            color: var(--text-color);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--gradient);
            border-radius: 1.5px;
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .skill-item {
            background: var(--light-gray);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: default;
        }

        .skill-item:hover {
            background: var(--gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .experience-item {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-left: 3px solid var(--primary-color);
            background: var(--light-gray);
            border-radius: 0 0.75rem 0.75rem 0;
            transition: all 0.3s ease;
        }

        .experience-item:hover {
            transform: translateX(4px);
            box-shadow: var(--card-shadow);
        }

        .experience-title {
            font-weight: 600;
            font-size: 1.125rem;
            color: var(--text-color);
            margin-bottom: 0.25rem;
        }

        .experience-company {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .experience-date {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0.75rem;
            }

            .profile-section {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 1.5rem;
            }

            .name {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .profile-image-container {
                max-width: 250px;
                margin: 0 auto;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                padding: 1.5rem;
            }

            .qr-section {
                right: 50%;
                transform: translateX(50%);
            }

            .portfolio-section {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .skills-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .name {
                font-size: 1.75rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --text-color: #f3f4f6;
                --light-gray: #1f2937;
            }

            body {
                background: #111827;
            }

            .profile-section,
            .portfolio-section,
            .qr-section {
                background: #1f2937;
            }

            .info-item,
            .experience-item {
                background: #111827;
            }

            .skill-item {
                background: #374151;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="app-name">{{ config('app.name') }}</div>
            <div class="qr-container">
                <button class="toggle-qr-btn" onclick="toggleQR()">
                    <i class="fas fa-qrcode"></i>
                    QR Code
                </button>
                <div class="qr-section">
                    <h3>Scan to view profile</h3>
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <div class="profile-image-container">
                <img src="{{ $employee->profile ? Storage::url($employee->profile) : asset('images/default-profile.png') }}"
                     alt="{{ $employee->first_name }}'s Profile Picture"
                     class="profile-image">
            </div>

            <div class="profile-info">
                <div class="name">
                    {{ $employee->first_name }}
                    {{ $employee->middle_name }}
                    {{ $employee->last_name }}
                    {{ $employee->suffix }}
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Email Address</span>
                        {{ $employee->email_address }}
                    </div>

                    <div class="info-item">
                        <span class="info-label">Contact Number</span>
                        {{ $employee->contact_no }}
                    </div>

                    <div class="info-item">
                        <span class="info-label">Birth Date</span>
                        {{ \Carbon\Carbon::parse($employee->birth_date)->format('F d, Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio-section">
            <h2 class="section-title">About Me</h2>
            <p>{{ $employee->bio ?? 'A passionate professional dedicated to excellence in their field.' }}</p>
        </div>

        <div class="portfolio-section">
            <h2 class="section-title">Skills & Expertise</h2>
            <div class="skills-grid">
                @foreach($employee->skills ?? ['Leadership', 'Project Management', 'Communication', 'Problem Solving'] as $skill)
                    <div class="skill-item">{{ $skill }}</div>
                @endforeach
            </div>
        </div>

        <div class="portfolio-section">
            <h2 class="section-title">Work Experience</h2>
            @forelse($employee->experiences ?? [] as $experience)
                <div class="experience-item">
                    <div class="experience-title">{{ $experience->position }}</div>
                    <div class="experience-company">{{ $experience->company }}</div>
                    <div class="experience-date">{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</div>
                    <p>{{ $experience->description }}</p>
                </div>
            @empty
                <div class="experience-item">
                    <div class="experience-title">{{ $employee->position ?? 'Current Position' }}</div>
                    <div class="experience-company">{{ config('app.name') }}</div>
                    <div class="experience-date">Current</div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate QR Code
            var qr = qrcode(0, 'M');
            var currentUrl = window.location.href;
            qr.addData(currentUrl);
            qr.make();

            // Create QR code image with specific size
            var qrImage = qr.createImgTag(5, 10);
            document.getElementById('qrcode').innerHTML = qrImage;
        });

        function toggleQR() {
            const qrSection = document.querySelector('.qr-section');
            const toggleBtn = document.querySelector('.toggle-qr-btn');

            if (qrSection.style.display === 'none' || !qrSection.style.display) {
                qrSection.style.display = 'block';
                toggleBtn.innerHTML = '<i class="fas fa-times"></i> Close';
            } else {
                qrSection.style.display = 'none';
                toggleBtn.innerHTML = '<i class="fas fa-qrcode"></i> QR Code';
            }
        }

        // Close QR when clicking outside
        document.addEventListener('click', function(event) {
            const qrContainer = document.querySelector('.qr-container');
            const qrSection = document.querySelector('.qr-section');
            const toggleBtn = document.querySelector('.toggle-qr-btn');

            if (!qrContainer.contains(event.target) && qrSection.style.display === 'block') {
                qrSection.style.display = 'none';
                toggleBtn.innerHTML = '<i class="fas fa-qrcode"></i> QR Code';
            }
        });
    </script>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>
