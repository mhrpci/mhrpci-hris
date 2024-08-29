@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Contributions for {{ $employee->company_id }}</h1>

    <form action="{{ route('employee.contributions', $employee->id) }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-3">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4 col-lg-3 mb-3">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 col-lg-3 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="mb-0">Contribution Records</h2>
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
                    <tbody>
                        @foreach($contributions as $contribution)
                            <tr>
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
        color: #fff;
        background-color: #343a40;
        border-color: #454d55;
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
