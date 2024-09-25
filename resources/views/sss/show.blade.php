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
        background-color: #8e44ad;
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
<br>
    <div class="card shadow-sm border-0" style="overflow: hidden;">
        <div class="card-header">
            <h3 class="card-title">SSS Contribution Information</h3>
        </div>
        <div class="card-body" style="background-image: url('{{ asset('vendor/adminlte/dist/img/sss.png') }}'); background-size: 25%; background-position: right; background-repeat: no-repeat;">
            <div class="overlay-content bg-white p-4 rounded" style="opacity: 0.9;">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Employee Name</th>
                                <td>{{ $sss->employee->company_id }} {{ $sss->employee->last_name }} {{ $sss->employee->first_name }}, {{ $sss->employee->middle_name ?? ' ' }} {{ $sss->employee->suffix ?? ' ' }}</td>
                            </tr>
                            <tr>
                                <th>Contribution Date</th>
                                <td>{{ $sss->contribution_date->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Monthly Salary Credit</th>
                                <td>{{ number_format($sss->monthly_salary_credit, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Employee Contribution</th>
                                <td>{{ number_format($sss->employee_contribution, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Employer Contribution</th>
                                <td>{{ number_format($sss->employer_contribution, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Total Contribution</th>
                                <td>{{ number_format($sss->total_contribution, 2) }}</td>
                            </tr>
                            <tr>
                                <th>EC Contribution</th>
                                <td>{{ number_format($sss->ec_contribution, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('sss.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>
    </div>

<style>
    .card {
        border-radius: 8px;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 0.9rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-body {
            background-size: 35%;
            margin-right: 0;
            padding: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        font-size: 0.9rem;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@endsection
