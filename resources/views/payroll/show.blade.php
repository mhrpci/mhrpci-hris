@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Payroll Details</h1>

    <!-- Print Button -->
    <button onclick="printPage()" class="btn btn-primary mb-3">Print</button>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Detail</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $payroll->employee_id }}</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ $payroll->start_date }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ $payroll->end_date }}</td>
                </tr>
                <tr>
                    <th>Gross Salary</th>
                    <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                </tr>
                <tr>
                    <th>Net Salary</th>
                    <td>{{ number_format($payroll->net_salary, 2) }}</td>
                </tr>
                <tr>
                    <th>Late Deduction</th>
                    <td>{{ number_format($payroll->late_deduction, 2) }}</td>
                </tr>
                <tr>
                    <th>Undertime Deduction</th>
                    <td>{{ number_format($payroll->undertime_deduction, 2) }}</td>
                </tr>
                <tr>
                    <th>Absent Deduction</th>
                    <td>{{ number_format($payroll->absent_deduction, 2) }}</td>
                </tr>
                <tr>
                    <th>SSS Contribution</th>
                    <td>{{ number_format($payroll->sss_contribution, 2) }}</td>
                </tr>
                <tr>
                    <th>Pag-IBIG Contribution</th>
                    <td>{{ number_format($payroll->pagibig_contribution, 2) }}</td>
                </tr>
                <tr>
                    <th>PhilHealth Contribution</th>
                    <td>{{ number_format($payroll->philhealth_contribution, 2) }}</td>
                </tr>
                <tr>
                    <th>TIN Contribution</th>
                    <td>{{ number_format($payroll->tin_contribution, 2) }}</td>
                </tr>
                <tr>
                    <th>SSS Loan</th>
                    <td>{{ number_format($payroll->sss_loan, 2) }}</td>
                </tr>
                <tr>
                    <th>Pag-IBIG Loan</th>
                    <td>{{ number_format($payroll->pagibig_loan, 2) }}</td>
                </tr>
                <tr>
                    <th>Cash Advance</th>
                    <td>{{ number_format($payroll->cash_advance, 2) }}</td>
                </tr>
                <tr>
                    <th>Overtime Pay</th>
                    <td>{{ number_format($payroll->overtime_pay, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <a href="{{ route('payroll.index') }}" class="btn btn-secondary">Back to Payroll List</a>
</div>

<!-- Print JavaScript -->
<script>
    function printPage() {
        var printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        printWindow.document.write('</head><body >');
        printWindow.document.write(document.querySelector('.container').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }
</script>
@endsection
