@extends('layouts.app')

@section('content')
<br>

<!-- Enhanced professional-looking link buttons -->
<div class="mb-4">
    <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
        <a href="{{ route('loan_sss.index') }}" class="contribution-link {{ request()->routeIs('loan_sss.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Sss Loan</span>
                <small class="description">Social Security System</small>
            </div>
        </a>
        <a href="{{ route('loan_pagibig.index') }}" class="contribution-link {{ request()->routeIs('loan_pagibig.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-home"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Pag-IBIG Loan</span>
                <small class="description">Home Development Mutual Fund</small>
            </div>
        </a>
        <a href="{{ route('cash_advances.index') }}" class="contribution-link {{ request()->routeIs('cash_advances.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Cash Advance</span>
                <small class="description">Company Cash Advance</small>
            </div>
        </a>
        <a href="{{ route('philhealth.index') }}" class="contribution-link {{ request()->routeIs('philhealth.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-users"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Borrower</span>
                <small class="description">Loan Applicant List</small>
            </div>
        </a>
    </div>
</div>

<!-- Add success and error message display -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cash Advance List</h3>
        <div class="card-tools">
            <a href="{{ route('cash_advances.create') }}" class="btn btn-success btn-sm rounded-pill">
                Apply for Cash Advance
            </a>
            <button id="export-excel" class="btn btn-primary btn-sm rounded-pill mr-2">
                Export to Excel <i class="fas fa-file-excel"></i>
            </button>
            <form action="{{ route('cash_advances.generate_payments') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-info btn-sm rounded-pill mr-2">
                    Generate Payments <i class="fas fa-money-bill-wave"></i>
                </button>
            </form>
            <!-- New button for generating payment for specific employee -->
            <button type="button" class="btn btn-warning btn-sm rounded-pill" data-toggle="modal" data-target="#generatePaymentModal">
                Generate Payment for Employee <i class="fas fa-user-cog"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="cash_advances" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Employee Name</th>
                <th>Loan Amount</th>
                <th>Repayment Term</th>
                <th>Monthly Amortization</th>
                <th>Total Repayment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cashAdvances as $loan)
                <tr>
                    <td>{{ $loan->employee->last_name }} {{ $loan->employee->first_name }}, {{ $loan->employee->middle_name ?? ' ' }} {{ $loan->employee->suffix ?? ' ' }}</td>
                    <td>₱{{ number_format($loan->cash_advance_amount, 2) }}</td>
                    <td>{{ $loan->repayment_term }} {{ $loan->repayment_term <= 1 ? 'Month' : 'Months' }}</td>
                    <td>₱{{ number_format($loan->monthly_amortization, 2) }}</td>
                    <td>₱{{ number_format($loan->total_repayment, 2) }}</td>
                    <td>
                        @if($loan->status == 'active')
                            <span class="badge badge-success">{{ $loan->status }}</span>
                        @else
                            <span class="badge badge-primary">{{ $loan->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="{{ route('cash_advances.ledger', $loan->id) }}" class="dropdown-item">
                                        <i class="fas fa-book"></i>&nbsp;Ledger
                                    </a>
                                    @if($loan->remainingBalance() == 0)
                                        <a href="{{ route('cash_advances.edit', $loan->id) }}" class="dropdown-item">
                                            <i class="fas fa-edit"></i>&nbsp;Update Status
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@include('cash_advances.generate_payments')
@endsection

@section('css')
<style>
    .contribution-nav {
        display: flex;
        gap: 15px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .contribution-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }
    .contribution-link:hover {
        background-color: #e9ecef;
        text-decoration: none;
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .contribution-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .contribution-link .icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(0,0,0,0.1);
        margin-right: 10px;
    }
    .contribution-link.active .icon-wrapper {
        background-color: rgba(255,255,255,0.2);
    }
    .contribution-link .icon-wrapper i {
        font-size: 1.2rem;
    }
    .contribution-link .text-wrapper {
        display: flex;
        flex-direction: column;
    }
    .contribution-link .title {
        font-weight: bold;
        font-size: 1rem;
    }
    .contribution-link .description {
        font-size: 0.75rem;
        opacity: 0.8;
    }
    .contribution-link.active .description {
        opacity: 0.9;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Select2 for all select elements
        $('select').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Initialize DataTable
        var table = $('#cash_advances').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[1, "desc"]],
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });

        // Export to Excel functionality
        $('#export-excel').on('click', function() {
            var data = table.rows().data().toArray();
            var header = ['Employee Name', 'Loan Amount', 'Repayment Term', 'Monthly Amortization', 'Total Repayment', 'Status'];

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([header].concat(data.map(row => [
                row[0], // Employee Name
                parseFloat(row[1].replace(/[₱,]/g, '')).toFixed(2), // Loan Amount
                row[2], // Repayment Term
                parseFloat(row[3].replace(/[₱,]/g, '')).toFixed(2), // Monthly Amortization
                parseFloat(row[4].replace(/[₱,]/g, '')).toFixed(2), // Total Repayment
                $(row[5]).text() // Status (extract text from HTML)
            ])));

            // Set column widths
            ws['!cols'] = [
                {wch: 30}, // Employee Name
                {wch: 15}, // Loan Amount
                {wch: 15}, // Repayment Term
                {wch: 20}, // Monthly Amortization
                {wch: 18}, // Total Repayment
                {wch: 10}  // Status
            ];

            // Style the header row
            var headerStyle = {
                font: { bold: true, color: { rgb: "FFFFFF" } },
                fill: { fgColor: { rgb: "4472C4" } },
                alignment: { horizontal: "center", vertical: "center" },
                border: {
                    top: {style: "thin", color: {auto: 1}},
                    bottom: {style: "thin", color: {auto: 1}},
                    left: {style: "thin", color: {auto: 1}},
                    right: {style: "thin", color: {auto: 1}}
                }
            };
            for (var i = 0; i < header.length; i++) {
                var cellRef = XLSX.utils.encode_cell({r: 0, c: i});
                ws[cellRef].s = headerStyle;
            }

            // Style the data cells
            var dataStyle = {
                alignment: { horizontal: "right", vertical: "center" },
                border: {
                    top: {style: "thin", color: {auto: 1}},
                    bottom: {style: "thin", color: {auto: 1}},
                    left: {style: "thin", color: {auto: 1}},
                    right: {style: "thin", color: {auto: 1}}
                }
            };
            var currencyStyle = Object.assign({}, dataStyle, { numFmt: '"₱"#,##0.00' });
            var monthStyle = Object.assign({}, dataStyle, {
                alignment: { horizontal: "center" }
            });

            var range = XLSX.utils.decode_range(ws['!ref']);
            for (var R = range.s.r; R <= range.e.r; ++R) {
                for (var C = range.s.c; C <= range.e.c; ++C) {
                    var cellRef = XLSX.utils.encode_cell({r: R, c: C});
                    if (!ws[cellRef]) continue;
                    if (!ws[cellRef].s) ws[cellRef].s = {};
                    if (R === 0) {
                        ws[cellRef].s = headerStyle;
                    } else {
                        if (C === 0) {
                            ws[cellRef].s = Object.assign({}, dataStyle, { alignment: { horizontal: "left" } });
                        } else if (C === 2) {
                            ws[cellRef].s = monthStyle;
                        } else if (C === 1 || C === 3 || C === 4) {
                            ws[cellRef].s = currencyStyle;
                        } else {
                            ws[cellRef].s = dataStyle;
                        }
                    }
                }
            }

            XLSX.utils.book_append_sheet(wb, ws, 'Cash Advances');
            XLSX.writeFile(wb, 'cash_advances.xlsx');
        });

        // // Handle form submission for generate payments
        // $('form[action="{{ route('cash_advances.generate_payments') }}"]').on('submit', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         type: 'POST',
        //         data: $(this).serialize(),
        //         success: function(response) {
        //             if (response.success) {
        //                 alert('Payments generated successfully!');
        //                 location.reload();
        //             } else {
        //                 alert('Error generating payments: ' + response.message);
        //             }
        //         },
        //         error: function() {
        //             alert('An error occurred while generating payments.');
        //         }
        //     });
        // });
    });
</script>
@endsection
