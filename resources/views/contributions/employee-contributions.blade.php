@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@stop

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Contributions for {{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name?? ' ' }} {{ $employee->suffix ?? ' ' }}</h1>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <a href="{{ route('contributions.employees-list') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
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
                <div class="col-sm-6 col-lg-3 mb-4">
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
                <div class="col-sm-6 col-lg-3 mb-4">
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
                <div class="col-sm-6 col-lg-3 mb-4">
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
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total TIN</span>
                            <span class="info-box-number">{{ number_format($totals['tin'], 2) }}</span>
                        </div>
                        <div class="info-box-overlay">
                            <img src="{{ asset('vendor/adminlte/dist/img/tin.png') }}" alt="TIN Logo">
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
                            <th>TIN</th>
                        </tr>
                    </thead>
                    <tbody id="contributionTableBody">
                        @forelse($contributions as $contribution)
                        <tr data-date="{{ $contribution->date }}">
                            <td>{{ $contribution->date }}</td>
                            <td>{{ number_format($contribution->sss_contribution, 2) }}</td>
                            <td>{{ number_format($contribution->philhealth_contribution, 2) }}</td>
                            <td>{{ number_format($contribution->pagibig_contribution, 2) }}</td>
                            <td>{{ number_format($contribution->tin_contribution, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Data Available</td>
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

@push('css')
<style>
    .container-fluid {
        padding: 20px;
    }

    .info-box {
    position: relative;
    overflow: hidden;
    height: 120px;
    border-radius: .25rem;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 1rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    background-color: #f4f6f9;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.info-box-icon {
    font-size: 2.5rem;
    color: #fff;
    margin-right: 1rem;
}

.info-box-content {
    position: relative; /* Added to ensure content overlays on top of the background */
    z-index: 1; /* Ensure content is above the overlay */
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.info-box-text {
    font-size: 1rem;
    font-weight: bold;
}

.info-box-number {
    font-size: 1.5rem;
    font-weight: bold;
}

.info-box-overlay {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100px; /* Adjusted size for better visibility */
    height: auto; /* Auto height to maintain aspect ratio */
    opacity: 0.15; /* Slightly increased opacity for subtle effect */
    z-index: 0; /* Positioned behind the content */
}

.info-box-overlay img {
    width: 100%; /* Ensure the image takes the full width of the container */
    height: auto; /* Maintain aspect ratio */
}

</style>
@endpush

@push('js')
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
