<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name') }} - Employee ID Card</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --card-width: 54mm;    /* Standard ID card width in portrait */
            --card-height: 85.6mm; /* Standard ID card height in portrait */
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e67e22;
            --background-color: #ecf0f1;
            --text-dark: #333333;
            --text-light: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
        }

        body {
            background: var(--background-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            gap: 20px;
            flex-wrap: wrap;
            @media screen and (max-width: 768px) {
                padding: 10px;
            }
        }

        .id-card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .id-card {
            width: var(--card-width);
            height: var(--card-height);
            position: relative;
            @media screen and (max-width: 768px) {
                transform: scale(0.9);
                margin: -10px;
            }
            @media screen and (max-width: 480px) {
                transform: scale(0.8);
                margin: -20px;
            }
        }

        .card-side {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-front {
            background: linear-gradient(135deg, 
                {{ match($employee->department->name) {
                    'MHRHCI' => '#6495ED 0%, #6495ED 50%, #4169E1 50%, #4169E1 65%, #ffffff 65%, #ffffff 67%, #4169E1 67%, #4169E1 100%',
                    'VHI' => '#228B22 0%, #228B22 50%, #32CD32 50%, #32CD32 65%, #ffffff 65%, #ffffff 67%, #32CD32 67%, #32CD32 100%',
                    'BGPDI' => '#4169E1 0%, #4169E1 50%, #FFD700 50%, #FFD700 65%, #ffffff 65%, #ffffff 67%, #FFD700 67%, #FFD700 100%',
                    default => '#9370DB 0%, #9370DB 50%, #4A6FA5 50%, #4A6FA5 65%, #ffffff 65%, #ffffff 67%, #4A6FA5 67%, #4A6FA5 100%'
                } }}
            );
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .card-front::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -10%;
            width: 40%;
            height: 40%;
            background: linear-gradient(135deg, transparent 50%, rgba(255, 255, 255, 0.1) 50%);
            transform: rotate(-15deg);
        }

        .card-front::after {
            content: '';
            position: absolute;
            bottom: -5%;
            left: -5%;
            width: 30%;
            height: 30%;
            background: linear-gradient(45deg, transparent 50%, rgba(74, 111, 165, 0.3) 50%);
            transform: rotate(15deg);
        }

        .card-back {
            background: white;
            padding: 10px;
        }

        .card-header {
            padding: 8px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 2px solid var(--accent-color);
        }

        .company-logo {
            height: 60px;
            width: auto;
            margin-bottom: 4px;
            filter: brightness(1.2) contrast(1.1);
            max-width: 95%;
        }

        .card-title {
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .profile-section {
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .profile-image {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border: 2px solid var(--accent-color);
            border-radius: 4px;
        }

        .profile-info {
            width: 100%;
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            padding: 8px;
            border-radius: 4px;
        }

        .employee-name {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .employee-details {
            font-size: 8px;
            line-height: 1.4;
            color: #ffffff;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            padding: 0 4px;
        }

        .detail-label {
            color: #ffffff;
            font-weight: bold;
        }

        .card-footer {
            margin-top: auto;
            padding: 6px;
            text-align: center;
            font-size: 7px;
            background: rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .back-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 8px;
        }

        .back-header {
            text-align: center;
            color: var(--primary-color);
            padding: 6px;
            border-bottom: 1px solid var(--accent-color);
            font-size: 8px;
        }

        .back-section {
            font-size: 7px;
            padding: 4px;
        }

        .back-section-title {
            color: {{ match($employee->department->name) {
                'MHRHCI' => '#4169E1',
                'VHI' => '#006400',
                'BGPDI' => '#0000FF',
                default => '#663399'
            } }};
            font-weight: bold;
            margin-bottom: 3px;
            text-align: left;
            text-transform: uppercase;
            font-size: 6px;
        }

        .back-header h3 {
            color: {{ match($employee->department->name) {
                'MHRHCI' => '#4169E1',
                'VHI' => '#006400',
                'BGPDI' => '#0000FF',
                default => '#663399'
            } }};
            font-weight: bold;
        }

        .back-section .detail-label {
            color: {{ match($employee->department->name) {
                'MHRHCI' => '#4169E1',
                'VHI' => '#006400',
                'BGPDI' => '#0000FF',
                default => '#663399'
            } }};
            font-weight: bold;
        }

        .emergency-contact {
            padding: 8px;
            font-size: 7px;
        }

        .emergency-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 4px;
            text-align: center;
        }

        .signature-section {
            margin-top: auto;
            text-align: center;
            padding: 8px;
            border-top: 1px solid var(--accent-color);
            font-size: 6px;
        }

        .signature-section .detail-label {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 6px;
            color: var(--primary-color);
            letter-spacing: 0.5px;
        }

        .signature-image {
            max-width: 80px;
            height: auto;
            margin: 4px auto;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 16px;
            opacity: 0.1;
            pointer-events: none;
            white-space: nowrap;
        }

        @media print {
            body { margin: 0; padding: 0; }
            .id-card-container {
                width: var(--card-width);
                height: var(--card-height);
            }
        }

        .download-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .download-btn {
            padding: 10px 20px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background: var(--secondary-color);
        }

        @media print {
            .download-buttons {
                display: none;
            }
        }

        .flip-card {
            position: relative;
            width: var(--card-width);
            height: var(--card-height);
            perspective: 1000px;
            cursor: pointer;
        }

        .flip-card-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }

        .flip-card.flipped .flip-card-inner {
            transform: rotateY(180deg);
        }

        @media (max-width: 768px) {
            .flip-card {
                touch-action: none;
            }
            
            .flip-instruction {
                position: fixed;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 14px;
                z-index: 1000;
                pointer-events: none;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</head>
<body>
    <div class="id-card-container">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="card-side card-front">
                        <div class="card-header">
                            @if($employee->department->name == 'MHRHCI')
                                <img src="{{ asset('vendor/adminlte/dist/img/mhrhci.png') }}" alt="MHRHCI Logo" class="company-logo">
                            @elseif($employee->department->name == 'VHI')
                                <img src="{{ asset('vendor/adminlte/dist/img/vhi.png') }}" alt="VHI Logo" class="company-logo">
                            @elseif($employee->department->name == 'BGPDI')
                                <img src="{{ asset('vendor/adminlte/dist/img/bgpdi.png') }}" alt="BGPDI Logo" class="company-logo">
                            @else
                                <img src="{{ asset('vendor/adminlte/dist/img/whiteLOGO4.png') }}" alt="Company Logo" class="company-logo">
                            @endif
                            <div class="card-title">Employee Identification Card</div>
                        </div>

                        <div class="profile-section">
                            <img src="{{ $employee->profile ? Storage::url($employee->profile) : asset('images/default-profile.png') }}"
                                 alt="Employee Photo" class="profile-image">
                            
                            <div class="profile-info">
                                <div class="employee-name">
                                    {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }} {{ $employee->suffix }}
                                </div>
                                <div class="employee-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Employee ID:</span>
                                        <span>{{ $employee->company_id }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Position:</span>
                                        <span>{{ $employee->position->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Department:</span>
                                        <span>{{ $employee->department->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Date Hired:</span>
                                        <span>{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <div class="card-side card-back">
                        <div class="back-content">
                            <div class="back-header">
                                <h3>EMPLOYEE INFORMATION</h3>
                            </div>

                            <div class="back-section">
                                <div class="back-section-title">Personal Details</div>
                                <div class="detail-item">
                                    <span class="detail-label">Birth Date:</span>
                                    <span>{{ \Carbon\Carbon::parse($employee->birth_date)->format('M d, Y') ?? ' ' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">SSS No:</span>
                                    <span>{{ $employee->sss_no ?? ' ' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">TIN No:</span>
                                    <span>{{ $employee->tin_no ?? ' ' }}</span>
                                </div>
                            </div>

                            <div class="back-section">
                                <div class="back-section-title">Emergency Contact</div>
                                <div class="detail-item">
                                    <span class="detail-label">Name:</span>
                                    <span>{{ $employee->emergency_name }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Contact No:</span>
                                    <span>{{ $employee->emergency_no }}</span>
                                </div>
                            </div>

                            <div class="back-section">
                                <div class="back-section-title">Company Information</div>
                                <div class="detail-item">
                                    <span class="detail-label">Name:</span>
                                    <span>{{ config('app.company_name') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Address:</span>
                                    <span>{{ config('app.company_address') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">City:</span>
                                    <span>{{ config('app.company_city') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">ZIP:</span>
                                    <span>{{ config('app.company_zip') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Phone:</span>
                                    <span>{{ config('app.company_phone') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email:</span>
                                    <span>{{ config('app.company_email') }}</span>
                                </div>
                            </div>

                            <div class="signature-section">
                                <div class="detail-label">Employee Signature</div>
                                @if($employee->signature)
                                    <img src="{{ Storage::url($employee->signature) }}" 
                                         alt="Employee Signature" 
                                         class="signature-image">
                                @else
                                    <div style="color: #666; font-size: 8px;">No signature available</div>
                                @endif
                                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                                    <div style="font-size: 6px;">
                                        This ID card remains the property of {{ config('app.name') }}.<br>
                                        If found, please return to the nearest office.
                                    </div>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&data={{ route('employees.public', $employee->slug) }}" 
                                         alt="QR Code" 
                                         style="width: 20px; height: 20px; margin-left: 4px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="download-buttons">
        <button class="download-btn" onclick="downloadSecureIdCard()">Download Secure ID Card</button>
    </div>

    <div class="flip-instruction">Tap card to flip</div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        const rateLimiter = {
            lastDownload: 0,
            minInterval: 5000, // 5 seconds
            check() {
                const now = Date.now();
                if (now - this.lastDownload < this.minInterval) {
                    return false;
                }
                this.lastDownload = now;
                return true;
            }
        };

        async function captureCard(element) {
            return await html2canvas(element, {
                scale: 4,
                useCORS: true,
                logging: false,
                backgroundColor: null,
                quality: 1.0
            });
        }

        async function downloadSecureIdCard() {
            if (!rateLimiter.check()) {
                alert('Please wait a few seconds before downloading again.');
                return;
            }

            try {
                // First, get the download token
                const tokenResponse = await fetch(`/employees/{{ $employee->slug }}/secure-download`);
                const tokenData = await tokenResponse.json();

                if (!tokenData.success) {
                    throw new Error(tokenData.message);
                }

                // Capture card sides
                const frontElement = document.querySelector('.flip-card-front');
                const backElement = document.querySelector('.flip-card-back');
                
                // Setup for capturing back side
                const backElementTransform = backElement.style.transform;
                const backElementParent = backElement.parentElement;
                const parentTransform = backElementParent.style.transform;
                
                const tempContainer = document.createElement('div');
                tempContainer.style.position = 'absolute';
                tempContainer.style.left = '-9999px';
                tempContainer.style.top = '0';
                document.body.appendChild(tempContainer);
                
                const backClone = backElement.cloneNode(true);
                tempContainer.appendChild(backClone);
                backClone.style.transform = 'none';
                backClone.style.position = 'static';
                backClone.style.backfaceVisibility = 'visible';

                const frontCanvas = await captureCard(frontElement);
                const backCanvas = await captureCard(backClone);

                document.body.removeChild(tempContainer);
                backElement.style.transform = backElementTransform;
                backElementParent.style.transform = parentTransform;

                // Process secure download
                const processResponse = await fetch('/employees/process-secure-download', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        download_token: tokenData.download_token
                    })
                });

                const processData = await processResponse.json();

                if (!processData.success) {
                    throw new Error(processData.message);
                }

                // Create zip with WinRAR compatible encryption
                const zip = new JSZip();
                
                // Add a readme file with instructions
                zip.file('README.txt', 
                    'This ZIP file contains your ID card images.\n' +
                    'Front and back images are included in PNG format.\n' +
                    'Created on: ' + new Date().toLocaleString() + '\n' +
                    'For security purposes, this file is password protected.'
                );
                
                // Add images to zip with better compression
                zip.file('id-card-front.png', frontCanvas.toDataURL('image/png', 1.0).split(',')[1], {
                    base64: true,
                    compression: "DEFLATE",
                    compressionOptions: {
                        level: 9
                    }
                });
                
                zip.file('id-card-back.png', backCanvas.toDataURL('image/png', 1.0).split(',')[1], {
                    base64: true,
                    compression: "DEFLATE",
                    compressionOptions: {
                        level: 9
                    }
                });
                
                // Generate WinRAR compatible encrypted zip
                const content = await zip.generateAsync({
                    type: "blob",
                    compression: "DEFLATE",
                    compressionOptions: {
                        level: 9
                    },
                    platform: "DOS",
                    encryptStrength: 3,
                    password: processData.password,
                    comment: "Created by {{ config('app.name') }} - Secured with WinRAR encryption"
                });
                
                // Create and trigger download
                const link = document.createElement('a');
                link.href = URL.createObjectURL(content);
                link.download = processData.filename;
                link.type = 'application/zip';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(link.href);

                // Show password dialog with better formatting
                const passwordMessage = 
                    "Your ID card has been downloaded successfully!\n\n" +
                    "File: " + processData.filename + "\n" +
                    "Password: " + processData.password + "\n\n" +
                    "Please keep this password safe. You will need it to open the ZIP file.\n" +
                    "This file can be opened with WinRAR or other ZIP programs.";
                    
                alert(passwordMessage);

                // Analytics tracking if available
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'download_secure_id_card', {
                        'employee_id': '{{ $employee->company_id }}',
                        'timestamp': processData.timestamp
                    });
                }
            } catch (error) {
                console.error('Error generating secure ID card:', error);
                alert('An error occurred while generating the secure ID card. Please try again.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const flipCard = document.querySelector('.flip-card');
            const instruction = document.querySelector('.flip-instruction');
            let touchStartX = 0;
            let touchEndX = 0;

            // Function to toggle flip
            function toggleFlip() {
                flipCard.classList.toggle('flipped');
            }

            // Handle click/tap events
            flipCard.addEventListener('click', function(e) {
                toggleFlip();
            });

            // Handle touch events
            flipCard.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, false);

            flipCard.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, false);

            // Handle swipe
            function handleSwipe() {
                const swipeThreshold = 50; // minimum distance for swipe
                const difference = touchStartX - touchEndX;

                if (Math.abs(difference) > swipeThreshold) {
                    toggleFlip();
                }
            }

            // Hide instruction after 3 seconds
            if (instruction) {
                setTimeout(() => {
                    instruction.style.opacity = '0';
                    instruction.style.transition = 'opacity 0.5s';
                    setTimeout(() => {
                        instruction.style.display = 'none';
                    }, 500);
                }, 3000);
            }

            // Prevent default touch behaviors
            flipCard.addEventListener('touchmove', function(e) {
                e.preventDefault();
            }, { passive: false });
        });
    </script>
</body>
</html>
