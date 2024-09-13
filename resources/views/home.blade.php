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
@stop
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
    .welcome-container {
    text-align: left;
    padding: 20px;
}

.welcome-heading {
    font-size: 36px;
    color: #4285F4; /* Google blue */
    font-weight: bold;
}

.welcome-subheading {
    font-size: 30px;
    color: #666;
}

.animated-text {
    animation: pulse 1s infinite alternate;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}
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
</style>
@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <!-- Welcome section -->
        <div class="col-md-6">
            @auth <!-- Check if user is authenticated -->
            <div class="welcome-message">
                <h2 class="welcome-heading">Welcome, <span class="animated-text">{{ auth()->user()->first_name }}</span></h2>
                <h4 class="welcome-subheading">{{ auth()->user()->last_name }}</h4>
            </div>
        @endauth
        </div>
        <!-- Clock section -->
        <div class="col-md-6">
            <div class="clock-container">
                <div class="analog-clock">
                    <div class="hour-hand"></div>
                    <div class="minute-hand"></div>
                    <div class="second-hand"></div>
                    <div class="center-dot"></div>
                </div>
                <div id="date" style="font-size: 1.5em;"></div>
                <h1 id="clock" style="font-size: 3em;"></h1>
            </div>
        </div>
    </div>

    <!-- Posts section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0"><i class="fas fa-bullhorn"></i> Today's Announcement</h2>
                    <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="This field is for posts and announcements">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <!-- Today's Posts -->
                    @if ($todayPosts && $todayPosts->count() > 0)
                        @foreach ($todayPosts as $post)
                            <div class="post-item">
                                <h6>
                                    <a href="#" data-toggle="modal" data-target="#todayPostModal{{ $post->id }}">
                                        <i class="fas fa-circle" style="font-size: 5px;"></i> {{ $post->title }}
                                    </a>
                                </h6>
                                <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                                <p class="card-text"><small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small></p>
                                <hr>

                                <!-- Modal for Today's Post -->
                                <div class="modal fade" id="todayPostModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="todayPostModalLabel{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="todayPostModalLabel{{ $post->id }}">{{ $post->title }}</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5>Content</h5>
                                                            <p>{!! nl2br(e($post->content)) !!}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($post->date)->format('F j, Y') }}</p>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <p><strong>Author:</strong> {{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </div>
                        @endforeach
                    @else
                        <p>No Today's Posts Available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Employee's Leave Count section -->
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0">Count of Employee's Leave</h2>
                    <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="Regular leave count">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </div>
            </div>
            <div class="card mt-3">
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
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-0">Your Remaining Leave Balance</h2>
                        <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="Remaining leave balances">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        @if ($leaveDetails)
                            <p><strong>Sick Leave:</strong> {{ $leaveDetails['sick_leave'] }} Hours - is equivalent {{ $leaveDetails['sick_leave'] / 24 }} Days </p>
                            <p><strong>Vacation Leave:</strong> {{ $leaveDetails['vacation_leave'] }} Hours - is equivalent {{ $leaveDetails['vacation_leave'] / 24 }} Days</p>
                            <p><strong>Emergency Leave:</strong> {{ $leaveDetails['emergency_leave'] }} Hours - is equivalent {{ $leaveDetails['emergency_leave'] / 24 }} Days</p>
                        @else
                            <p>No Leave Balance Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Announcements section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0"><i class="fas fa-birthday-cake"></i> Birthdays of this {{ $currentMonthNameBirthdays }}</h2>
                    <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="This field is for birthdays">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </div>
            </div>
            <div class="card mt-3">
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
                        <p>No Upcoming Birthdays Available this {{ $currentMonthNameBirthdays }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Holidays of the Month section -->
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0">
                        <i class="fas fa-calendar-alt"></i> Holidays of {{ $currentMonthName }}
                    </h2>
                    <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="This field is for upcoming holidays">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    @if ($todayHoliday)
                        <p>Today is <strong style="color:red">{{ $todayHoliday->title }}</strong>-{{ \Carbon\Carbon::parse($todayHoliday->date)->format('F j, Y') }}</p>
                    @endif
                    @if ($upcomingHolidays->isEmpty())
                        <p>No upcoming holidays this {{ $currentMonthName }}</p>
                    @else
                        <ul>
                            @foreach ($upcomingHolidays as $holiday)
                                <li><strong style="color:red">{{ $holiday->title }}</strong> at {{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User IP Address section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0"><i class="fas fa-user"></i> Your IP Address</h2>
                    <span class="ml-auto" data-toggle="tooltip" data-placement="top" title="This field is for recent login IP">
                        <i class="fas fa-question-circle"></i>
                    </span>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <p id="userIp">Fetching IP...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Admin dashboard section -->
@canany(['super-admin', 'admin','hrcomben', 'hrcompliance'])
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Users</h4>
                            <h2 class="card-text">{{ $userCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-user-tie fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Employees</h4>
                            <h2 class="card-text">{{ $employeeCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-purple text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-calendar-check fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">All Attended</h4>
                            <h2 class="card-text">{{ $attendanceAllCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-calendar-check fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Attended Today</h4>
                            <h2 class="card-text">{{ $attendanceCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
    </div>

    <!-- Leave section -->
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-sign-out-alt fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">All Leaves</h4>
                            <h2 class="card-text">{{ $leaveCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-check fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Approved Leaves</h4>
                            <h2 class="card-text">{{ $approvedLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-hourglass-half fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Pending Leaves</h4>
                            <h2 class="card-text">{{ $pendingLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-times fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="card-title">Rejected Leaves</h4>
                            <h2 class="card-text">{{ $rejectedLeavesCount }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
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
