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
            background-color: #ffe4b5; /* Moccasin color */
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
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
</style>

<div class="container-fluid py-4">
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
                                        <a href="#" data-toggle="modal" data-target="#todayPostModal{{ $post->id }}" class="text-decoration-none text-primary">
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
    @can('normal-employee')
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
    @endcan

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

                    @if($todaysBirthdays->isNotEmpty())
                        <h3 class="birthday-heading">Today's Birthdays</h3>
                        <ul class="birthday-list">
                            @foreach($todaysBirthdays as $employee)
                                <li class="birthday-item">{{ $employee->first_name }} {{ $employee->last_name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if($upcomingBirthdays->isNotEmpty())
                        <h3 class="birthday-heading">Upcoming Birthdays This Month</h3>
                        <ul class="birthday-list">
                            @foreach($upcomingBirthdays as $employee)
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
            fetch('https://worldtimeapi.org/api/timezone/Asia/Manila')
                .then(response => response.json())
                .then(data => {
                    const dateTime = new Date(data.datetime);
                    updateClockDisplay(dateTime);
                })
                .catch(error => {
                    console.error('Error fetching time:', error);
                    // Fallback to local time if API fails
                    updateClockDisplay(new Date());
                });

            setTimeout(updateClock, 1000);
        }

        function updateClockDisplay(dateTime) {
            const clock = document.getElementById('clock');
            const dateElement = document.getElementById('date');

            const timeOptions = { hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true };
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

            clock.textContent = dateTime.toLocaleTimeString('en-US', timeOptions);
            dateElement.textContent = dateTime.toLocaleDateString('en-US', dateOptions);
        }

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
                        ['title' => 'SSS', 'icon' => 'fas fa-shield-alt', 'color' => 'primary', 'total' => $analytics['sss']['total_contributions'], 'count' => $analytics['sss']['contribution_count'], 'chartId' => 'sssChart'],
                        ['title' => 'Pagibig', 'icon' => 'fas fa-home', 'color' => 'success', 'total' => $analytics['pagibig']['total_contributions'], 'count' => $analytics['pagibig']['contribution_count'], 'chartId' => 'pagibigChart'],
                        ['title' => 'Philhealth', 'icon' => 'fas fa-heartbeat', 'color' => 'danger', 'total' => $analytics['philhealth']['total_contributions'], 'count' => $analytics['philhealth']['contribution_count'], 'chartId' => 'philhealthChart'],
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
                                <span class="analytics-label">Total</span>
                                <span class="analytics-number text-{{ $item['color'] }}">₱{{ number_format($item['total'], 2) }}</span>
                            </div>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-{{ $item['color'] }}" role="progressbar" style="width: {{ min(100, ($item['count'] / 1000) * 100) }}%" aria-valuenow="{{ $item['count'] }}" aria-valuemin="0" aria-valuemax="1000"></div>
                            </div>
                            <small class="text-muted">{{ $item['count'] }} contributions</small>
                            <div class="chart-container mt-3" style="height: 100px;">
                                <canvas id="{{ $item['chartId'] }}"></canvas>
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
                        ['title' => 'SSS Loans', 'icon' => 'fas fa-money-bill-wave', 'color' => 'warning', 'total' => $analytics['loans']['sss_loans']['total_amount'], 'count' => $analytics['loans']['sss_loans']['loan_count'], 'chartId' => 'sssLoanChart'],
                        ['title' => 'Pagibig Loans', 'icon' => 'fas fa-hand-holding-usd', 'color' => 'info', 'total' => $analytics['loans']['pagibig_loans']['total_amount'], 'count' => $analytics['loans']['pagibig_loans']['loan_count'], 'chartId' => 'pagibigLoanChart'],
                        ['title' => 'Cash Advances', 'icon' => 'fas fa-hand-holding-usd', 'color' => 'secondary', 'total' => $analytics['loans']['cash_advances']['total_amount'], 'count' => $analytics['loans']['cash_advances']['advance_count'], 'chartId' => 'cashAdvanceDoughnutChart'],
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
                                <span class="analytics-label">Total</span>
                                <span class="analytics-number text-{{ $item['color'] }}">₱{{ number_format($item['total'], 2) }}</span>
                            </div>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-{{ $item['color'] }}" role="progressbar" style="width: {{ min(100, ($item['count'] / 100) * 100) }}%" aria-valuenow="{{ $item['count'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">{{ $item['count'] }} {{ $item['title'] == 'Cash Advances' ? 'advances' : 'active loans' }}</small>
                            <div class="chart-container mt-3" style="height: 100px;">
                                <canvas id="{{ $item['chartId'] }}"></canvas>
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
    // Function to create a line chart
    function createLineChart(elementId, label, data) {
        const ctx = document.getElementById(elementId).getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: label,
                    data: data,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        display: false // Hide Y axis for more compact view
                    },
                    x: {
                        display: false // Hide X axis for more compact view
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend for more compact view
                    }
                }
            }
        });
    }

    // Function to create a doughnut chart for loans
    function createDoughnutChart(elementId, label, data) {
        const ctx = document.getElementById(elementId).getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Available'],
                datasets: [{
                    data: [data, 100 - data],
                    backgroundColor: ['#007bff', '#e9ecef']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Create charts when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        createLineChart('sssChart', 'SSS Contributions', @json($analytics['sss']['monthly_trend']));
        createLineChart('pagibigChart', 'Pagibig Contributions', @json($analytics['pagibig']['monthly_trend']));
        createLineChart('philhealthChart', 'Philhealth Contributions', @json($analytics['philhealth']['monthly_trend']));
        createDoughnutChart('sssLoanChart', 'SSS Loans', {{ min(100, ($analytics['loans']['sss_loans']['loan_count'] / 100) * 100) }});
        createDoughnutChart('pagibigLoanChart', 'Pagibig Loans', {{ min(100, ($analytics['loans']['pagibig_loans']['loan_count'] / 100) * 100) }});
        createLineChart('cashAdvanceChart', 'Cash Advances', @json($analytics['cash_advance']['monthly_trend']));
        createDoughnutChart('cashAdvanceDoughnutChart', 'Cash Advances', {{ min(100, ($analytics['loans']['cash_advances']['advance_count'] / 100) * 100) }});
    });
</script>
@endsection
