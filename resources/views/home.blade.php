@extends('layouts.app')

@section('content')
<style>
    .welcome-container {
        display: flex;
        justify-content: space-between;
    }

    .clock-container {
        text-align: right;
    }

    .calendar {
          max-width: 90%;
          margin: 0 auto;
          text-align: center;
          margin-top: 20px; /* Adjust as needed */
        }

        .header {
          display: flex;
          align-items: center;
          justify-content: space-between;
        }

        .days {
          display: grid;
          grid-template-columns: repeat(7, 1fr);
          gap: 5px;
        }

        .day {
          padding: 10px;
          border: 1px solid #ddd;
        }

        .event {
          background-color: lightblue;
        }

        .animated-greeting {
            animation: fadeIn 2s ease-in-out;
            color: #ff6347; /* Tomato color */
        }

        .birthday-heading {
            animation: bounceIn 1s ease-in-out;
            color: #ff4500; /* OrangeRed color */
        }

        .birthday-list {
            list-style-type: none;
            padding: 0;
        }

        .birthday-item {
            animation: slideIn 0.5s ease-in-out;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;

            /* Light mode defaults */
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            color: #2d3748;
        }

        .birthday-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .birthday-item-content {
            flex: 1;
        }

        .birthday-item-date {
            font-weight: 500;
            margin-left: 1rem;
            color: #718096; /* Subtle text color for dates */
        }

        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            .birthday-item {
                background-color: #2d3748;
                border-color: #4a5568;
                color: #e2e8f0;
            }

            .birthday-item:hover {
                background-color: #353f4f;
                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            }

            .birthday-item-date {
                color: #a0aec0; /* Lighter color for dates in dark mode */
            }
        }

        /* Animation for new items */
        .birthday-item {
            animation: slideIn 0.5s ease-in-out;
            animation-fill-mode: both;
        }

        .birthday-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .birthday-item:nth-child(3) {
            animation-delay: 0.2s;
        }

        /* Accessibility - disable animations if user prefers reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .birthday-item {
                animation: none;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .birthday-item {
                padding: 0.75rem;
                font-size: 0.95rem;
            }

            .birthday-item-date {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .birthday-item {
                padding: 0.5rem;
                font-size: 0.9rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .birthday-item-date {
                margin-left: 0;
                margin-top: 0.25rem;
                font-size: 0.8rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .welcome-heading {
                font-size: 28px;
            }
            .welcome-subheading {
                font-size: 24px;
            }
            .clock-container {
                text-align: center;
                margin-top: 20px;
            }
        }

        /* Enhanced card styles */
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        /* Improved list styles */
        .custom-list {
            list-style-type: none;
            padding-left: 0;
        }
        .custom-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .custom-list li:last-child {
            border-bottom: none;
        }

        /* Enhanced icons */
        .card-icon {
            font-size: 2.5rem;
            margin-right: 15px;
        }

    /* Add responsive styles for smaller screens */
    @media (max-width: 576px) {
        .card-icon {
            font-size: 2rem;
        }
        .card-title {
            font-size: 0.9rem;
        }
        .card-text {
            font-size: 1.5rem;
        }
    }

    /* Professional enhancements */
    body {
        background-color: #f8f9fa;
    }

    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        background-color: #ffffff;
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-icon {
        font-size: 2rem;
        margin-right: 1rem;
        opacity: 0.8;
    }

    .welcome-message {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
    }

    .welcome-heading {
        font-weight: 600;
    }

    .welcome-subheading {
        opacity: 0.8;
    }

    .clock-container {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: #ffffff;
    }

    #clock {
        font-weight: 700;
    }

    .custom-list li {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .custom-list li:last-child {
        border-bottom: none;
    }

    .birthday-item, .holiday-item {
        background-color: #f1f3f5;
        border-radius: 6px;
        padding: 0.75rem;
        margin-bottom: 0.5rem;
    }

    /* Dashboard cards */
    .dashboard-card {
        border-radius: 8px;
        overflow: hidden;
    }

    .dashboard-card .card-body {
        padding: 1.25rem;
    }

    .dashboard-card .card-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .dashboard-card .card-text {
        font-size: 1.5rem;
        font-weight: 700;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-icon {
            font-size: 1.5rem;
        }

        .dashboard-card .card-title {
            font-size: 0.8rem;
        }

        .dashboard-card .card-text {
            font-size: 1.2rem;
        }
    }

    /* Enhanced responsive styles */
    @media (max-width: 1200px) {
        .dashboard-card .card-title {
            font-size: 0.85rem;
        }
        .dashboard-card .card-text {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 992px) {
        .col-lg-6 {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .welcome-heading {
            font-size: 1.5rem;
        }
        .welcome-subheading {
            font-size: 1.2rem;
        }
        #clock {
            font-size: 2rem;
        }
        .card-icon {
            font-size: 1.3rem;
        }
        .dashboard-card .card-title {
            font-size: 0.8rem;
        }
        .dashboard-card .card-text {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }
        .card-body {
            padding: 1rem;
        }
        .welcome-heading {
            font-size: 1.3rem;
        }
        .welcome-subheading {
            font-size: 1rem;
        }
        #clock {
            font-size: 1.5rem;
        }
        .dashboard-card .card-title {
            font-size: 0.75rem;
        }
        .dashboard-card .card-text {
            font-size: 1rem;
        }
    }

    /* Professional enhancements */
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .welcome-message, .clock-container {
        background-size: 200% 200%;
        animation: gradientAnimation 5s ease infinite;
    }
    @keyframes gradientAnimation {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }
    .animated-text {
        display: inline-block;
        animation: textAnimation 2s ease-in-out infinite;
    }
    @keyframes textAnimation {
        0%, 100% {transform: translateY(0);}
        50% {transform: translateY(-5px);}
    }
    .custom-list li {
        transition: all 0.3s ease;
    }
    .custom-list li:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }
    .dashboard-card {
        overflow: hidden;
    }
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
        transition: all 0.5s ease;
    }
    .dashboard-card:hover::before {
        transform: rotate(30deg) translate(-10%, -10%);
    }

    /* Enhanced Analytics Dashboard Styles */
    .analytics-dashboard {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .analytics-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .analytics-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .analytics-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #333;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.25rem;
    }

    .analytics-icon {
        font-size: 1rem;
        margin-right: 5px;
    }

    .analytics-number {
        font-size: 1.1rem;
        font-weight: 700;
    }

    .analytics-label {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .progress {
        height: 5px;
        border-radius: 2px;
    }

    .chart-container {
        position: relative;
        height: 100px;
    }

    @media (max-width: 768px) {
        .analytics-card {
            margin-bottom: 1rem;
        }
        .analytics-title {
            font-size: 0.9rem;
        }
        .analytics-number {
            font-size: 1rem;
        }
        .analytics-label {
            font-size: 0.75rem;
        }
        .chart-container {
            height: 80px;
        }
    }

    @media (max-width: 576px) {
        .analytics-dashboard {
            padding: 10px;
        }
        .card-body {
            padding: 0.75rem;
        }
        .analytics-title {
            font-size: 0.85rem;
        }
        .analytics-number {
            font-size: 0.95rem;
        }
        .chart-container {
            height: 60px;
        }
    }

    /* Enhanced Card Design */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    /* Enhanced Welcome Message */
    .welcome-message {
        background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        border-radius: 15px;
        padding: 2rem;
    }

    .welcome-heading {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(to right, #fff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    /* Enhanced Clock Container */
    .clock-container {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 15px;
        padding: 2rem;
    }

    #clock {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        margin: 1rem 0;
    }

    /* Enhanced Dashboard Cards */
    .dashboard-card {
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .dashboard-card:hover::before {
        transform: translateX(100%);
    }

    .card-icon {
        font-size: 2.5rem;
        margin-right: 1rem;
        opacity: 0.9;
        transition: transform 0.3s;
    }

    .dashboard-card:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Enhanced Analytics Dashboard */
    .analytics-dashboard {
        background: linear-gradient(to bottom, #f8f9fa, #ffffff);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .analytics-card {
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .analytics-number {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #2193b0, #6dd5ed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Enhanced Progress Bars */
    .progress {
        height: 8px;
        border-radius: 4px;
        background: rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .progress-bar {
        transition: width 1s ease-in-out;
        background: linear-gradient(45deg, #2193b0, #6dd5ed);
    }

    /* Enhanced Birthday Section */
    .birthday-item {
        background: linear-gradient(45deg, #fff, #f8f9fa);
        border-left: 4px solid #6B73FF;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .birthday-item:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* Enhanced Alerts */
    .alert {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.5rem;
        background: linear-gradient(45deg, #4CAF50, #45a049);
        color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .alert-info {
        background: linear-gradient(45deg, #2196F3, #1976D2);
    }

    /* Enhanced Charts */
    .chart-container {
        position: relative;
        height: 120px;
        margin-top: 1.5rem;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .welcome-heading {
            font-size: 2rem;
        }

        #clock {
            font-size: 2.5rem;
        }

        .analytics-number {
            font-size: 1.2rem;
        }

        .chart-container {
            height: 100px;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        body {
            background: #1a1a1a;
        }

        .card {
            background: #2d2d2d;
            color: #ffffff;
        }

        .analytics-dashboard {
            background: linear-gradient(to bottom, #2d2d2d, #1a1a1a);
        }

        .analytics-card {
            background: #2d2d2d;
        }

        .birthday-item {
            background: linear-gradient(45deg, #2d2d2d, #252525);
            border-left-color: #6B73FF;
        }
    }
</style>
<div class="container-fluid">
<!-- Add signature reminder alert -->
    @if(!Auth::user()->hasRole('Employee') && empty(Auth::user()->signature))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Reminder!</strong> You can set up your user signature in your profile settings.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Add signature reminder alert -->
    @if(Auth::user()->hasRole('Employee'))
        @if(!$employees->first()->signature)
            <div class="col-md-12 mb-3">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Notice:</strong> Please add your signature to your employee profile before applying for leave. 
                    <a href="{{ url('/my-profile') }}" class="alert-link">Update your profile here</a>.
                </div>
            </div>
        @endif
    @endif

    <div class="row">
        <!-- Welcome section -->
        <div class="col-lg-6 mb-4">
            @auth
            <div class="welcome-message p-4 rounded shadow-sm">
                <h2 class="welcome-heading mb-2">Welcome, <span class="animated-text">{{ auth()->user()->first_name }}</span></h2>
                <h4 class="welcome-subheading">{{ auth()->user()->last_name }}</h4>
                <div class="d-flex justify-content-between align-items-center position-relative" style="height: 60px;">
                    <span id="greeting" class="mt-3 mb-0 text-white-50" style="font-size: 1.2rem;"></span>
                    <span id="greeting-emoji" class="mt-3 mb-0 text-white-50" style="font-size: 8rem; position: absolute; right: 50px;top: 1px; transform: translate(50%, -50%); margin-right: 10px;"></span>
                </div>
                <script>
                    function updateGreeting() {
                        const now = new Date();
                        const hours = now.getHours();
                        let greeting;
                        let emoji;

                        if (hours < 12) {
                            greeting = "Good Morning";
                            emoji = "☀️";
                        } else if (hours < 18) {
                            greeting = "Good Afternoon";
                            emoji = "🌤️";
                        } else {
                            greeting = "Good Evening";
                            emoji = "🌙";
                        }

                        document.getElementById('greeting').textContent = greeting;
                        document.getElementById('greeting-emoji').textContent = emoji;
                    }

                    updateGreeting(); // Call the function to set the greeting
                </script>
            </div>
            @endauth
        </div>
        <!-- Clock section -->
        <div class="col-lg-6 mb-4">
            <div class="clock-container p-4 rounded shadow-sm">
                <div id="date" class="mb-2 opacity-75"></div>
                <h1 id="clock" class="display-4"></h1>
                <p class="mt-3 mb-0 text-white-50">Philippine Standard Time</p>
            </div>
        </div>
    </div>

    <!-- Posts section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center bg-primary text-white">
                    <i class="fas fa-bullhorn card-icon mr-2"></i>
                    <h5 class="mb-0">Today's Announcements</h5>
                </div>
                <div class="card-body">
                    @if ($todayPosts && $todayPosts->count() > 0)
                        <ul class="custom-list">
                            @foreach ($todayPosts as $post)
                                <li class="mb-3">
                                    <h6 class="mb-1">
                                        <a href="{{ route('posts.showById', $post->id) }}" class="text-decoration-none text-primary">
                                            {{ $post->title }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-1">{{ Str::limit($post->body, 100) }}</p>
                                    <small class="text-muted">Posted {{ $post->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No announcements for today</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Employee's Leave Count section -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center bg-success text-white">
                    <i class="fas fa-calendar-check card-icon mr-2"></i>
                    <h5 class="mb-0">Standard Leave Allocation</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Sick Leave</h6>
                            <h2 class="mb-0">7 <small>days</small></h2>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Vacation Leave</h6>
                            <h2 class="mb-0">5 <small>days</small></h2>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="text-muted">Emergency Leave</h6>
                            <h2 class="mb-0">3 <small>days</small></h2>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="fas fa-info-circle mr-1"></i>
                        Leave allocations are reset annually on January 1st.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Remaining Leave Balance section -->
    @if(auth()->user()->hasRole('Employee'))
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i>Your Remaining Leave Balance</h5>
                    </div>
                    <div class="card-body">
                        @if ($leaveDetails)
                            @foreach(['sick_leave', 'vacation_leave', 'emergency_leave'] as $leaveType)
                                <p>
                                    <strong>{{ ucfirst(str_replace('_', ' ', $leaveType)) }}:</strong>
                                    {{ $leaveDetails[$leaveType] }} Hours
                                    ({{ number_format($leaveDetails[$leaveType] / 24, 2) }} Days)
                                </p>
                            @endforeach
                        @else
                            <p class="text-muted">No leave balance available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Birthdays section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-birthday-cake mr-2"></i>Birthdays in {{ $currentMonthNameBirthdays }}</h5>
                </div>
                <div class="card-body">
                    @if($greeting)
                        <h3 class="animated-greeting">{{ $greeting }}</h3>
                    @endif

                    @if($todaysBirthdays->where('employee_status', 'Active')->isNotEmpty())
                        <h3 class="birthday-heading">Today's Birthdays</h3>
                        <ul class="birthday-list">
                            @foreach($todaysBirthdays->where('employee_status', 'Active') as $employee)
                                <li class="birthday-item">{{ $employee->first_name }} {{ $employee->last_name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($upcomingBirthdays->where('employee_status', 'Active')->isNotEmpty())
                        <h3 class="birthday-heading">Upcoming Birthdays This Month</h3>
                        <ul class="birthday-list">
                            @foreach($upcomingBirthdays->where('employee_status', 'Active') as $employee)
                                <li class="birthday-item">
                                    {{ $employee->first_name }} {{ $employee->last_name }} -
                                    {{ \Carbon\Carbon::parse($employee->birth_date)->format('F d') }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No upcoming birthdays this month</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Holidays of the Month section -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i>Holidays in {{ $currentMonthName }}</h5>
                </div>
                <div class="card-body">
                    @if ($todayHoliday)
                        <p>Today is <strong class="text-danger">{{ $todayHoliday->title }}</strong> - {{ \Carbon\Carbon::parse($todayHoliday->date)->format('F j, Y') }}</p>
                    @endif
                    @if ($upcomingHolidays->isEmpty())
                        <p class="text-muted">No upcoming holidays this month</p>
                    @else
                        <ul class="custom-list">
                            @foreach ($upcomingHolidays as $holiday)
                                <li>
                                    <strong class="text-danger">{{ $holiday->title }}</strong> -
                                    {{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Admin dashboard section -->
    @canany(['super-admin', 'admin', 'hrcomben', 'hrcompliance'])
        <div class="row">
            @php
                $dashboardItems = [
                    ['icon' => 'fas fa-users', 'title' => 'Users', 'count' => $userCount, 'bg' => 'bg-info'],
                    ['icon' => 'fas fa-user-tie', 'title' => 'Employees', 'count' => $employeeCount, 'bg' => 'bg-primary'],
                    ['icon' => 'fas fa-calendar-check', 'title' => 'All Attended', 'count' => $attendanceAllCount, 'bg' => 'bg-purple'],
                    ['icon' => 'fas fa-calendar-check', 'title' => 'Attended Today', 'count' => $attendanceCount, 'bg' => 'bg-success'],
                ];
            @endphp

            @foreach($dashboardItems as $item)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card dashboard-card {{ $item['bg'] }} text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="{{ $item['icon'] }} card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">{{ $item['title'] }}</h6>
                                    <h2 class="card-text mb-0">{{ $item['count'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Leave section -->
        <div class="row">
            @php
                $leaveItems = [
                    ['icon' => 'fas fa-sign-out-alt', 'title' => 'All Leaves', 'count' => $leaveCount, 'bg' => 'bg-primary'],
                    ['icon' => 'fas fa-check', 'title' => 'Approved Leaves', 'count' => $approvedLeavesCount, 'bg' => 'bg-success'],
                    ['icon' => 'fas fa-hourglass-half', 'title' => 'Pending Leaves', 'count' => $pendingLeavesCount, 'bg' => 'bg-warning'],
                    ['icon' => 'fas fa-times', 'title' => 'Rejected Leaves', 'count' => $rejectedLeavesCount, 'bg' => 'bg-danger'],
                ];
            @endphp

            @foreach($leaveItems as $item)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card {{ $item['bg'] }} text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="{{ $item['icon'] }} card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">{{ $item['title'] }}</h6>
                                    <h2 class="card-text mb-0">{{ $item['count'] }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @endcanany
            @can('hrhiring')
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-tie card-icon"></i>
                                <div>
                                    <h6 class="card-title mb-0">Applicant</h6>
                                    <h2 class="card-text mb-0">{{ $careerCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
</div>

<script>
    (function() {
        function updateClock() {
            const now = new Date();
            updateClockDisplay(now);
            setTimeout(updateClock, 1000);
        }

        function updateClockDisplay(dateTime) {
            const clock = document.getElementById('clock');
            const dateElement = document.getElementById('date');

            if (!clock || !dateElement) return;

            try {
                // Format time: 12:34:56 PM
                const timeOptions = {
                    hour: 'numeric',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Manila'
                };

                // Format date: Monday, January 1, 2024
                const dateOptions = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    timeZone: 'Asia/Manila'
                };

                clock.textContent = dateTime.toLocaleTimeString('en-US', timeOptions);
                dateElement.textContent = dateTime.toLocaleDateString('en-US', dateOptions);
            } catch (error) {
                console.error('Error updating clock display:', error);
                // Fallback to basic format if there's an error
                clock.textContent = dateTime.toLocaleTimeString('en-US');
                dateElement.textContent = dateTime.toLocaleDateString('en-US');
            }
        }

        // Start the clock
        updateClock();
    })();

    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add animation to cards on scroll
    const cards = document.querySelectorAll('.card');
    const animateCards = () => {
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const triggerBottom = window.innerHeight / 5 * 4;
            if(cardTop < triggerBottom) {
                card.classList.add('show');
            } else {
                card.classList.remove('show');
            }
        });
    }
    window.addEventListener('scroll', animateCards);
</script>

<!-- Analytics Dashboard -->
@canany(['super-admin', 'admin'])
<div class="analytics-dashboard mt-4">
    <h4 class="mb-3 text-center">Analytics Dashboard</h4>

    <!-- Contributions Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-2">
            <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>Contribution Analytics</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    $contributionItems = [
                        [
                            'title' => 'SSS',
                            'icon' => 'fas fa-shield-alt',
                            'color' => 'primary',
                            'total' => $analytics['sss']['total_contributions'],
                            'count' => $analytics['sss']['contribution_count'],
                            'chartId' => 'sssChart',
                            'data' => $analytics['sss']['monthly_trend']
                        ],
                        [
                            'title' => 'Pagibig',
                            'icon' => 'fas fa-home',
                            'color' => 'success',
                            'total' => $analytics['pagibig']['total_contributions'],
                            'count' => $analytics['pagibig']['contribution_count'],
                            'chartId' => 'pagibigChart',
                            'data' => $analytics['pagibig']['monthly_trend']
                        ],
                        [
                            'title' => 'Philhealth',
                            'icon' => 'fas fa-heartbeat',
                            'color' => 'danger',
                            'total' => $analytics['philhealth']['total_contributions'],
                            'count' => $analytics['philhealth']['contribution_count'],
                            'chartId' => 'philhealthChart',
                            'data' => $analytics['philhealth']['monthly_trend']
                        ],
                    ];
                @endphp

                @foreach($contributionItems as $item)
                <div class="col-md-4 mb-3">
                    <div class="card analytics-card h-100 border-{{ $item['color'] }}">
                        <div class="card-body p-3">
                            <h6 class="analytics-title text-{{ $item['color'] }}">
                                <i class="{{ $item['icon'] }} analytics-icon"></i>{{ $item['title'] }}
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="analytics-label">Total Contributions</span>
                                <span class="analytics-number text-{{ $item['color'] }}">₱{{ number_format($item['total'], 2) }}</span>
                            </div>
                            <div class="chart-container mt-3">
                                <canvas id="{{ $item['chartId'] }}"></canvas>
                            </div>
                            <div class="text-center mt-2">
                                <small class="text-muted">Monthly Trend - {{ $item['count'] }} contributions</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Loans Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white py-2">
            <h5 class="mb-0"><i class="fas fa-money-bill-wave mr-2"></i>Loan Analytics</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    $loanItems = [
                        [
                            'title' => 'SSS Loans',
                            'icon' => 'fas fa-money-bill-wave',
                            'color' => 'warning',
                            'total' => $analytics['loans']['sss_loans']['total_amount'],
                            'count' => $analytics['loans']['sss_loans']['loan_count'],
                            'chartId' => 'sssLoanChart',
                            'data' => $analytics['loans']['sss_loans']['monthly_trend'] ?? []
                        ],
                        [
                            'title' => 'Pagibig Loans',
                            'icon' => 'fas fa-hand-holding-usd',
                            'color' => 'info',
                            'total' => $analytics['loans']['pagibig_loans']['total_amount'],
                            'count' => $analytics['loans']['pagibig_loans']['loan_count'],
                            'chartId' => 'pagibigLoanChart',
                            'data' => $analytics['loans']['pagibig_loans']['monthly_trend'] ?? []
                        ],
                        [
                            'title' => 'Cash Advances',
                            'icon' => 'fas fa-hand-holding-usd',
                            'color' => 'secondary',
                            'total' => $analytics['loans']['cash_advances']['total_amount'],
                            'count' => $analytics['loans']['cash_advances']['advance_count'],
                            'chartId' => 'cashAdvanceChart',
                            'data' => $analytics['loans']['cash_advances']['monthly_trend'] ?? []
                        ],
                    ];
                @endphp

                @foreach($loanItems as $item)
                <div class="col-md-4 mb-3">
                    <div class="card analytics-card h-100 border-{{ $item['color'] }}">
                        <div class="card-body p-3">
                            <h6 class="analytics-title text-{{ $item['color'] }}">
                                <i class="{{ $item['icon'] }} analytics-icon"></i>{{ $item['title'] }}
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="analytics-label">Total Amount</span>
                                <span class="analytics-number text-{{ $item['color'] }}">₱{{ number_format($item['total'], 2) }}</span>
                            </div>
                            <div class="chart-container mt-3">
                                <canvas id="{{ $item['chartId'] }}"></canvas>
                            </div>
                            <div class="text-center mt-2">
                                <small class="text-muted">Monthly Trend - {{ $item['count'] }} active</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endcanany

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function createLineChart(elementId, label, data, color) {
        const ctx = document.getElementById(elementId).getContext('2d');
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: color,
                    backgroundColor: color + '20', // Add transparency to background
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: color,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Create charts when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Contribution Charts
        createLineChart('sssChart', 'SSS Contributions', @json($analytics['sss']['monthly_trend']), '#0d6efd');
        createLineChart('pagibigChart', 'Pagibig Contributions', @json($analytics['pagibig']['monthly_trend']), '#198754');
        createLineChart('philhealthChart', 'Philhealth Contributions', @json($analytics['philhealth']['monthly_trend']), '#dc3545');

        // Loan Charts
        createLineChart('sssLoanChart', 'SSS Loans', @json($analytics['loans']['sss_loans']['monthly_trend'] ?? []), '#ffc107');
        createLineChart('pagibigLoanChart', 'Pagibig Loans', @json($analytics['loans']['pagibig_loans']['monthly_trend'] ?? []), '#0dcaf0');
        createLineChart('cashAdvanceChart', 'Cash Advances', @json($analytics['loans']['cash_advances']['monthly_trend'] ?? []), '#6c757d');
    });
</script>
@endsection
