<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        .id-card-container {
            display: flex;
            gap: 20px;
        }

        .id-card {
            width: var(--card-width);
            height: var(--card-height);
            position: relative;
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
                {{ $employee->department->name == 'MHRHCI' ? 
                    '#4169E1 0%,
                    #4169E1 50%,
                    #000080 50%,
                    #000080 65%,
                    #ffffff 65%,
                    #ffffff 67%,
                    #000080 67%,
                    #000080 100%' : 
                    '#663399 0%,
                    #663399 50%,
                    #4A6FA5 50%,
                    #4A6FA5 65%,
                    #ffffff 65%,
                    #ffffff 67%,
                    #4A6FA5 67%,
                    #4A6FA5 100%'
                }}
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
            color: {{ $employee->department->name == 'MHRHCI' ? '#4169E1' : '#663399' }};
            font-weight: bold;
            margin-bottom: 3px;
            text-align: left;
            text-transform: uppercase;
            font-size: 6px;
        }

        .back-header h3 {
            color: {{ $employee->department->name == 'MHRHCI' ? '#4169E1' : '#663399' }};
            font-weight: bold;
        }

        .back-section .detail-label {
            color: {{ $employee->department->name == 'MHRHCI' ? '#4169E1' : '#663399' }};
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
    </style>
</head>
<body>
    <div class="id-card-container">
        <div class="id-card">
            <div class="card-side card-front">
                <div class="card-header">
                    @if($employee->department->name == 'MHRHCI')
                        <img src="{{ asset('vendor/adminlte/dist/img/mhrhci.png') }}" alt="MHRHCI Logo" class="company-logo">
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
</body>
</html>
