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

    /* Right Sidebar Styles */
    .control-sidebar {
        width: 250px;
    }
    .control-sidebar-dark {
        background-color: #343a40;
    }
    .control-sidebar-content {
        padding: 1rem;
    }
    .theme-option-wrapper {
        margin-bottom: 1rem;
    }
    .theme-option-wrapper label {
        display: block;
        margin-bottom: 0.5rem;
        color: #ced4da;
        font-weight: 600;
    }
    .theme-select {
        width: 100%;
        background-color: #454d55;
        color: #fff;
        border: 1px solid #6c757d;
        border-radius: 4px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    .theme-select option {
        background-color: #454d55;
        color: #fff;
    }
    .theme-select:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(130, 138, 145, 0.5);
    }

    .theme-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
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
    /*my-contribution css*/
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
    background-color: #f4f6f9;
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
    position: relative; /* Added to ensure content overlays on top of the background */
    z-index: 1; /* Ensure content is above the overlay */
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
    bottom: 0;
    right: 0;
    width: 100px; /* Adjusted size for better visibility */
    height: auto; /* Auto height to maintain aspect ratio */
    opacity: 0.15; /* Slightly increased opacity for subtle effect */
    z-index: 0; /* Positioned behind the content */
}

.info-box-overlay img {
    width: 100%; /* Ensure the image takes the full width of the container */
    height: auto; /* Maintain aspect ratio */
}

/* Add these styles to your existing CSS */
.theme-option-wrapper .custom-switch {
    padding-left: 2.25rem;
}

.theme-option-wrapper .custom-control-label {
    padding-top: 2px;
}

.theme-option-wrapper .custom-switch .custom-control-label::before {
    width: 2rem;
    height: 1.25rem;
    border-radius: 1rem;
}

.theme-option-wrapper .custom-switch .custom-control-label::after {
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 1rem;
}

.custom-switch .custom-control-label::before {
    background-color: #6c757d;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #007bff;
}

.dark-mode-label {
    color: #ced4da;
}

.theme-option-wrapper small {
    color: #6c757d !important;
}

/* Add these styles to your existing CSS */
.theme-option-wrapper .custom-switch {
    padding-left: 2.25rem;
}

.theme-option-wrapper .custom-control-label {
    padding-top: 2px;
}

.theme-option-wrapper .custom-switch .custom-control-label::before {
    width: 2rem;
    height: 1.25rem;
    border-radius: 1rem;
}

.theme-option-wrapper .custom-switch .custom-control-label::after {
    width: calc(1.25rem - 4px);
    height: calc(1.25rem - 4px);
    border-radius: 50%;
}

.theme-option-wrapper .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
    transform: translateX(0.75rem);
}

.theme-option-wrapper small {
    font-size: 0.75rem;
    opacity: 0.8;
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    @stack('styles')

    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            $('select').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta name="vapid-key" content="{{ config('webpush.public_key') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/css/shepherd.css"/>
    <script src="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/js/shepherd.min.js"></script>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3 control-sidebar-content">
                <h5 class="text-light mb-3">Customize Theme</h5>
                <hr class="mb-2">
                <div class="theme-option-wrapper">
                    <label>Select Theme Color</label>
                    <div class="theme-options">
                        <div class="theme-option bg-primary" data-theme="primary"></div>
                        <div class="theme-option bg-secondary" data-theme="secondary"></div>
                        <div class="theme-option bg-info" data-theme="info"></div>
                        <div class="theme-option bg-success" data-theme="success"></div>
                        <div class="theme-option bg-danger" data-theme="danger"></div>
                        <div class="theme-option bg-indigo" data-theme="indigo"></div>
                        <div class="theme-option bg-purple" data-theme="purple"></div>
                        <div class="theme-option bg-pink" data-theme="pink"></div>
                        <div class="theme-option bg-navy" data-theme="navy"></div>
                        <div class="theme-option bg-lightblue" data-theme="lightblue"></div>
                        <div class="theme-option bg-teal" data-theme="teal"></div>
                        <div class="theme-option bg-cyan" data-theme="cyan"></div>
                        <div class="theme-option bg-dark" data-theme="dark"></div>
                        <div class="theme-option bg-gray-dark" data-theme="gray-dark"></div>
                        <div class="theme-option bg-gray" data-theme="gray"></div>
                    </div>
                </div>
                 <!-- New navbar position options -->
                <div class="navbar-position-wrapper mb-4">
                    <label for="navbar-position-select" class="d-block mb-2">Navbar Position</label>
                    <select id="navbar-position-select" class="form-control bg-dark text-light border-secondary">
                        <option value="static">Static (Default)</option>
                        <option value="fixed">Fixed Top</option>
                        <option value="sticky">Sticky Top</option>
                    </select>
                </div>
                <div class="theme-option-wrapper mb-4">
                    <label class="d-block mb-2 text-light">Dark Mode</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="dark-mode-toggle">
                        <label class="custom-control-label text-light" for="dark-mode-toggle">
                            <span class="dark-mode-label">Light Mode</span>
                        </label>
                    </div>
                    <small class="text-muted d-block mt-1">
                        Toggle between light and dark theme
                    </small>
                </div>
            </div>
        </aside>
        <!-- /.control-sidebar -->

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
                <!-- Our Policies link with larger text and icon -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/policies-page') }}" class="nav-link" style="font-size: 1.2rem; font-weight: 200;">
                        <i class="fas fa-file-alt mr-2"></i> Our Policies
                    </a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/calendar') }}" class="nav-link" style="font-size: 1.2rem; font-weight: 200;">
                        <i class="fas fa-calendar"></i> Our Calendar
                    </a>
                </li> --}}
                <!-- Add more nav items here -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Tour Guide Button -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="start-tour" role="button">
                        <i class="fas fa-question-circle"></i>
                        <span class="d-none d-sm-inline-block ml-1">Tour Guide</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-cogs"></i>
                    </a>
                </li>
                @canany(['admin', 'super-admin', 'hrcomben', 'hrcompliance', 'hrpolicy'])
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-bullhorn"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @canany(['admin', 'super-admin'])
                        <a href="{{ url('types') }}" class="dropdown-item">
                            <i class="fas fa-folder mr-2"></i> Leave Type
                        </a>
                        @endcanany
                        @canany(['admin', 'super-admin', 'hrcompliance', 'hrpolicy'])
                        <a href="{{ url('posts') }}" class="dropdown-item">
                            <i class="fas fa-bullhorn mr-2"></i> Announcement
                        </a>
                        @endcanany
                        @can('admin')
                        <a href="{{ url('tasks') }}" class="dropdown-item">
                            <i class="fas fa-tasks mr-2"></i> Send Task
                        </a>
                        @endcan
                        @canany(['admin', 'super-admin', 'hrcomben'])
                        <a href="{{ url('holidays') }}" class="dropdown-item">
                            <i class="fas fa-calendar-alt mr-2"></i> Holiday
                        </a>
                        @endcanany
                    </div>
                </li>
                @endcanany

                @canany(['admin', 'super-admin', 'hrcompliance'])
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-users"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @canany(['admin', 'super-admin'])
                        <a href="{{ url('users') }}" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i> User Management
                        </a>
                        @endcanany
                        @can('super-admin')
                        <a href="{{ url('/user-activity') }}" class="dropdown-item">
                            <i class="fas fa-history mr-2"></i> User Logs
                        </a>
                        @endcan
                    </div>
                </li>
                @endcanany

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown" id="notification-dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="notification-count">0</span>
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
                            @if(Auth::user()->adminlte_image())
                                <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-2" alt="User Image">
                            @else
                                <div class="user-image img-circle elevation-2 d-flex justify-content-center align-items-center" style="width: 2.1rem; height: 2.1rem; background-color: #007bff; color: white; font-size: 0.8rem;">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                @if(Auth::user()->adminlte_image())
                                    <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2" alt="User Image">
                                @else
                                    <div class="img-circle elevation-2 d-flex justify-content-center align-items-center mx-auto" style="width: 90px; height: 90px; background-color: #007bff; color: white; font-size: 2rem;">
                                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <p>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    <small>Member since {{ Auth::user()->date_hired ?? Auth::user()->created_at->format('F d, Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="/profile/details" class="btn btn-default btn-flat">Profile</a>
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

                        @canany(['admin', 'super-admin', 'hrcompliance','finance'])
                        <li class="nav-item">
                            <a href="{{ url('/employees') }}" class="nav-link {{ Request::is('employees*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Employee Management</p>
                            </a>
                        </li>
                        @endcanany

                        @auth
                            @if(auth()->user()->hasRole('Employee'))
                        <li class="nav-item">
                            <a href="{{ url('/my-tasks') }}" class="nav-link {{ Request::is('my-tasks') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>My Task</p>
                            </a>
                        </li>
                        @endif
                      @endauth
                        @canany(['admin', 'super-admin', 'hrcomben', 'normal-employee'])
                        <li class="nav-item has-treeview {{ Request::is('attendances*', 'timesheets*', 'my-timesheet') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('attendances*', 'timesheets*', 'my-timesheet') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>
                                    Attendance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            @canany(['admin', 'super-admin', 'hrcomben'])
                                <li class="nav-item">
                                    <a href="{{ url('/attendances') }}" class="nav-link {{ Request::is('attendances*') || Request::is('timesheets*') ? 'active' : '' }}">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Attendance</p>
                                    </a>
                                </li>
                                @endcanany
                                @auth
                                    @if(auth()->user()->hasRole('Employee'))
                                <li class="nav-item">
                                    <a href="{{ url('/my-timesheet') }}" class="nav-link {{ Request::is('my-timesheet') ? 'active' : '' }}">
                                        <i class="fas fa-user-clock nav-icon"></i>
                                        <p>My Timesheet</p>
                                    </a>
                                </li>
                                @endif
                                @endauth
                            </ul>
                        </li>
                    @endcanany
                    @canany(['admin', 'super-admin', 'hrcomben','normal-employee'])
                        <li class="nav-item has-treeview {{ Request::is('leaves*', 'leaves-employees*', 'my-leave-sheet*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('leaves*', 'leaves-employees*', 'my-leave-sheet*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Leave Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['admin', 'super-admin', 'hrcomben'])
                                <li class="nav-item">
                                    <a href="{{ url('/leaves') }}" class="nav-link {{ Request::is('leaves') || Request::is('leaves/[0-9]*') ? 'active' : '' }}">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Leave List</p>
                                    </a>
                                </li>
                                @endcanany
                                @auth
                                    @if(auth()->user()->hasRole('Employee'))
                                <li class="nav-item">
                                    <a href="{{ url('/leaves/create') }}" class="nav-link {{ Request::is('leaves/create') ? 'active' : '' }}">
                                        <i class="fas fa-calendar-check nav-icon"></i>
                                        <p>Apply Leave</p>
                                    </a>
                                </li>
                                @endif
                                @endauth
                                @canany(['admin', 'super-admin', 'hrcomben'])
                                <li class="nav-item">
                                    <a href="{{ url('/leaves-employees') }}" class="nav-link {{ Request::is('leaves-employees*') ? 'active' : '' }}">
                                        <i class="fas fa-file nav-icon"></i>
                                        <p>Leave Sheet</p>
                                    </a>
                                </li>
                                @endcanany
                                @auth
                                    @if(auth()->user()->hasRole('Employee'))
                                <li class="nav-item">
                                    <a href="{{ url('/my-leave-sheet') }}" class="nav-link {{ Request::is('my-leave-sheet*') ? 'active' : '' }}">
                                        <i class="fas fa-print nav-icon"></i>
                                        <p>My Leaves</p>
                                    </a>
                                </li>
                                @endif
                                @endauth
                            </ul>
                        </li>
                        @endcanany
                        @canany(['admin', 'super-admin', 'hrcomben','finance','normal-employee'])
                        <li class="nav-item has-treeview {{ Request::is('payroll*', 'overtime*', 'my-payrolls*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('payroll*', 'overtime*', 'my-payrolls*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Payroll Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['admin', 'super-admin','hrcomben','finance'])
                                <li class="nav-item">
                                    <a href="{{ url('/payroll') }}" class="nav-link {{ Request::is('payroll*', 'overtime*') ? 'active' : '' }}">
                                        <i class="fas fa-money-bill-wave nav-icon"></i>
                                        <p>Payroll</p>
                                    </a>
                                </li>
                                @endcanany
                                @auth
                                    @if(auth()->user()->hasRole('Employee'))
                                <li class="nav-item">
                                    <a href="{{ url('/my-payrolls') }}" class="nav-link {{ Request::is('my-payrolls*') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>My Payroll</p>
                                    </a>
                                </li>
                                @endif
                                @endauth
                            </ul>
                        </li>
                        @endcanany
                        @canany(['admin', 'super-admin', 'hrcomben', 'finance', 'normal-employee'])
                        <li class="nav-item has-treeview {{ Request::is('sss*', 'philhealth*', 'pagibig*', 'loan_sss*','loan_pagibig*', 'cash_advances*', 'my-contributions*', 'my-loans*', 'contributions-employees-list*', 'loans-employees-list*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('sss*', 'philhealth*', 'pagibig*', 'loan_sss*', 'loan_pagibig*', 'cash_advances*', 'my-contributions*', 'my-loans*', 'contributions-employees-list*', 'loans-employees-list*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hands-helping"></i>
                                <p>
                                    Loans & Contributions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['admin', 'super-admin', 'hrcomben', 'finance'])
                                <li class="nav-item">
                                    <a href="{{ url('/sss') }}" class="nav-link {{ Request::is('sss*', 'philhealth*', 'pagibig*','contributions-employees-list') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Contributions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/loan_sss') }}" class="nav-link {{ Request::is('loan_sss*','loan_pagibig*', 'cash_advances*', 'loans-employees-list*') ? 'active' : '' }}">
                                        <i class="fas fa-money-bill-alt nav-icon"></i>
                                        <p>Loans</p>
                                    </a>
                                </li>
                                @endcanany
                                @auth
                                    @if(auth()->user()->hasRole('Employee'))
                                    <li class="nav-item">
                                        <a href="{{ route('cash_advances.create') }}" class="nav-link {{ Request::is('cash_advances/create') ? 'active' : '' }}">
                                            <i class="fas fa-money-bill-wave nav-icon"></i>
                                            <p>Apply Company Loan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/my-contributions') }}" class="nav-link {{ Request::is('my-contributions*') ? 'active' : '' }}">
                                            <i class="fas fa-solid fa-gift nav-icon"></i>
                                            <p>My Contribution</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/my-loans') }}" class="nav-link {{ Request::is('my-loans*') || Request::is('cash_advances/*/ledger') ? 'active' : '' }}">
                                            <i class="fas fa-hand-holding-usd nav-icon"></i>
                                            <p>My Loan</p>
                                        </a>
                                    </li>
                                    @endif
                                @endauth
                            </ul>
                        </li>
                        @endcanany
                        @can('hrhiring')
                        <li class="nav-item">
                            <a href="{{ url('/hirings') }}" class="nav-link {{ Request::is('hirings*', 'all-careers*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>Hiring Management</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin', 'super-admin', 'hrcompliance', 'it-staff', 'hrpolicy'])
                        <li class="nav-item has-treeview {{ Request::is('accountabilities*', 'credentials*', 'inventory*', 'properties*', 'policies*', 'subsidiaries*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('accountabilities*', 'credentials*', 'inventory*', 'properties*', 'policies*', 'subsidiaries*') ? 'active' : '' }}">
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
                                @canany(['hrcompliance', 'it-staff'])
                                <li class="nav-item">
                                    <a href="{{ url('/inventory') }}" class="nav-link {{ Request::is('inventory*') ? 'active' : '' }}">
                                        <i class="fas fa-cubes nav-icon"></i>
                                        <p>Inventory</p>
                                    </a>
                                </li>
                                @endcanany
                                @canany(['admin', 'super-admin', 'hrpolicy'])
                                <li class="nav-item">
                                    <a href="{{ route('policies.index') }}" class="nav-link {{ Request::is('policies*') ? 'active' : '' }}">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Company Policy</p>
                                    </a>
                                </li>
                                @endcanany
                            </ul>
                        </li>
                        @endcanany
                        @auth
                            @if(auth()->user()->hasRole('Employee'))
                        <li class="nav-item">
                            <a href="{{ url('/my-profile') }}" class="nav-link {{ Request::is('my-profile*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        @endif
                        @endauth
                        <li class="nav-item">
                            <a href="{{ url('/birthdays') }}" class="nav-link {{ Request::is('birthdays*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-birthday-cake"></i>
                                <p>Birthdays</p>
                            </a>
                        </li>
                        @can('super-admin')
                        <li class="nav-item">
                            <a href="{{ url('/backups') }}" class="nav-link {{ Request::is('backups*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Backups</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/generators') }}" class="nav-link {{ Request::is('generators*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>Generators</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ url('/calendar') }}" class="nav-link {{ Request::is('calendar*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Calendar</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('/reports') }}" class="nav-link {{ Request::is('reports*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('controller.analysis') }}" class="nav-link {{ request()->routeIs('controller.analysis*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>System Routes Reports</p>
                            </a>
                        </li>
                    </ul>
                    @endcanany
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
                const isDarkMode = $('#dark-mode-toggle').prop('checked');
                $('body').toggleClass('dark-mode', isDarkMode);
                localStorage.setItem('darkMode', isDarkMode);
                updateDarkModeLabel(isDarkMode);
            }

            function updateDarkModeLabel(isDarkMode) {
                $('.dark-mode-label').text(isDarkMode ? 'Dark Mode' : 'Light Mode');

                // Update icon in the control sidebar if needed
                const $icon = $('#dark-mode-toggle').closest('.custom-switch').find('i');
                if ($icon.length) {
                    $icon.removeClass('fa-sun fa-moon').addClass(isDarkMode ? 'fa-moon' : 'fa-sun');
                }
            }

            // Initialize dark mode on page load
            $(document).ready(function() {
                // Check for saved dark mode preference
                const savedDarkMode = localStorage.getItem('darkMode') === 'true';

                // Set initial state of the toggle
                $('#dark-mode-toggle').prop('checked', savedDarkMode);

                // Apply dark mode if it was saved
                if (savedDarkMode) {
                    $('body').addClass('dark-mode');
                }

                // Update the label
                updateDarkModeLabel(savedDarkMode);

                // Dark mode toggle change event
                $('#dark-mode-toggle').on('change', function() {
                    toggleDarkMode();
                });
            });

            // Theme customization
            function applyTheme(navbarClass, sidebarClass, brandClass) {
                // Apply navbar theme
                $('.main-header').attr('class', 'main-header navbar navbar-expand ' + navbarClass);

                // Apply sidebar theme
                $('.main-sidebar').attr('class', 'main-sidebar ' + sidebarClass);

                // Apply brand theme
                $('.brand-link').attr('class', 'brand-link ' + brandClass);

                // Update active links color in sidebar
                $('.nav-sidebar .nav-link.active').css('background-color', getComputedStyle(document.documentElement).getPropertyValue('--' + sidebarClass.split('-')[2] + '-color'));

                // Update navbar text and icon colors
                updateNavbarColors(navbarClass);

                // Save theme preferences
                localStorage.setItem('navbarVariant', navbarClass);
                localStorage.setItem('sidebarVariant', sidebarClass);
                localStorage.setItem('brandVariant', brandClass);

                // Update select values
                $('#theme-select').val(navbarClass.split('-')[1]);
            }

            // Function to update navbar text and icon colors
            function updateNavbarColors(navbarClass) {
                var isDark = navbarClass.includes('navbar-dark');
                var textColor = isDark ? '#ffffff' : '#000000';
                var iconColor = isDark ? '#ffffff' : '#000000';

                $('.main-header .nav-link').css('color', textColor);
                $('.main-header .nav-link i').css('color', iconColor);

                // Adjust dropdown text colors
                $('.main-header .dropdown-menu a').css('color', '#212529');

                // Adjust navbar brand text color
                $('.main-header .navbar-brand').css('color', textColor);
            }

            // Theme change event handler
            $('.theme-option').on('click', function() {
                var selectedTheme = $(this).data('theme');
                var navbarClass = 'navbar-' + selectedTheme + ' ' + (isLightColor(selectedTheme) ? 'navbar-light' : 'navbar-dark');
                var sidebarClass = 'sidebar-dark-' + selectedTheme;
                var brandClass = 'bg-' + selectedTheme;

                applyTheme(navbarClass, sidebarClass, brandClass);

                // Update active state
                $('.theme-option').removeClass('active');
                $(this).addClass('active');
            });

            // Function to determine if a color is light
            function isLightColor(color) {
                var lightColors = ['light', 'warning', 'white', 'orange', 'lime', 'teal', 'cyan'];
                return lightColors.includes(color);
            }

            // Load saved theme
            function loadSavedTheme() {
                var navbarVariant = localStorage.getItem('navbarVariant') || 'navbar-dark navbar-primary';
                var sidebarVariant = localStorage.getItem('sidebarVariant') || 'sidebar-dark-primary';
                var brandVariant = localStorage.getItem('brandVariant') || 'bg-primary';

                applyTheme(navbarVariant, sidebarVariant, brandVariant);

                // Set active state on the correct theme option
                var activeTheme = navbarVariant.split('-')[2] || 'primary';
                $('.theme-option[data-theme="' + activeTheme + '"]').addClass('active');
            }

            // Call this function on page load
            loadSavedTheme();

             // Navbar Position Functionality
    function applyNavbarPosition(position) {
        const $body = $('body');
        const $navbar = $('.main-header');

        // Remove existing classes
        $body.removeClass('layout-navbar-fixed layout-navbar-not-fixed');
        $navbar.removeClass('fixed-top sticky-top');

        switch (position) {
            case 'fixed':
                $body.addClass('layout-navbar-fixed');
                $navbar.addClass('fixed-top');
                break;
            case 'sticky':
                $navbar.addClass('sticky-top');
                break;
            default: // 'static'
                $body.addClass('layout-navbar-not-fixed');
                break;
        }

        // Save preference
        localStorage.setItem('navbarPosition', position);
    }

    // Navbar position change event handler
    $('#navbar-position-select').on('change', function() {
        const selectedPosition = $(this).val();
        applyNavbarPosition(selectedPosition);
    });

    // Load saved navbar position
    function loadSavedNavbarPosition() {
        const savedPosition = localStorage.getItem('navbarPosition') || 'static';
        $('#navbar-position-select').val(savedPosition);
        applyNavbarPosition(savedPosition);
    }

    // Call this function on page load
    loadSavedNavbarPosition();
        });
    </script>

    @yield('js')

    <script src="{{ asset('js/push-notifications.js') }}"></script>

    <script>
    // Initialize notification system
    document.addEventListener('DOMContentLoaded', function() {
        class NotificationHandler {
            constructor() {
                this.button = null;
                this.init();
            }

            async init() {
                if (!('Notification' in window)) {
                    console.log('This browser does not support notifications');
                    return;
                }

                this.createButton();
                this.updateButtonState(Notification.permission);

                if (Notification.permission === 'granted') {
                    await this.initializeServiceWorker();
                }
            }

            createButton() {
                this.button = document.createElement('button');
                this.button.id = 'notification-button';
                this.button.className = 'btn position-fixed';
                this.button.style.cssText = 'bottom: 20px; right: 20px; z-index: 1050; border-radius: 20px; padding: 10px 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);';
                this.button.addEventListener('click', () => this.requestPermission());
                document.body.appendChild(this.button);
            }

            updateButtonState(permission) {
                if (permission === 'granted') {
                    this.button.className = 'btn btn-success position-fixed';
                    this.button.innerHTML = '<i class="fas fa-bell"></i> Notifications Enabled';
                } else {
                    this.button.className = 'btn btn-primary position-fixed';
                    this.button.innerHTML = '<i class="fas fa-bell"></i> Enable Notifications';
                }
            }

            async requestPermission() {
                try {
                    const permission = await Notification.requestPermission();
                    this.updateButtonState(permission);

                    if (permission === 'granted') {
                        await this.initializeServiceWorker();
                        // Show test notification
                        new Notification('Notifications Enabled', {
                            body: 'You will now receive notifications from our system',
                            icon: '/favicon.ico'
                        });
                    }
                } catch (error) {
                    console.error('Error requesting permission:', error);
                }
            }

            async initializeServiceWorker() {
                if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
                    console.error('Push notifications not supported');
                    return;
                }

                try {
                    const registration = await navigator.serviceWorker.register('/service-worker.js');
                    console.log('ServiceWorker registered');

                    const subscription = await registration.pushManager.getSubscription();
                    if (subscription) {
                        console.log('Already subscribed to push notifications');
                        return;
                    }

                    const vapidPublicKey = document.querySelector('meta[name="vapid-key"]').content;
                    if (!vapidPublicKey) {
                        console.error('VAPID public key not found');
                        return;
                    }

                    const convertedVapidKey = this.urlBase64ToUint8Array(vapidPublicKey);
                    const newSubscription = await registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: convertedVapidKey
                    });

                    await this.sendSubscriptionToServer(newSubscription);
                    console.log('Push notification subscription successful');
                } catch (error) {
                    console.error('Error initializing push notifications:', error);
                }
            }

            async sendSubscriptionToServer(subscription) {
                try {
                    const response = await fetch('/push/subscribe', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(subscription)
                    });

                    const data = await response.json();
                    console.log('Subscription sent to server:', data);
                } catch (error) {
                    console.error('Error sending subscription to server:', error);
                }
            }

            urlBase64ToUint8Array(base64String) {
                const padding = '='.repeat((4 - base64String.length % 4) % 4);
                const base64 = (base64String + padding)
                    .replace(/\-/g, '+')
                    .replace(/_/g, '/');

                const rawData = window.atob(base64);
                const outputArray = new Uint8Array(rawData.length);

                for (let i = 0; i < rawData.length; ++i) {
                    outputArray[i] = rawData.charCodeAt(i);
                }
                return outputArray;
            }
        }

        // Initialize the notification handler
        new NotificationHandler();
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tour = new Shepherd.Tour({
            useModalOverlay: true,
            defaultStepOptions: {
                classes: 'shadow-md bg-purple-dark',
                scrollTo: true,
                cancelIcon: {
                    enabled: true
                }
            }
        });

        // Welcome Step
        tour.addStep({
            id: 'welcome',
            text: `<div class="tour-content">
                <h3 class="tour-title">Welcome to MHRPCI-HRIS! 👋</h3>
                <p>Welcome to your personalized Human Resource Information System. This guided tour will walk you through:</p>
                <ul>
                    <li>Navigation and basic controls</li>
                    <li>Key features and functionalities</li>
                    <li>Important tools and shortcuts</li>
                    <li>Personalization options</li>
                </ul>
                <p class="mt-2"><strong>Note:</strong> You can restart this tour anytime using the Tour Guide button in the top menu.</p>
            </div>`,
            attachTo: {
                element: '.wrapper',
                on: 'center'
            },
            buttons: [
                {
                    text: 'Skip Tour',
                    action: tour.cancel,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Start Tour',
                    action: tour.next
                }
            ]
        });

        // Navigation Controls
        tour.addStep({
            id: 'navigation-controls',
            text: `<div class="tour-content">
                <h3 class="tour-title">Navigation Controls</h3>
                <p>The top navigation bar contains several important controls:</p>
                <ul>
                    <li><strong>Menu Toggle</strong> <i class="fas fa-bars"></i> - Collapse/expand the sidebar</li>
                    <li><strong>Policies</strong> <i class="fas fa-file-alt"></i> - Access company policies</li>
                    <li><strong>Tour Guide</strong> <i class="fas fa-question-circle"></i> - Restart this tour</li>
                    <li><strong>Theme Settings</strong> <i class="fas fa-cogs"></i> - Customize appearance</li>
                </ul>
            </div>`,
            attachTo: {
                element: '.main-header',
                on: 'bottom'
            },
            buttons: getNavigationButtons()
        });

        // Sidebar Navigation
        tour.addStep({
            id: 'sidebar-navigation',
            text: `<div class="tour-content">
                <h3 class="tour-title">Main Navigation Menu</h3>
                <p>The sidebar contains all main features grouped by category:</p>
                <ul>
                    <li><strong>Dashboard</strong> - Overview and quick access</li>
                    <li><strong>Employee Management</strong> - Personnel records and data</li>
                    <li><strong>Attendance</strong> - Time tracking and records</li>
                    <li><strong>Leave Management</strong> - Leave requests and balances</li>
                    <li><strong>Payroll</strong> - Salary and compensation</li>
                </ul>
                <p class="mt-2"><strong>Tip:</strong> Menu items with arrows <i class="fas fa-angle-left"></i> contain sub-menus.</p>
            </div>`,
            attachTo: {
                element: '.main-sidebar',
                on: 'right'
            },
            buttons: getNavigationButtons()
        });

        // Notifications Center
        tour.addStep({
            id: 'notifications',
            text: `<div class="tour-content">
                <h3 class="tour-title">Notifications Center</h3>
                <p>Stay updated with real-time notifications about:</p>
                <ul>
                    <li><strong>Leave Requests</strong> - Approvals and updates</li>
                    <li><strong>Tasks</strong> - New assignments and deadlines</li>
                    <li><strong>Announcements</strong> - Company news and updates</li>
                    <li><strong>System Alerts</strong> - Important reminders</li>
                </ul>
                <p class="mt-2"><strong>Tip:</strong> Click the bell icon <i class="far fa-bell"></i> to view all notifications.</p>
            </div>`,
            attachTo: {
                element: '#notification-dropdown',
                on: 'bottom'
            },
            buttons: getNavigationButtons()
        });

        // User Profile & Settings
        tour.addStep({
            id: 'user-profile',
            text: `<div class="tour-content">
                <h3 class="tour-title">Your Profile & Account</h3>
                <p>Manage your personal account settings:</p>
                <ul>
                    <li><strong>Profile</strong> - View and update your information</li>
                    <li><strong>Settings</strong> - Customize your preferences</li>
                    <li><strong>Security</strong> - Change password and security options</li>
                    <li><strong>Sign Out</strong> - Securely log out of the system</li>
                </ul>
                <p class="mt-2"><strong>Note:</strong> Keep your profile information up to date!</p>
            </div>`,
            attachTo: {
                element: '.user-menu',
                on: 'bottom'
            },
            buttons: getNavigationButtons()
        });

        // Theme Customization
        tour.addStep({
            id: 'theme-settings',
            text: `<div class="tour-content">
                <h3 class="tour-title">Personalize Your Experience</h3>
                <p>Click the gear icon <i class="fas fa-cogs"></i> to customize:</p>
                <ul>
                    <li><strong>Color Themes</strong> - Choose from multiple color schemes</li>
                    <li><strong>Navigation Style</strong> - Adjust menu positioning</li>
                    <li><strong>Dark/Light Mode</strong> - Toggle display mode</li>
                    <li><strong>Layout Options</strong> - Customize the interface layout</li>
                </ul>
                <p class="mt-2"><strong>Tip:</strong> Your settings are saved automatically!</p>
            </div>`,
            attachTo: {
                element: '[data-widget="control-sidebar"]',
                on: 'left'
            },
            buttons: getNavigationButtons()
        });

        // Notifications Button
        tour.addStep({
            id: 'notifications-button',
            text: `<div class="tour-content">
                <h3 class="tour-title">Enable Push Notifications</h3>
                <p>Stay informed with real-time push notifications:</p>
                <ul>
                    <li><strong>Important Updates</strong> - Never miss critical announcements</li>
                    <li><strong>Task Reminders</strong> - Get notified of pending tasks</li>
                    <li><strong>Leave Status</strong> - Receive updates on leave requests</li>
                    <li><strong>System Alerts</strong> - Stay informed of system changes</li>
                </ul>
                <p class="mt-2"><strong>Tip:</strong> Click the "Enable Notifications" button to activate browser notifications!</p>
            </div>`,
            attachTo: {
                element: '#notification-button',
                on: 'top'
            },
            buttons: getNavigationButtons()
        });

        // Tour End
        tour.addStep({
            id: 'tour-end',
            text: `<div class="tour-content">
                <h3 class="tour-title">You're All Set! 🎉</h3>
                <p>You've completed the tour of MHRPCI-HRIS!</p>
                <p>Remember:</p>
                <ul>
                    <li>You can restart this tour anytime using the Tour Guide button</li>
                    <li>Explore each section to familiarize yourself with the features</li>
                    <li>Contact IT support if you need additional assistance</li>
                </ul>
                <p>Thank you for using MHRPCI-HRIS!</p>
            </div>`,
            attachTo: {
                element: '.wrapper',
                on: 'center'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back
                },
                {
                    text: 'Finish',
                    action: tour.complete,
                    classes: 'shepherd-button-primary'
                }
            ]
        });

        // Helper function for navigation buttons
        function getNavigationButtons() {
            return [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ];
        }

        // Enhanced tour styles
        const style = document.createElement('style');
        style.textContent = `
            .tour-content {
                padding: 1rem;
            }
            .tour-title {
                color: #8e44ad;
                font-size: 1.25rem;
                font-weight: 600;
                margin-bottom: 1rem;
                border-bottom: 2px solid #8e44ad;
                padding-bottom: 0.5rem;
            }
            .shepherd-content {
                border-radius: 8px !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .shepherd-text {
                font-size: 14px;
                padding: 0;
            }
            .shepherd-text ul {
                margin: 0.5rem 0;
                padding-left: 1.5rem;
            }
            .shepherd-text li {
                margin: 0.25rem 0;
            }
            .shepherd-footer {
                padding: 0.75rem;
                border-top: 1px solid rgba(0,0,0,0.1);
                display: flex;
                justify-content: flex-end;
            }
            .shepherd-button {
                margin: 0.25rem;
                padding: 0.5rem 1rem;
                border-radius: 4px;
                font-weight: 500;
                transition: all 0.3s ease;
            }
            .shepherd-button-primary {
                background-color: #8e44ad;
                color: white;
            }
            .shepherd-button-secondary {
                background-color: #6c757d;
                color: white;
            }
            .shepherd-button:hover {
                transform: translateY(-1px);
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .shepherd-cancel-icon {
                color: rgba(0,0,0,0.5);
                transition: color 0.3s ease;
            }
            .shepherd-cancel-icon:hover {
                color: rgba(0,0,0,0.8);
            }
        `;
        document.head.appendChild(style);

        // Start tour button click handler
        document.getElementById('start-tour').addEventListener('click', function(e) {
            e.preventDefault();
            tour.start();
        });
    });
    </script>

</body>
</html>
