@extends('layouts.app')

@section('content')
<br>
<!-- Enhanced professional-looking link buttons -->
<div class="mb-4">
    <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
        <a href="{{ route('sss.index') }}" class="contribution-link {{ request()->routeIs('sss.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">SSS</span>
                <small class="description">Social Security System</small>
            </div>
        </a>
        <a href="{{ route('pagibig.index') }}" class="contribution-link {{ request()->routeIs('pagibig.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-home"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Pag-IBIG</span>
                <small class="description">Home Development Mutual Fund</small>
            </div>
        </a>
        <a href="{{ route('philhealth.index') }}" class="contribution-link {{ request()->routeIs('philhealth.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">PhilHealth</span>
                <small class="description">Philippine Health Insurance</small>
            </div>
        </a>
        <a href="{{ route('contributions.employees-list') }}" class="contribution-link {{ request()->routeIs('contributions.employees-list') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-users"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Contributor</span>
                <small class="description">Employee Contributor List</small>
            </div>
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Sss Contributions List</h3>
        <div class="card-tools">
            <a href="{{ route('sss.create') }}" class="btn btn-success btn-sm rounded-pill">
                Add Sss Contribution <i class="fas fa-plus-circle"></i>
            </a>
            <button id="export-excel" class="btn btn-primary btn-sm rounded-pill mr-2">
                Export to Excel <i class="fas fa-file-excel"></i>
            </button>
            <!-- Add the new button here -->
            <button type="button" class="btn btn-info btn-sm rounded-pill" data-toggle="modal" data-target="#createAllModal">
                Create for All Active ({{ $activeEmployeesCount }}) <i class="fas fa-users"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">{{ $message }}</div>
        @endif
        <div class="table-responsive">
            <table id="sss-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>SSS NO.</th>
                    <th>Employee</th>
                    <th>Contribution Date</th>
                    <th>Employee Share</th>
                    <th>Employer Share</th>
                    <th>Total Contribution</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contributions as $contribution)
                    <tr>
                        <td>{{ $contribution->employee->sss_no}}</td>
                        <td>{{ $contribution->employee->last_name }} {{ $contribution->employee->first_name }}, {{ $contribution->employee->middle_name ?? ' ' }} {{ $contribution->employee->suffix ?? ' ' }}</td>
                        <td>{{ $contribution->contribution_date->format('F Y') }}</td>
                        <td>{{ number_format($contribution->employee_contribution, 2) }}</td>
                        <td>{{ number_format($contribution->employer_contribution, 2) }}</td>
                        <td>{{ number_format($contribution->total_contribution, 2) }}</td>
                        <td>
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('sss.show', $contribution) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                        @if(auth()->user()->hasRole('Super Admin'))
                                            <form action="{{ route('sss.destroy', $contribution->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this sss?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                            </form>
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

<!-- Modal -->
<div class="modal fade" id="createAllModal" tabindex="-1" role="dialog" aria-labelledby="createAllModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAllModalLabel">Create Contributions for All Active Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sss.store-all-active') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="contribution_date">Contribution Date</label>
                        <input type="month" class="form-control" id="contribution_date" name="contribution_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Contributions</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
<style>
    .contribution-nav {
        display: flex;
        gap: 15px;
        justify-content: flex-start;
        flex-wrap: wrap;
        padding: 10px;
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
        /* Make links more flexible */
        flex: 1 1 calc(50% - 15px);
        min-width: 250px;
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

    /* Add responsive card styles */
    .card {
        margin: 10px;
    }

    .card-header {
        padding: 15px;
    }

    .card-tools {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    /* Responsive table container */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Mobile-specific styles */
    @media (max-width: 768px) {
        .contribution-link {
            flex: 1 1 100%;
        }

        .card-header {
            flex-direction: column;
        }

        .card-title {
            margin-bottom: 15px;
            text-align: center;
        }

        .card-tools {
            justify-content: center;
            width: 100%;
        }

        .btn {
            width: 100%;
            margin: 5px 0;
        }

        /* Adjust table for mobile */
        .table th, .table td {
            white-space: nowrap;
            min-width: 100px;
        }

        .table td:last-child {
            min-width: 80px;
        }

        /* Modal adjustments for mobile */
        .modal-dialog {
            margin: 10px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

@section('js')
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#sss-table').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[1, "desc"]]
        });

        $('#export-excel').on('click', function() {
            var data = table.rows().data().toArray();
            var header = ['SSS NO.', 'Employee', 'Contribution Month', 'Employee Share', 'Employer Share', 'Total Contribution'];

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([header].concat(data.map(row => [
                row[0], // SSS NO.
                row[1], // Employee
                new Date(row[2]).toLocaleString('default', { month: 'long' }), // Contribution Month
                parseFloat(row[3].replace(/,/g, '')).toFixed(2), // Employee Share
                parseFloat(row[4].replace(/,/g, '')).toFixed(2), // Employer Share
                parseFloat(row[5].replace(/,/g, '')).toFixed(2)  // Total Contribution
            ])));

            // Set column widths
            ws['!cols'] = [
                {wch: 15}, // SSS NO.
                {wch: 30}, // Employee
                {wch: 20}, // Contribution Month
                {wch: 15}, // Employee Share
                {wch: 15}, // Employer Share
                {wch: 18}  // Total Contribution
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
            var currencyStyle = Object.assign({}, dataStyle, { numFmt: "#,##0.00" });
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
                        ws[cellRef].s = C === 2 ? monthStyle : currencyStyle;
                    }
                }
            }

            XLSX.utils.book_append_sheet(wb, ws, 'SSS Contributions');
            XLSX.writeFile(wb, 'sss_contributions.xlsx');
        });

        // Add this to ensure the modal works correctly
        $('#createAllModal').on('shown.bs.modal', function () {
            $('#contribution_date').trigger('focus')
        })
    });
</script>
@endsection

