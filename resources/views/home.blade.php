@extends('layouts.app')
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
    </style>

@section('content')
<br>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Welcome section -->
        <div class="col-lg-6 mb-4">
            @auth <!-- Check if user is authenticated -->
            <div class="welcome-message p-4 bg-white rounded shadow-sm">
                <h2 class="welcome-heading mb-2">Welcome, <span class="animated-text text-primary">{{ auth()->user()->first_name }}</span></h2>
                <h4 class="welcome-subheading text-muted">{{ auth()->user()->last_name }}</h4>
            </div>
        @endauth
        </div>
        <!-- Clock section -->
        <div class="col-lg-6 mb-4">
            <div class="clock-container p-4 bg-white rounded shadow-sm">
                <div id="date" class="mb-2 text-muted"></div>
                <h1 id="clock" class="display-4 font-weight-bold"></h1>
            </div>
        </div>
    </div>

    <!-- Posts section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-bullhorn mr-2"></i>Today's Announcement</h5>
                </div>
                <div class="card-body">
                    <!-- Today's Posts -->
                    @if ($todayPosts && $todayPosts->count() > 0)
                        <ul class="custom-list">
                            @foreach ($todayPosts as $post)
                                <li>
                                    <h6>
                                        <a href="#" data-toggle="modal" data-target="#todayPostModal{{ $post->id }}">
                                            {{ $post->title }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-0">{{ Str::limit($post->body, 100) }}</p>
                                    <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No Today's Posts Available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Employee's Leave Count section -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check mr-2"></i>Count of Employee's Leave</h5>
                </div>
                <div class="card-body">
                    <p><strong>Sick Leave</strong> - 7 days</p>
                    <p><strong>Vacation Leave</strong> - 5 days</p>
                    <p><strong>Emergency Leave</strong> - 3 days</p>
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
                            <p><strong>Sick Leave:</strong> {{ $leaveDetails['sick_leave'] }} Hours - is equivalent {{ $leaveDetails['sick_leave'] / 24 }} Days </p>
                            <p><strong>Vacation Leave:</strong> {{ $leaveDetails['vacation_leave'] }} Hours - is equivalent {{ $leaveDetails['vacation_leave'] / 24 }} Days</p>
                            <p><strong>Emergency Leave:</strong> {{ $leaveDetails['emergency_leave'] }} Hours - is equivalent {{ $leaveDetails['emergency_leave'] / 24 }} Days</p>
                        @else
                            <p class="text-muted">No Leave Balance Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Announcements section -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-birthday-cake mr-2"></i>Birthdays of this {{ $currentMonthNameBirthdays }}</h5>
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
                        <h3 class="birthday-heading">Upcoming Birthdays This {{ $currentMonthNameBirthdays }}</h3>
                        <ul class="birthday-list">
                            @foreach($upcomingBirthdays as $employee)
                                <li class="birthday-item">{{ $employee->first_name }} {{ $employee->last_name }} - {{ \Carbon\Carbon::parse($employee->birth_date)->format('F d') }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No Upcoming Birthdays Available this {{ $currentMonthNameBirthdays }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Holidays of the Month section -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt mr-2"></i>Holidays of {{ $currentMonthName }}</h5>
                </div>
                <div class="card-body">
                    @if ($todayHoliday)
                        <p>Today is <strong style="color:red">{{ $todayHoliday->title }}</strong>-{{ \Carbon\Carbon::parse($todayHoliday->date)->format('F j, Y') }}</p>
                    @endif
                    @if ($upcomingHolidays->isEmpty())
                        <p class="text-muted">No upcoming holidays this {{ $currentMonthName }}</p>
                    @else
                        <ul class="custom-list">
                            @foreach ($upcomingHolidays as $holiday)
                                <li><strong style="color:red">{{ $holiday->title }}</strong> at {{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- Admin dashboard section -->
@canany(['super-admin', 'admin','hrcomben', 'hrcompliance'])
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Users</h6>
                            <h2 class="card-text mb-0">{{ $userCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-tie card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Employees</h6>
                            <h2 class="card-text mb-0">{{ $employeeCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-purple text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-check card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">All Attended</h6>
                            <h2 class="card-text mb-0">{{ $attendanceAllCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-check card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Attended Today</h6>
                            <h2 class="card-text mb-0">{{ $attendanceCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave section -->
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sign-out-alt card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">All Leaves</h6>
                            <h2 class="card-text mb-0">{{ $leaveCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Approved Leaves</h6>
                            <h2 class="card-text mb-0">{{ $approvedLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-hourglass-half card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Pending Leaves</h6>
                            <h2 class="card-text mb-0">{{ $pendingLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times card-icon"></i>
                        <div>
                            <h6 class="card-title mb-0">Rejected Leaves</h6>
                            <h2 class="card-text mb-0">{{ $rejectedLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcanany
    <script>
    (function() {
        function updateClock() {
            fetch('http://worldtimeapi.org/api/timezone/Asia/Manila')
                .then(response => response.json())
                .then(data => {
                    // Extract the datetime from the API response
                    const dateTime = new Date(data.datetime);

                    // Extract hours, minutes, and seconds
                    let hours = dateTime.getHours();
                    let minutes = dateTime.getMinutes();
                    let seconds = dateTime.getSeconds();
                    const ampm = hours >= 12 ? 'PM' : 'AM';

                    // Convert hours to 12-hour format
                    hours = hours % 12;
                    hours = hours ? hours : 12; // Handle midnight (0 hours)

                    // Ensure two digits format for minutes and seconds
                    minutes = (minutes < 10 ? "0" : "") + minutes;
                    seconds = (seconds < 10 ? "0" : "") + seconds;

                    // Update the clock
                    document.getElementById('clock').innerHTML = hours + ":" + minutes + ":" + seconds + " " + ampm;

                    // Extract day and date
                    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    const monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                    const day = daysOfWeek[dateTime.getDay()];
                    const date = dateTime.getDate();
                    const month = monthsOfYear[dateTime.getMonth()];
                    const year = dateTime.getFullYear();

                    // Format the date
                    const formattedDate = month + " " + date + ", " + year + " " + day;

                    // Update the date
                    document.getElementById('date').innerHTML = formattedDate;
                })
                .catch(error => {
                    console.error('Error fetching time:', error);
                });

            // Run the function every second
            setTimeout(updateClock, 1000);
        }

        // Call the function to start updating the clock
        updateClock();
    })();
</script>
@endsection
