<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            background-color: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('vendor/adminlte/dist/img/LOGO4.png') }}" alt="Company Logo" class="logo">
    <h1>Loan Report</h1>
    <p>Period: {{ $startDate->format('M d, Y') }} to {{ $endDate->format('M d, Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>SSS Loan</th>
                <th>Pag-IBIG Loan</th>
                <th>Cash Advance</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->employee->employee_id }}</td>
                <td>{{ $loan->employee->full_name }}</td>
                <td>{{ $loan->date->format('M d, Y') }}</td>
                <td>Php{{ number_format($loan->sss_loan, 2, '.', ',') }}</td>
                <td>Php{{ number_format($loan->pagibig_loan, 2, '.', ',') }}</td>
                <td>Php{{ number_format($loan->cash_advance, 2, '.', ',') }}</td>
                <td>Php{{ number_format($loan->sss_loan + $loan->pagibig_loan + $loan->cash_advance, 2, '.', ',') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h2>Summary</h2>
        <p>Total SSS Loans: Php{{ number_format($loans->sum('sss_loan'), 2, '.', ',') }}</p>
        <p>Total Pag-IBIG Loans: Php{{ number_format($loans->sum('pagibig_loan'), 2, '.', ',') }}</p>
        <p>Total Cash Advances: Php{{ number_format($loans->sum('cash_advance'), 2, '.', ',') }}</p>
        <p><strong>Total Loan Amount: Php{{ number_format($totalAmount, 2, '.', ',') }}</strong></p>
    </div>

    <footer>
        <p>Generated on {{ now()->format('F d, Y H:i:s') }}</p>
    </footer>
</body>
</html>
