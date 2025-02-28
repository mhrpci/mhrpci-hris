<!DOCTYPE html>
<html>
<head>
    <title>Application Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .details-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .details-item {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Replace the src with your actual logo URL -->
        <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="logo">
    </div>

    <p>Dear {{ $application->first_name }} {{ $application->last_name }},</p>

    <p>Thank you for submitting your application for the position of <strong>{{ $hiringDetails->position }}</strong> at our company.</p>

    <div class="details-box">
        <h3 style="margin-top: 0;">Application Details:</h3>
        <div class="details-item">Position: {{ $hiringDetails->position }}</div>
        <div class="details-item">Email: {{ $application->email }}</div>
        <div class="details-item">Phone: {{ $application->phone }}</div>
        <div class="details-item">Experience: {{ $application->experience }} years</div>
        <div class="details-item">LinkedIn: {{ $application->linkedin }}</div>
    </div>

    <p>We have received your resume and cover letter. Our hiring team will review your application and get back to you if your qualifications match our requirements.</p>

    <p>If you have any questions, please don't hesitate to contact us.</p>

    <div class="footer">
        Best regards,<br>
        <strong>MHRPCI Hiring Team</strong>
    </div>
</body>
</html>
