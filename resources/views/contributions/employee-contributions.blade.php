@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
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

    /* Wave Loader */
    .wave-loader {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        height: 50px;
    }

    .wave-loader > div {
        width: 10px;
        height: 50px;
        margin: 0 5px;
        background-color: #8e44ad; /* Purple color */
        animation: wave 1s ease-in-out infinite;
    }

    .wave-loader > div:nth-child(2) {
        animation-delay: -0.9s;
    }

    .wave-loader > div:nth-child(3) {
        animation-delay: -0.8s;
    }

    .wave-loader > div:nth-child(4) {
        animation-delay: -0.7s;
    }

    .wave-loader > div:nth-child(5) {
        animation-delay: -0.6s;
    }

    @keyframes wave {
        0%, 100% {
            transform: scaleY(0.5);
        }
        50% {
            transform: scaleY(1);
        }
    }
</style>
@stop

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Contributions for {{ $employee->company_id }} {{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name?? ' ' }} {{ $employee->suffix ?? ' ' }}</h1>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
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
                        @foreach($contributions as $contribution)
                            <tr data-date="{{ $contribution->date }}">
                                <td>{{ $contribution->date }}</td>
                                <td>{{ number_format($contribution->sss_contribution, 2) }}</td>
                                <td>{{ number_format($contribution->philhealth_contribution, 2) }}</td>
                                <td>{{ number_format($contribution->pagibig_contribution, 2) }}</td>
                                <td>{{ number_format($contribution->tin_contribution, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        bottom: 5px;
        right: 5px;
        width: 50px;
        height: 50px;
        opacity: 0.2;
        pointer-events: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .info-box-overlay img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .table-responsive {
        margin-top: 1rem;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    /* Loader Override */
    .loader {
        display: none;
    }

    /* Dropdown Styles */
    .dropdown-menu-right {
        right: 0;
        left: auto;
    }

    .dropdown-toggle {
        font-size: 0.8rem; /* Smaller button */
        padding: 0.5rem 0.75rem; /* Adjust padding */
    }

    .dropdown-item {
        font-size: 0.8rem; /* Smaller text */
    }

    @media (min-width: 992px) {
        .info-box {
            height: 140px;
        }

        .info-box-icon {
            font-size: 3rem;
        }

        .info-box-text {
            font-size: 1.1rem;
        }

        .info-box-number {
            font-size: 1.8rem;
        }

        .info-box-overlay {
            width: 70px;
            height: 70px;
        }
    }

    @media (max-width: 767px) {
        .container-fluid {
            padding: 10px;
        }

        .info-box {
            height: 100px;
        }

        .info-box-icon {
            font-size: 2rem;
        }

        .info-box-text {
            font-size: 0.9rem;
        }

        .info-box-number {
            font-size: 1.3rem;
        }

        .info-box-overlay {
            width: 40px;
            height: 40px;
        }
    }
</style>
@endpush

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthFilterItems = document.querySelectorAll('.dropdown-item');
        const tableBody = document.getElementById('contributionTableBody');

        monthFilterItems.forEach(item => {
            item.addEventListener('click', function () {
                const selectedMonth = this.dataset.month;

                monthFilterItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                Array.from(tableBody.querySelectorAll('tr')).forEach(row => {
                    const date = new Date(row.dataset.date);
                    const rowMonth = date.getMonth() + 1;

                    if (selectedMonth === '' || rowMonth === parseInt(selectedMonth)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
