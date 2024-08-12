@extends('adminlte::page')

@section('preloader')
    <div class="text-center">
        <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
@stop
<style>
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
</style>
@section('content')
<br>
<div class="container">
<div class="welcome-container">
    @auth <!-- Check if user is authenticated -->
        <div class="welcome-message">
            <h2 class="welcome-heading">Welcome, <span class="animated-text">{{ auth()->user()->first_name }}</span></h2>
            <h4 class="welcome-subheading">{{ auth()->user()->last_name }}</h4>
        </div>
    @endauth
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
<!-- Post, Announcements, Leaves Count -->
<div class="container">
    <div class="row">
<!-- Posts Section -->
<div class="col-lg-6 mb-4">
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

        <!-- Employee's Leave Count Section -->
        <div class="col-lg-6 mb-4">
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

    @can('normal-employee')
    <div class="row">
        <!-- Remaining Leave Balance Section -->
        <div class="col-lg-6 mb-4">
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
    @endcan

<!-- Announcements Section -->
<div class="col-lg-6 mb-4">
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
            @if($todaysBirthdays->isNotEmpty())
                <h3>Today's Birthdays</h3>
                <ul>
                    @foreach($todaysBirthdays as $employee)
                        <li>{{ $employee->first_name }} {{ $employee->last_name }}</li>
                    @endforeach
                </ul>
            @endif

            @if($upcomingBirthdays->isNotEmpty())
                <h3>Upcoming Birthdays This {{ $currentMonthNameBirthdays }}</h3>
                <ul>
                    @foreach($upcomingBirthdays as $employee)
                        <li>{{ $employee->first_name }} {{ $employee->last_name }} - {{ \Carbon\Carbon::parse($employee->birth_date)->format('F d') }}</li>
                    @endforeach
                </ul>
            @else
                <p>No Upcoming  Birthdays Available this {{ $currentMonthNameBirthdays }}</p>
            @endif
        </div>
    </div>
</div>

    </div>

    <div class="row">
        <!-- Holidays of the Month Section -->
        <div class="col-lg-6 mb-4">
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

        <!-- User IP Address Section -->
        <div class="col-lg-6 mb-4">
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

<script>
    // Function to fetch user's IP address
    function fetchUserIp() {
        fetch('https://api64.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                const userIp = data.ip;
                document.getElementById('userIp').textContent = `Your IP address: ${userIp}`;
            })
            .catch(error => {
                console.error('Error fetching IP:', error);
                document.getElementById('userIp').textContent = 'Unable to fetch IP address.';
            });
    }

    // Call fetchUserIp function when the document is ready
    document.addEventListener('DOMContentLoaded', function() {
        fetchUserIp();
    });
</script>
<hr>
@canany(['super-admin', 'admin'])
    <div class="row">
        <div class="col">
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
        <!-- /.col -->
        <div class="col">
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
         <!-- /.col -->
         <div class="col">
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
        <!-- /.col -->
        <div class="col">
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
    <!-- /.row -->

    <div class="row">
    <div class="col">
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
        <div class="col">
            <div class="card bg-gray text-white">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3">
                            <i class="fas fa-redo fa-3x"></i>
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
        <!-- /.col -->
        <div class="col">
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
        <!-- /.col -->
        <div class="col">
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
    <!-- row -->
</div>
 <!-- Chart container -->
 <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly SSS Contributions</h3>
                </div>
                <div class="card-body">
                    <canvas id="sssChart" style="height: 100px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly PAGIBIG Contributions</h3>
                </div>
                <div class="card-body">
                    <canvas id="pagibigChart" style="height: 100px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly TIN Contributions</h3>
                </div>
                <div class="card-body">
                    <canvas id="tinChart" style="height: 100px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly PHILHEALTH Contributions</h3>
                </div>
                <div class="card-body">
                    <canvas id="philhealthChart" style="height: 100px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endcanany
<!-- <div class="calendar">
        <div class="header">
            <button id="prevMonth">&#10094;</button>
            <h2 id="monthYear"></h2>
            <button id="nextMonth">&#10095;</button>
        </div>
        <div class="days"></div>
    </div>
    <br> -->
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



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('sssChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly SSS Contributions',
                    data: [
                        @foreach ($sssMonthlyContributions as $sssContribution)
                            {{$sssContribution}},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('pagibigChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly PAGIBIG Contributions',
                    data: [
                        @foreach ($pagibigMonthlyContributions as $pagibigContribution)
                            {{$pagibigContribution}},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('tinChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly TIN Contributions',
                    data: [
                        @foreach ($tinMonthlyContributions as $tinContribution)
                            {{$tinContribution}},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('philhealthChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly PHILHEALTH Contributions',
                    data: [
                        @foreach ($philhealthMonthlyContributions as $philhealthContribution)
                            {{$philhealthContribution}},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@canany(['super-admin', 'admin'])
<canvas id="departmentChart" width="100" height="100"></canvas>
@endcanany
<script>
    const ctx = document.getElementById('departmentChart').getContext('2d');
    const departmentData = @json($employeesByDepartment);
    
    const labels = Object.keys(departmentData);
    const data = Object.values(departmentData);
    
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Employees by Department',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Employee Distribution by Department'
                }
            }
        }
    });
</script>

@endsection
