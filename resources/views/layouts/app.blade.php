<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MHR Property COnglomerates, Inc.</title>
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

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .contribution-nav {
        display: flex;
        gap: 15px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .contribution-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #333;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        border: 1px solid #dee2e6;
    }
    .contribution-link:hover {
        background-color: #e9ecef;
        text-decoration: none;
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .contribution-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }
    .contribution-link .icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(0,0,0,0.1);
        margin-right: 10px;
    }
    .contribution-link.active .icon-wrapper {
        background-color: rgba(255,255,255,0.2);
    }
    .contribution-link .icon-wrapper i {
        font-size: 1.2rem;
    }
    .contribution-link .text-wrapper {
        display: flex;
        flex-direction: column;
    }
    .contribution-link .title {
        font-weight: bold;
        font-size: 1rem;
    }
    .contribution-link .description {
        font-size: 0.75rem;
        opacity: 0.8;
    }
    .contribution-link.active .description {
        opacity: 0.9;
    }
    /*toast*/
    .toast-container {
    z-index: 1050;
    position: fixed;
    bottom: 1rem;
    right: 1rem;
}

.toast {
    background-color: #226304;
    color: white;
}
.status-active {
        color: #fff;
        border: 1px solid green;
        background-color: green;
        padding: 2px 4px;
        border-radius: 5px;
    }

    .status-inactive {
        color: #fff;
        border: 1px solid red;
        background-color: red;
        padding: 2px 4px;
        border-radius: 5px;
    }

    /* Profile Image Styling */
    .profile-img {
        border: 3px solid #8e44ad; /* Purple border for a professional look */
        padding: 5px;
        background-color: #fff;
        object-fit: cover;
        width: 200px;
        height: 200px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .text-primary {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .theme-option {
        width: 30px;
        height: 30px;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        opacity: 0.8;
        position: relative;
    }

    .theme-option:hover {
        opacity: 1;
    }

    .theme-option.active::after {
        content: '\2714';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 16px;
    }
</style>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
    <div id="loader" class="loader">
        <div class="loader-content">
            <div class="mhr-loader">
                <div class="spinner"></div>
                <div class="mhr-text">MHR</div>
            </div>
            <h4 class="mt-4 text-dark">Loading...</h4>
        </div>
    </div>

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    {{-- <a href="{{ url('/') }}" class="nav-link">Home</a> --}}
                </li>
                <!-- Add more nav items here -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Add this line -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-paint-brush"></i>
                    </a>
                </li>
                @can('admin', 'super-admin', 'hrcomben', 'hrcompliance', 'hrpolicy')
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cogs"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @can('admin', 'super-admin')
                        <a href="{{ url('types') }}" class="dropdown-item">
                            <i class="fas fa-folder mr-2"></i> Leave Type
                        </a>
                        @endcan
                        @can('admin', 'super-admin', 'hrcompliance', 'hrpolicy')
                        <a href="{{ url('posts') }}" class="dropdown-item">
                            <i class="fas fa-bullhorn mr-2"></i> Announcement
                        </a>
                        @endcan
                        @can('admin')
                        <a href="{{ url('tasks') }}" class="dropdown-item">
                            <i class="fas fa-tasks mr-2"></i> Send Task
                        </a>
                        @endcan
                        @can('admin', 'super-admin', 'hrcomben')
                        <a href="{{ url('holidays') }}" class="dropdown-item">
                            <i class="fas fa-calendar-alt mr-2"></i> Holiday
                        </a>
                        @endcan
                    </div>
                </li>
                @endcan

                @can('admin', 'super-admin', 'hrcompliance')
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-users"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @can('admin', 'super-admin')
                        <a href="{{ url('users') }}" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i> User Management
                        </a>
                        @endcan
                        @can('super-admin')
                        <a href="{{ url('/user-activity') }}" class="dropdown-item">
                            <i class="fas fa-history mr-2"></i> User Logs
                        </a>
                        @endcan
                    </div>
                </li>
                @endcan

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown" id="notification-dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="notification-count">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notification-menu">
                        <span class="dropdown-item dropdown-header" id="notification-header">0 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <div id="notification-list">
                            <!-- Notifications will be dynamically inserted here -->
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('notifications.all') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                <!-- Dark Mode Toggle -->
                <li class="nav-item">
                    <a class="nav-link" id="dark-mode-toggle" href="#" role="button">
                        <i class="fas fa-moon"></i>
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-right">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="{{ asset('vendor/adminlte/dist/img/whiteLOGO4.png') }}" alt="Task List Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MHRPCI-HRIS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @can('admin', 'super-admin', 'hrcompliance')
                        <li class="nav-item">
                            <a href="{{ url('/employees') }}" class="nav-link {{ Request::is('employees*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Employee Management</p>
                            </a>
                        </li>
                        @endcan

                        @can('normal-employee')
                        <li class="nav-item">
                            <a href="{{ url('/my-tasks') }}" class="nav-link {{ Request::is('my-tasks') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>My Task</p>
                            </a>
                        </li>
                        @endcan

                        <li class="nav-item has-treeview {{ Request::is('attendances*', 'timesheets*', 'my-timesheet') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('attendances*', 'timesheets*', 'my-timesheet') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>
                                    Attendance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin', 'super-admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/attendances') }}" class="nav-link {{ Request::is('attendances*') || Request::is('timesheets*') ? 'active' : '' }}">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Attendance</p>
                                    </a>
                                </li>
                                @endcan
                                @can('normal-employee')
                                <li class="nav-item">
                                    <a href="{{ url('/my-timesheet') }}" class="nav-link {{ Request::is('my-timesheet') ? 'active' : '' }}">
                                        <i class="fas fa-user-clock nav-icon"></i>
                                        <p>My Timesheet</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/settings') }}" class="nav-link {{ Request::is('settings*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ Request::is('leaves*', 'leaves-employees*', 'my-leave-sheet*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('leaves*', 'leaves-employees*', 'my-leave-sheet*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Leave Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin', 'super-admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/leaves') }}" class="nav-link {{ Request::is('leaves*') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Leave List</p>
                                    </a>
                                </li>
                                @endcan
                                @can('normal-employee', 'super-admin')
                                <li class="nav-item">
                                    <a href="{{ url('/leaves/create') }}" class="nav-link {{ Request::is('leaves/create') ? 'active' : '' }}">
                                        <i class="fas fa-calendar-check nav-icon"></i>
                                        <p>Apply Leave</p>
                                    </a>
                                </li>
                                @endcan
                                @can('admin', 'super-admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/leaves-employees') }}" class="nav-link {{ Request::is('leaves-employees*') ? 'active' : '' }}">
                                        <i class="fas fa-file nav-icon"></i>
                                        <p>Leave Sheet</p>
                                    </a>
                                </li>
                                @endcan
                                @can('normal-employee')
                                <li class="nav-item">
                                    <a href="{{ url('/my-leave-sheet') }}" class="nav-link {{ Request::is('my-leave-sheet*') ? 'active' : '' }}">
                                        <i class="fas fa-print nav-icon"></i>
                                        <p>My Leaves</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item has-treeview {{ Request::is('payroll*', 'overtime*', 'my-payrolls*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('payroll*', 'overtime*', 'my-payrolls*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Payroll Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin', 'super-admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/payroll') }}" class="nav-link {{ Request::is('payroll*', 'overtime*') ? 'active' : '' }}">
                                        <i class="fas fa-money-bill-wave nav-icon"></i>
                                        <p>Payroll</p>
                                    </a>
                                </li>
                                @endcan
                                @can('normal-employee', 'super-admin')
                                <li class="nav-item">
                                    <a href="{{ url('/my-payrolls') }}" class="nav-link {{ Request::is('my-payrolls*') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>My Payroll</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item has-treeview {{ Request::is('contributions*', 'sss*', 'philhealth*', 'pagibig*', 'loans*', 'my-contributions*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('contributions*', 'sss*', 'philhealth*', 'pagibig*', 'loans*', 'my-contributions*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hands-helping"></i>
                                <p>
                                    Loans & Contributions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin', 'super-admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/sss') }}" class="nav-link {{ Request::is('sss*', 'philhealth*', 'pagibig*') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Contributions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/loans') }}" class="nav-link {{ Request::is('loans*') ? 'active' : '' }}">
                                        <i class="fas fa-money-bill-alt nav-icon"></i>
                                        <p>Loans</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/contributions-employees-list') }}" class="nav-link {{ Request::is('contributions-employees-list*') ? 'active' : '' }}">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Contributor</p>
                                    </a>
                                </li>
                                @endcan
                                @can('normal-employee', 'super-admin', 'admin', 'hrcomben')
                                <li class="nav-item">
                                    <a href="{{ url('/my-contributions') }}" class="nav-link {{ Request::is('my-contributions*') ? 'active' : '' }}">
                                        <i class="fas fa-solid fa-gift nav-icon"></i>
                                        <p>My Contribution</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        @can('hrhiring')
                        <li class="nav-item">
                            <a href="{{ url('/hirings') }}" class="nav-link {{ Request::is('hirings*', 'all-careers*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>Hiring Management</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin', 'super-admin', 'hrcompliance', 'it-staff', 'hrpolicy'])
                        <li class="nav-item has-treeview {{ Request::is('accountabilities*', 'credentials*', 'inventory*', 'properties*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('accountabilities*', 'credentials*', 'inventory*', 'properties*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Others
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('hrcompliance')
                                <li class="nav-item">
                                    <a href="{{ url('/accountabilities') }}" class="nav-link {{ Request::is('accountabilities*') ? 'active' : '' }}">
                                        <i class="fas fa-check-circle nav-icon"></i>
                                        <p>Employee Accountability</p>
                                    </a>
                                </li>
                                @endcan
                                @can('hrpolicy')
                                <li class="nav-item">
                                    <a href="{{ url('/credentials') }}" class="nav-link {{ Request::is('credentials*') ? 'active' : '' }}">
                                        <i class="fas fa-phone nav-icon"></i>
                                        <p>Contacts and Emails</p>
                                    </a>
                                </li>
                                @endcan
                                @can('super-admin', 'it-staff')
                                <li class="nav-item">
                                    <a href="{{ url('/inventory') }}" class="nav-link {{ Request::is('inventory*') ? 'active' : '' }}">
                                        <i class="fas fa-cubes nav-icon"></i>
                                        <p>IT Inventory</p>
                                    </a>
                                </li>
                                @endcan
                                @can('super-admin')
                                <li class="nav-item">
                                    <a href="{{ url('/properties') }}" class="nav-link {{ Request::is('properties*') ? 'active' : '' }}">
                                        <i class="fas fa-building nav-icon"></i>
                                        <p>Properties</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        <li class="nav-item">
                            <a href="{{ url('/projects') }}" class="nav-link {{ Request::is('projects*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/calendar') }}" class="nav-link {{ Request::is('calendar*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Calendar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/reports') }}" class="nav-link {{ Request::is('reports*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0"></h1>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('/home') }}">MHR Property Conglomerates, Inc</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {
            function updateNotifications() {
                $.ajax({
                    url: '{{ route("notifications.get") }}',
                    method: 'GET',
                    success: function(response) {
                        $('#notification-count').text(response.label);
                        $('#notification-header').text(response.label + ' Notifications');
                        $('#notification-list').html(response.dropdown);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching notifications:", error);
                    }
                });
            }

            // Update notifications every 60 seconds
            setInterval(updateNotifications, 60000);

            // Initial update
            updateNotifications();

            // Handle notification click to show modal
            $(document).on('click', '#notification-list a', function(e) {
                e.preventDefault();
                var title = $(this).data('title');
                var details = $(this).data('details');
                $('#notificationModalLabel').text(title);
                $('#notificationModalBody').text(details);
                $('#notificationModal').modal('show');
            });

            // Preloader
            $(window).on('load', function() {
                $('#loader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });

            // If the page takes too long to load, hide the preloader after 1 second
            setTimeout(function() {
                $('#loader').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 1000); // Changed from 5000 to 1000 milliseconds

            // Dark Mode Toggle
            function toggleDarkMode() {
                $('body').toggleClass('dark-mode');
                localStorage.setItem('darkMode', $('body').hasClass('dark-mode'));
                updateDarkModeIcon();
            }

            function updateDarkModeIcon() {
                if ($('body').hasClass('dark-mode')) {
                    $('#dark-mode-toggle i').removeClass('fa-moon').addClass('fa-sun');
                } else {
                    $('#dark-mode-toggle i').removeClass('fa-sun').addClass('fa-moon');
                }
            }

            // Check for saved dark mode preference
            if (localStorage.getItem('darkMode') === 'true') {
                $('body').addClass('dark-mode');
                updateDarkModeIcon();
            }

            // Dark mode toggle click event
            $('#dark-mode-toggle').on('click', function(e) {
                e.preventDefault();
                toggleDarkMode();
            });
        });
    </script>

    @yield('js')

</body>
</html>
