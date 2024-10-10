@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-center mb-4" style="font-family: 'Pacifico', cursive; font-weight: bold;">Employee Birthdays</h1>

    <!-- Back to Employee Index Button -->
    <div class="text-center mb-4">
        <a href="{{ route('employees.index') }}" class="btn btn-primary rounded-pill">
            <i class="fas fa-list"></i> Back to List
        </a>
    </div>

    <div class="row flowchart">
        @foreach ($months as $month)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="month-box">
                    <h2 class="month-title">{{ $month }}</h2>
                    @if (isset($birthdays[$month]) && count($birthdays[$month]) > 0)
                        <ul class="employee-list">
                            @foreach ($birthdays[$month] as $employee)
                                <li><i class="fas fa-birthday-cake mr-2"></i>{{ $employee['date'] }} - {{ $employee['name'] }}</li>
                            @endforeach
                        </ul>
                    @else
                        <h5>No birthdays</h5>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    body {
        background-color: #f0f8ff;
    }

    .flowchart {
        margin-top: 20px;
    }

    .month-box {
        background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        position: relative;
        z-index: 2;
        height: 100%;
        overflow: hidden;
    }

    .month-box:hover {
        transform: translateY(-5px) rotate(2deg);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .month-title {
        text-align: center;
        font-size: 2rem;
        color: #ffffff;
        margin-bottom: 15px;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .employee-list {
        list-style-type: none;
        padding: 0;
        text-align: left;
    }

    .employee-list li {
        margin: 10px 0;
        font-size: 1.1rem;
        color: #333;
        background-color: rgba(255, 255, 255, 0.7);
        padding: 8px 12px;
        border-radius: 20px;
        transition: all 0.2s;
    }

    .employee-list li:hover {
        background-color: rgba(255, 255, 255, 0.9);
        transform: translateX(5px);
    }

    .month-box:nth-child(3n+1) {
        background: linear-gradient(135deg, #fccb90 0%, #d57eeb 100%);
    }

    .month-box:nth-child(3n+2) {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
    }

    .month-box:nth-child(3n) {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    }

    h5 {
        text-align: center;
        font-style: italic;
        color: #555;
    }

    .month-box::before {
        content: '🎈';
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        opacity: 0.5;
    }

    .month-box::after {
        content: '🎁';
        position: absolute;
        bottom: 10px;
        left: 10px;
        font-size: 24px;
        opacity: 0.5;
    }

    @media (max-width: 767px) {
        .month-box {
            margin-bottom: 20px;
        }
    }
</style>
@endsection
