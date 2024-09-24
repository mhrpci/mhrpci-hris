<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Status Update</title>
</head>
<body>
    <h1>Leave Request Status Update</h1>

    <p>Dear {{ $leave->employee->first_name }},</p>

    <p>Your leave request for the period {{ $leave->start_date }} to {{ $leave->end_date }} has been <strong>{{ $leave->status }}</strong>.</p>

    <p><strong>Reason for leave:</strong> {{ $leave->reason }}</p>

    @if($leave->status === 'approved')
        <p>Enjoy your time off!</p>
    @else
        <p>If you have any questions regarding this decision, please contact your supervisor or HR department.</p>
    @endif

    <p>Thank you for your understanding.</p>

    <p>Best regards,<br>HR Department</p>
</body>
</html>
