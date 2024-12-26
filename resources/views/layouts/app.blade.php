<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MHR Property Conglomerates, Inc.</title>
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

.theme-option-wrapper small {
    color: #6c757d !important;
}

.theme-option-wrapper small {
    font-size: 0.75rem;
    opacity: 0.8;
}

/* Global Search Styles */
.global-search-container {
    position: relative;
    min-width: 300px;
    margin-right: 1rem;
}

.global-search {
    border-radius: 20px;
    padding-left: 1rem;
    padding-right: 1rem;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.global-search:focus {
    box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.25);
    border-color: #8e44ad;
}

.search-results-container {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 0.5rem;
    z-index: 1050;
    max-height: 500px;
    overflow-y: auto;
}

.search-results-header {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.search-results-body {
    padding: 0.5rem 0;
}

.search-results-footer {
    padding: 0.5rem 1rem;
    border-top: 1px solid #dee2e6;
    text-align: center;
}

.search-result-item {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    transition: background-color 0.2s ease;
    text-decoration: none;
    color: inherit;
}

.search-result-item:hover {
    background-color: #f8f9fa;
    text-decoration: none;
    color: inherit;
}

.search-result-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #8e44ad;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.search-result-content {
    flex: 1;
}

.search-result-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.search-result-subtitle {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.search-result-description {
    font-size: 0.875rem;
    color: #495057;
}

.search-result-type {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    background-color: #e9ecef;
    color: #495057;
    margin-left: 0.5rem;
}

/* Leave Request specific styles */
.search-result-item .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    margin-left: 0.5rem;
}

.search-result-item .badge-success {
    background-color: #28a745;
    color: white;
}

.search-result-item .badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.search-result-item .badge-danger {
    background-color: #dc3545;
    color: white;
}

.search-result-item .badge-secondary {
    background-color: #6c757d;
    color: white;
}

.search-result-meta i {
    margin-right: 0.25rem;
}

/* User Dropdown - Updated Styling */
.user-menu .dropdown-menu {
    padding: 0;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    min-width: 250px;
    margin-top: 0.5rem;
}

.user-header {
    background: linear-gradient(-45deg, #8e44ad, #9b59b6, #2ecc71, #3498db);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
    padding: 1rem;
    border-radius: 8px 8px 0 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.user-header::before,
.user-header::after {
    content: '';
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s infinite;
}

.user-header::before {
    left: 10%;
    animation-delay: -2s;
}

.user-header::after {
    right: 10%;
    animation-delay: -4s;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) scale(1);
        opacity: 0.8;
    }
    50% {
        transform: translateY(-20px) scale(1.2);
        opacity: 0.3;
    }
}

.user-header .img-circle {
    width: 60px;
    height: 60px;
    border: 2px solid rgba(255,255,255,0.9);
    padding: 0;
    margin-bottom: 0.5rem;
}

.user-header .user-info {
    color: #fff;
    text-align: center;
}

.user-header .user-name {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
    color: #fff;
}

.user-header .user-role {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.9);
    background: rgba(0,0,0,0.1);
    padding: 0.2rem 0.8rem;
    border-radius: 12px;
    display: inline-block;
}

.dropdown-menu-content {
    padding: 0.5rem 0;
}

.user-menu .dropdown-item {
    padding: 0.6rem 1.2rem;
    display: flex;
    align-items: center;
    color: #444;
    transition: all 0.2s ease;
}

.user-menu .dropdown-item:hover {
    background-color: #f8f9fa;
    color: #8e44ad;
}

.user-menu .dropdown-item i {
    width: 1.2rem;
    margin-right: 0.8rem;
    font-size: 1rem;
    color: #666;
}

.user-menu .dropdown-item:hover i {
    color: #8e44ad;
}

.user-menu .dropdown-divider {
    margin: 0.25rem 0;
    border-top: 1px solid #f1f1f1;
}

.user-menu .logout-item {
    color: #dc3545;
}

.user-menu .logout-item:hover {
    background-color: #fff5f5;
    color: #dc3545;
}

.user-menu .logout-item i {
    color: #dc3545;
}

.user-status {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #28a745;
    margin-right: 0.5rem;
    box-shadow: 0 0 0 2px rgba(255,255,255,0.8);
}

.user-role {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background-color: rgba(255,255,255,0.1);
    border-radius: 12px;
    font-size: 0.75rem;
    color: #fff;
    margin-top: 0.5rem;
}

/* Tour Guide Styles */
.shepherd-button {
    background: #8e44ad !important;
    border: none;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    margin-right: 8px;
    padding: 8px 18px;
    text-transform: uppercase;
    font-size: 0.8rem;
    transition: all 0.2s ease;
}

.shepherd-button:hover {
    background: #732d91 !important;
}

.shepherd-button.shepherd-button-secondary {
    background: #6c757d !important;
}

.shepherd-button.shepherd-button-secondary:hover {
    background: #5a6268 !important;
}

.shepherd-text {
    color: #495057;
    font-size: 1rem;
    line-height: 1.6;
    padding: 1rem;
}

.shepherd-title {
    color: #8e44ad;
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.shepherd-header {
    background: #f8f9fa;
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.shepherd-footer {
    padding: 0.5rem 1rem;
    border-top: 1px solid #dee2e6;
}

.shepherd-element {
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-width: 400px;
}

.shepherd-arrow:before {
    background: #fff !important;
}

.shepherd-enabled.shepherd-element {
    opacity: 1;
}

.shepherd-modal-overlay-container.shepherd-modal-is-visible {
    opacity: 0.5;
}
</style>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    @stack('styles')

    <!-- Initialize Select2 after jQuery is loaded -->
    <script>
        window.addEventListener('load', function() {
            if (typeof jQuery !== 'undefined') {
                // Initialize Select2 for all select elements
                $('select').select2({
                    theme: 'bootstrap4',
                    width: '100%'
                });
            }
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta name="app-env" content="{{ config('app.env') }}">
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

                @canany(['admin', 'super-admin'])
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
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notification-menu">
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
                                <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-1" alt="User Image">
                                {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                            @else
                                <div class="user-image img-circle elevation-1 d-flex justify-content-center align-items-center">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                </div>
                            @endif
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                @if(Auth::user()->adminlte_image())
                                    <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2" alt="User Image">
                                @else
                                    <div class="img-circle elevation-2 d-flex justify-content-center align-items-center mx-auto">
                                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="user-info">
                                    <div class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                    <span class="user-role">{{ Auth::user()->roles->first()->name ?? 'User' }}</span>
                                </div>
                            </div>
                            
                            <div class="dropdown-menu-content">
                                <a href="/profile/details" class="dropdown-item">
                                    <i class="fas fa-user"></i>
                                    My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-item">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
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
                    <li class="nav-item has-treeview {{ Request::is('leaves*') || Request::is('leaves-employees*') || Request::is('my-leave-sheet*') || Request::is('my-leave-detail*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('leaves*') || Request::is('leaves-employees*') || Request::is('my-leave-sheet*') || Request::is('my-leave-detail*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar"></i>
                                <p>
                                    Leave Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['admin', 'super-admin', 'hrcomben'])
                                <li class="nav-item">
                                    <a href="{{ url('/leaves') }}" class="nav-link {{ Request::is('leaves') || request()->routeIs('leaves.show*') ? 'active' : '' }}">
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
                                    <a href="{{ route('leaves.my_leave_sheet') }}" class="nav-link {{ request()->routeIs('leaves.my_leave_sheet') || request()->routeIs('leaves.myLeaveDetail') ? 'active' : '' }}">
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

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {
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
            }, 1000);

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
            text: `<h3 class="shepherd-title">Welcome to MHR Property Conglomerates HRIS! 👋</h3>
                   <p>This comprehensive tour will guide you through our system's main interface components and features.</p>`,
            buttons: [
                {
                    text: 'Skip Tour',
                    action: tour.complete,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Start Tour',
                    action: tour.next
                }
            ]
        });

        // Main Sidebar Overview
        tour.addStep({
            id: 'sidebar-overview',
            text: `<h3 class="shepherd-title">Main Navigation Sidebar</h3>
                   <p>This is your primary navigation menu, containing all essential modules and features:</p>
                   <ul>
                       <li>Dashboard - Overview of key metrics</li>
                       <li>Employee Management - Handle employee records</li>
                       <li>Attendance & Leave Management</li>
                       <li>Payroll & Benefits</li>
                       <li>And more based on your role permissions</li>
                   </ul>`,
            attachTo: {
                element: '.main-sidebar',
                on: 'right'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Brand Logo
        tour.addStep({
            id: 'brand-logo',
            text: `<h3 class="shepherd-title">Company Brand</h3>
                   <p>Click here to return to the dashboard at any time. The logo serves as your home button.</p>`,
            attachTo: {
                element: '.brand-link',
                on: 'right'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Navbar Overview
        tour.addStep({
            id: 'navbar-overview',
            text: `<h3 class="shepherd-title">Top Navigation Bar</h3>
                   <p>The top navigation bar provides quick access to important features:</p>
                   <ul>
                       <li>Menu Toggle - Collapse/Expand sidebar</li>
                       <li>Our Policies - Quick access to company policies</li>
                       <li>Global Search - Find anything quickly</li>
                       <li>Notifications - Stay updated with alerts</li>
                       <li>User Profile - Access your account settings</li>
                   </ul>`,
            attachTo: {
                element: '.main-header',
                on: 'bottom'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Menu Toggle
        tour.addStep({
            id: 'menu-toggle',
            text: `<h3 class="shepherd-title">Menu Toggle</h3>
                   <p>Click this button to collapse or expand the sidebar, giving you more workspace when needed.</p>`,
            attachTo: {
                element: '[data-widget="pushmenu"]',
                on: 'right'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Notifications - Add element check before creating step
        const notificationElement = document.querySelector('#notification-dropdown');
        if (notificationElement) {
            tour.addStep({
                id: 'notifications',
                text: `<h3 class="shepherd-title">Notifications Center</h3>
                       <p>Stay informed with real-time notifications about:</p>
                       <ul>
                           <li>Leave requests and approvals</li>
                           <li>Payroll updates</li>
                           <li>Important announcements</li>
                           <li>System updates</li>
                       </ul>`,
                attachTo: {
                    element: '#notification-dropdown',
                    on: 'bottom'
                },
                buttons: [
                    {
                        text: 'Back',
                        action: tour.back,
                        classes: 'shepherd-button-secondary'
                    },
                    {
                        text: 'Next',
                        action: tour.next
                    }
                ]
            });
        }

        // User Profile Dropdown
        tour.addStep({
            id: 'user-profile',
            text: `<h3 class="shepherd-title">User Profile Menu</h3>
                   <p>Access your personal settings and options:</p>
                   <ul>
                       <li>View and edit your profile</li>
                       <li>Change your password</li>
                       <li>Manage account settings</li>
                       <li>Sign out of the system</li>
                   </ul>`,
            attachTo: {
                element: '.user-menu',
                on: 'bottom'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Right Sidebar (Theme Customization)
        tour.addStep({
            id: 'right-sidebar',
            text: `<h3 class="shepherd-title">Theme Customization</h3>
                   <p>Personalize your interface appearance:</p>
                   <ul>
                       <li>Choose from multiple color themes</li>
                       <li>Adjust navbar position (Fixed/Static)</li>
                       <li>Customize sidebar appearance</li>
                       <li>Your preferences are saved automatically</li>
                   </ul>`,
            attachTo: {
                element: '[data-widget="control-sidebar"]',
                on: 'left'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Content Area
        tour.addStep({
            id: 'content-area',
            text: `<h3 class="shepherd-title">Main Content Area</h3>
                   <p>This is where your selected module's content will be displayed. The area adjusts automatically based on your sidebar state and screen size.</p>`,
            attachTo: {
                element: '.content-wrapper',
                on: 'left'
            },
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Next',
                    action: tour.next
                }
            ]
        });

        // Final Step
        tour.addStep({
            id: 'end',
            text: `<h3 class="shepherd-title">Tour Complete! 🎉</h3>
                   <p>You're now familiar with the main interface components. Remember:</p>
                   <ul>
                       <li>You can restart this tour anytime using the Tour Guide button</li>
                       <li>Explore each module to discover more features</li>
                       <li>Contact support if you need additional help</li>
                   </ul>`,
            buttons: [
                {
                    text: 'Back',
                    action: tour.back,
                    classes: 'shepherd-button-secondary'
                },
                {
                    text: 'Finish',
                    action: tour.complete
                }
            ]
        });

        // Start tour button - Add element check
        const startTourButton = document.getElementById('start-tour');
        if (startTourButton) {
            startTourButton.addEventListener('click', function(e) {
                e.preventDefault();
                tour.start();
            });
        }

        // Save tour progress in localStorage
        tour.on('complete', () => {
            localStorage.setItem('tourCompleted', 'true');
        });

        // Check if first-time user
        if (!localStorage.getItem('tourCompleted')) {
            // Show tour prompt for first-time users
            setTimeout(() => {
                if (confirm('Would you like to take a quick tour of the system?')) {
                    tour.start();
                }
            }, 1000);
        }
    });
    </script>

</body>
</html>
