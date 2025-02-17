@extends('layouts.app')

@section('styles')
<style>
    .coming-soon-container {
        min-height: calc(100vh - 300px);
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }
    .coming-soon-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .coming-soon-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    .clock-icon {
        color: #007bff;
        animation: float 3s ease-in-out infinite;
        margin-bottom: 2rem;
        filter: drop-shadow(0 5px 15px rgba(0, 123, 255, 0.2));
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .coming-soon-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
    }
    .lead-text {
        font-size: 1.25rem;
        color: #34495e;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    .info-text {
        color: #7f8c8d;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    .back-button {
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        background: linear-gradient(145deg, #007bff, #0056b3);
        border: none;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }
    .back-button:hover {
        transform: translateX(-5px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        background: linear-gradient(145deg, #0056b3, #004085);
    }
    .back-button i {
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }
    .back-button:hover i {
        transform: translateX(-3px);
    }
    @media (max-width: 768px) {
        .coming-soon-title {
            font-size: 2rem;
        }
        .lead-text {
            font-size: 1.1rem;
        }
        .info-text {
            font-size: 1rem;
        }
        .clock-icon {
            font-size: 3em !important;
        }
    }
</style>
@endsection

@section('content')
<div class="coming-soon-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card coming-soon-card">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-clock fa-5x clock-icon"></i>
                        <h1 class="coming-soon-title">Coming Soon!</h1>
                        <p class="lead-text">
                            Clock In and Clock Out features are currently under development.
                        </p>
                        <p class="info-text">
                            We're working hard to bring you an efficient attendance management system.
                            Please check back later!
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-primary back-button">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection