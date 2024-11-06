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
        <h3 class="card-title">Philhealth Contributions List</h3>
        <div class="card-tools">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('philhealth.create') }}" class="btn btn-success btn-sm rounded-pill">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Contribution</span>
                </a>
                <button id="export-excel" class="btn btn-primary btn-sm rounded-pill">
                    <i class="fas fa-file-excel"></i>
                    <span>Export to Excel</span>
                </button>
                <button type="button" class="btn btn-info btn-sm rounded-pill" data-toggle="modal" data-target="#createAllModal">
                    <i class="fas fa-users"></i>
                    <span>Create for All Active ({{ $activeEmployeesCount }})</span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive">
            <table id="philhealth-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>PHILHEALTH NO.</th>
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
                        <td>{{ $contribution->employee->philhealth_no}}</td>
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
                                        <a class="dropdown-item" href="{{ route('philhealth.show', $contribution) }}"><i class="fas fa-eye"></i>&nbsp;Preview</a>
                                        @if(auth()->user()->hasRole('Super Admin'))
                                            <form action="{{ route('philhealth.destroy', $contribution->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this philhealth?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
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
            <form action="{{ route('philhealth.store-all-active') }}" method="POST">
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
        flex: 1 1 auto;
        min-width: 250px;
        max-width: 300px;
        display: flex;
        align-items: center;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Mobile styles */
    @media (max-width: 768px) {
        .contribution-link {
            min-width: 100%;
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
            margin: 5px 0;
        }

        .card-header {
            flex-direction: column;
        }

        .card-title {
            margin-bottom: 15px;
            text-align: center;
        }
    }

    /* Table responsive styles */
    @media (max-width: 992px) {
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #philhealth-table th,
        #philhealth-table td {
            white-space: nowrap;
            min-width: 120px;
        }

        #philhealth-table td:last-child {
            min-width: 100px;
        }
    }

    /* Enhanced card styles */
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
        border-radius: 15px;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 15px 15px 0 0 !important;
    }

    .card-body {
        padding: 20px;
    }

    /* Enhanced table styles */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    /* Enhanced button styles */
    .btn {
        font-weight: 500;
        padding: 8px 16px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn i {
        font-size: 0.9rem;
    }

    /* Modal enhancements */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0,0,0,0.1);
    }

    .modal-header {
        border-radius: 15px 15px 0 0;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    /* Form control enhancements */
    .form-control {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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
        var table = $('#philhealth-table').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[1, "desc"]]
        });

        $('#export-excel').on('click', function() {
            var data = table.rows().data().toArray();
            var header = ['philhealth NO.', 'Employee', 'Contribution Month', 'Employee Share', 'Employer Share', 'Total Contribution'];

            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([header].concat(data.map(row => [
                row[0], // philhealth NO.
                row[1], // Employee
                new Date(row[2]).toLocaleString('default', { month: 'long' }), // Contribution Month
                parseFloat(row[3].replace(/,/g, '')).toFixed(2), // Employee Share
                parseFloat(row[4].replace(/,/g, '')).toFixed(2), // Employer Share
                parseFloat(row[5].replace(/,/g, '')).toFixed(2)  // Total Contribution
            ])));

            // Set column widths
            ws['!cols'] = [
                {wch: 15}, // philhealth NO.
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

            XLSX.utils.book_append_sheet(wb, ws, 'philhealth Contributions');
            XLSX.writeFile(wb, 'philhealth_contributions.xlsx');
        });
    });
</script>
@endsection
