<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name') }} - Employee ID Card</title>
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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</head>
<body>
    <div class="id-card-container">
        <div class="id-card">
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
        
        <div class="id-card">
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
                        <div style="font-size: 7px; margin-top: 4px;">
                            This ID card remains the property of {{ config('app.name') }}.<br>
                            If found, please return to the nearest office.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="download-buttons">
        <button class="download-btn" onclick="downloadBothSides()">Download ID Card</button>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        async function captureCard(element) {
            return await html2canvas(element, {
                scale: 4,
                useCORS: true,
                logging: false,
                width: 212,
                height: 337,
                backgroundColor: null,
                imageTimeout: 0,
                quality: 1.0
            });
        }

        async function downloadBothSides() {
            try {
                const frontElement = document.querySelector('.card-front');
                const backElement = document.querySelector('.card-back');
                
                const [frontCanvas, backCanvas] = await Promise.all([
                    captureCard(frontElement),
                    captureCard(backElement)
                ]);
                
                const zip = new JSZip();
                
                // Add both high-resolution images to zip
                zip.file('id-card-front.png', frontCanvas.toDataURL('image/png', 1.0).split(',')[1], {base64: true});
                zip.file('id-card-back.png', backCanvas.toDataURL('image/png', 1.0).split(',')[1], {base64: true});
                
                // Generate zip with strong password protection
                const content = await zip.generateAsync({
                    type: "blob",
                    compression: "DEFLATE",
                    compressionOptions: {
                        level: 9
                    },
                    password: "{{ $employee->company_id }}",
                    encryptStrength: 3,
                    encryption: "AES-256"
                });
                
                // Create download link
                const link = document.createElement('a');
                link.href = URL.createObjectURL(content);
                link.download = `ID_Card_{{ $employee->company_id }}_${Date.now()}.zip`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(link.href);

                alert('Download complete! Use your Employee ID as the password to open the zip file.');
            } catch (error) {
                console.error('Error generating ID card:', error);
                alert('An error occurred while generating the ID card. Please try again.');
            }
        }
    </script>
</body>
</html>
