@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Contributions for {{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name?? ' ' }} {{ $employee->suffix ?? ' ' }}</h1>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <!-- Print Button -->
            <button id="printButton" class="btn btn-info btn-sm ml-2">
                <i class="fas fa-print"></i> Print
            </button>
            <!-- Month Filter -->
            <div class="dropdown ml-auto">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="monthFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter by Month
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="monthFilterDropdown">
                    <a class="dropdown-item" href="#" data-month="">All Months</a>
                    @foreach(range(1, 12) as $month)
                        <a class="dropdown-item" href="#" data-month="{{ $month }}">
                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <!-- Info Boxes -->
                <div class="col">
                    <div class="info-box bg-primary">
                        <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total SSS</span>
                            <span class="info-box-number">{{ number_format($totals['sss'], 2) }}</span>
                        </div>
                        <div class="info-box-overlay">
                            <img src="{{ asset('vendor/adminlte/dist/img/sss.png') }}" alt="SSS Logo">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-heartbeat"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total PhilHealth</span>
                            <span class="info-box-number">{{ number_format($totals['philhealth'], 2) }}</span>
                        </div>
                        <div class="info-box-overlay">
                            <img src="{{ asset('vendor/adminlte/dist/img/philhealth.png') }}" alt="PhilHealth Logo">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-home"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pag-IBIG</span>
                            <span class="info-box-number">{{ number_format($totals['pagibig'], 2) }}</span>
                        </div>
                        <div class="info-box-overlay">
                            <img src="{{ asset('vendor/adminlte/dist/img/pagibig.png') }}" alt="Pag-IBIG Logo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>SSS</th>
                            <th>PhilHealth</th>
                            <th>Pag-IBIG</th>
                        </tr>
                    </thead>
                    <tbody id="contributionTableBody">
                        @php
                            $allDates = $ssscontributions->pluck('date')
                                ->concat($philhealthcontributions->pluck('date'))
                                ->concat($pagibigcontributions->pluck('date'))
                                ->unique()
                                ->sort()
                                ->reverse();
                        @endphp
                        @forelse($allDates as $date)
                            <tr data-date="{{ $date }}">
                                <td>{{ $date }}</td>
                                <td>{{ number_format($ssscontributions->where('date', $date)->first()->sss_contribution ?? 0, 2) }}</td>
                                <td>{{ number_format($philhealthcontributions->where('date', $date)->first()->philhealth_contribution ?? 0, 2) }}</td>
                                <td>{{ number_format($pagibigcontributions->where('date', $date)->first()->pagibig_contribution ?? 0, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="no-data-message" class="text-center" style="display: none;">No data available for the selected month.</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });

        const monthFilterLinks = document.querySelectorAll('.dropdown-menu .dropdown-item[data-month]');
        monthFilterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const month = this.getAttribute('data-month');
                filterByMonth(month);
            });
        });

        function filterByMonth(month) {
            const rows = document.querySelectorAll('#contributionTableBody tr');
            rows.forEach(row => {
                const date = new Date(row.getAttribute('data-date'));
                const rowMonth = date.getMonth() + 1; // Months are zero-indexed
                if (month === "" || rowMonth == month) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            checkNoData();
        }

        function checkNoData() {
            const rows = document.querySelectorAll('#contributionTableBody tr');
            const noDataMessage = document.getElementById('no-data-message');
            const hasData = Array.from(rows).some(row => row.style.display !== 'none');
            noDataMessage.style.display = hasData ? 'none' : 'block';
        }
    });
</script>
@endpush
