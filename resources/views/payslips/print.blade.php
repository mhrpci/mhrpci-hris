<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Payslip</h2>
    </div>
    <div class="details">
        <p><strong>Employee Name:</strong> {{ $payroll->employee->name }}</p>
        <p><strong>Start Date:</strong> {{ $payroll->start_date }}</p>
        <p><strong>End Date:</strong> {{ $payroll->end_date }}</p>
        <p><strong>Total Salary:</strong> {{ $payroll->total_salary }}</p>
    </div>
</body>
</html>
