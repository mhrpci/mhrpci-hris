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
                <span class="title">SSS Loan</span>
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
        <a href="{{ route('loans.employees-list') }}" class="contribution-link {{ request()->routeIs('loans.employees-list') ? 'active' : '' }}">
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
        <h3 class="card-title">PAGIBIG Loan List</h3>
        <div class="card-tools">
            <!-- Mobile buttons -->
            <div class="btn-group-vertical btn-group-sm d-md-none">
                <button type="button" class="btn btn-success rounded-pill mb-2" data-toggle="modal" data-target="#loanModal">
                    <i class="fas fa-plus"></i> Apply for PAGIBIG Loan
                </button>
                <button id="export-excel" class="btn btn-primary rounded-pill mb-2">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </button>
                <form action="{{ route('loan_pagibig.generate_payments') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info rounded-pill w-100">
                        <i class="fas fa-money-bill-wave"></i> Generate Payments
                    </button>
                </form>
            </div>
            <!-- Desktop buttons -->
            <div class="btn-group btn-group-sm d-none d-md-inline-flex">
                <button type="button" class="btn btn-success btn-sm rounded-pill" data-toggle="modal" data-target="#loanModal">
                    Apply for PAGIBIG Loan
                </button>
                <button id="export-excel" class="btn btn-primary btn-sm rounded-pill mr-2">
                    Export to Excel <i class="fas fa-file-excel"></i>
                </button>
                <form action="{{ route('loan_pagibig.generate_payments') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-info btn-sm rounded-pill">
                        Generate Payments <i class="fas fa-money-bill-wave"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="loan_pagibig" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Pagibig No.</th>
                    <th>Employee Name</th>
                    <th>Loan Amount</th>
                    <th>Loan Term</th>
                    <th>Monthly Amortization</th>
                    <th>Interest Rate</th>
                    <th>Loan Type</th>
                    <th>Status</th>
                    <th>Remaining Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $loan->employee->pagibig_no }}</td>
                        <td>{{ $loan->employee->last_name }} {{ $loan->employee->first_name }}, {{ $loan->employee->middle_name ?? ' ' }} {{ $loan->employee->suffix ?? ' ' }}</td>
                        <td>₱{{ number_format($loan->loan_amount, 2) }}</td>
                        <td>{{ $loan->loan_term_months }} {{ $loan->loan_term_months <= 1 ? 'Month' : 'Months' }}</td>
                        <td>₱{{ number_format($loan->monthly_amortization, 2) }}</td>
                        <td>{{ $loan->interest_rate }}%</td>
                        <td>{{ $loan->loan_type->value }}</td>
                        <td>
                            @if($loan->status == 'active')
                                <span class="badge badge-success">{{ $loan->status }}</span>
                            @else
                                <span class="badge badge-primary">{{ $loan->status }}</span>
                            @endif
                        </td>
                        <td>₱{{ number_format($loan->calculateRemainingBalance(), 2) }}</td>
                        <td>
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('loan_pagibig.ledger', $loan->id) }}" class="dropdown-item">
                                            <i class="fas fa-book"></i>&nbsp;Ledger
                                        </a>
                                        @if($loan->calculateRemainingBalance() == 0)
                                        <a href="{{ route('loan_pagibig.edit', $loan->id) }}" class="dropdown-item">
                                            <i class="fas fa-edit"></i>&nbsp;Update Status
                                        </a>
                                        @endif
                                        @can('super-admin')
                                        <form action="{{ route('loan_pagibig.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this loan?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-trash"></i>&nbsp;Delete
                                            </button>
                                        </form>
                                        @endcan
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
</div>

@include('loan_pagibig.create')
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

    /* Mobile styles */
    @media (max-width: 768px) {
        .contribution-link {
            flex: 1 1 100%; /* Full width on mobile */
            margin-bottom: 10px;
        }

        .card-tools {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            margin-top: 15px;
        }

        .card-tools .btn {
            width: 100%;
            margin: 0 !important;
        }

        .card-header {
            flex-direction: column;
        }

        .card-title {
            margin-bottom: 15px;
            text-align: center;
        }

        /* Make table scrollable horizontally */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Adjust table for mobile */
        #loan_pagibig {
            font-size: 14px;
        }

        #loan_pagibig th,
        #loan_pagibig td {
            white-space: nowrap;
            min-width: 100px;
        }

        /* Stack form elements */
        form[style*="display: inline"] {
            display: block !important;
            width: 100%;
        }
    }

    /* Tablet styles */
    @media (min-width: 769px) and (max-width: 1024px) {
        .contribution-link {
            flex: 1 1 calc(50% - 15px); /* 2 items per row on tablet */
        }
    }

    /* Additional responsive improvements */
    .dropdown-menu {
        min-width: 200px;
    }

    .alert {
        margin: 10px;
        border-radius: 8px;
    }

    /* Improve table responsiveness */
    .table-responsive {
        margin: 0;
        padding: 0;
        border: none;
    }

    /* Improve button spacing */
    .btn {
        margin: 2px;
        white-space: nowrap;
    }

    /* Improve modal responsiveness */
    .modal-dialog {
        margin: 10px;
        max-width: 98%;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }
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

        var table = $('#loan_pagibig').DataTable({
            responsive: true, // Enable responsive features
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[1, "desc"]],
            language: {
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
            },
            // Add responsive breakpoints
            responsive: {
                breakpoints: [
                    {name: 'desktop', width: Infinity},
                    {name: 'tablet', width: 1024},
                    {name: 'phone', width: 768}
                ]
            },
            // Customize column visibility for different screen sizes
            columnDefs: [
                {
                    targets: [3, 4, 5, 6], // Hide these columns on mobile
                    className: 'd-none d-md-table-cell'
                }
            ]
        });

        $('#export-excel').on('click', function() {
            var data = table.rows().data().toArray();
            var header = ['Pagibig No.', 'Employee Name', 'Loan Amount', 'Loan Term', 'Monthly Amortization', 'Interest Rate', 'Loan Type', 'Status', 'Remaining Balance'];

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([header].concat(data.map(row => [
                row[0], // Pagibig No.
                row[1], // Employee Name
                parseFloat(row[2].replace(/[₱,]/g, '')).toFixed(2), // Loan Amount
                row[3], // Loan Term
                parseFloat(row[4].replace(/[₱,]/g, '')).toFixed(2), // Monthly Amortization
                row[5], // Interest Rate
                row[6], // Loan Type
                row[7], // Status
                parseFloat(row[8].replace(/[₱,]/g, '')).toFixed(2) // Remaining Balance
            ])));

            // Set column widths
            ws['!cols'] = [
                {wch: 15}, // Pagibig No.
                {wch: 30}, // Employee Name
                {wch: 15}, // Loan Amount
                {wch: 15}, // Loan Term
                {wch: 20}, // Monthly Amortization
                {wch: 15}, // Interest Rate
                {wch: 15}, // Loan Type
                {wch: 15}, // Status
                {wch: 20}  // Remaining Balance
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
                        if (C === 3) {
                            ws[cellRef].s = monthStyle;
                        } else if (C === 2 || C === 4) {
                            ws[cellRef].s = currencyStyle;
                        } else {
                            ws[cellRef].s = dataStyle;
                        }
                    }
                }
            }

            XLSX.utils.book_append_sheet(wb, ws, 'PAGIBIG Loans');
            XLSX.writeFile(wb, 'pagibig_loans.xlsx');
        });

        // Remove the AJAX call for generate payments
        // The form submission will handle this now
    });
</script>
@endsection
