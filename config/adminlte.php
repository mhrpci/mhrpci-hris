<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'MHRPCI -HRIS',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>MHRPCI</b>-HRIS',
    'logo_img' => 'vendor/adminlte/dist/img/whiteLOGO4.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/LOGO4.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => ' ',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => false,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'Search...',
            'topnav_right' => false,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => false,
        ],
        [
            'type' => 'darkmode-widget',
            'topnav_right' => true,     // Or "topnav => true" to place on the left.
        ],
        [
            'type' => 'navbar-notification',
            'id' => 'my-notification',                // An ID attribute (required).
            'icon' => 'fas fa-bell',                  // A font awesome icon (required).
            'icon_color' => 'warning',                // The initial icon color (optional).
            'label' => 0,                             // The initial label for the badge (optional).
            'label_color' => 'danger',                // The initial badge color (optional).
            'url' => 'notifications/all',            // The url to access all notifications/elements (required).
            'topnav_right' => true,                   // Or "topnav => true" to place on the left (required).
            'dropdown_mode' => true,                  // Enables the dropdown mode (optional).
            'dropdown_flabel' => 'All notifications', // The label for the dropdown footer link (optional).
            'update_cfg' => [
                'url' => 'notifications/get',         // The url to periodically fetch new data (optional).
                'period' => 30,                       // The update period for get new data (in seconds, optional).
            ],
        ],
        
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Search...',
        ],
        [
            'text' => ' Dashboard',
            'url' => 'home',
            'icon' => 'fas fa-chart-line', 
        ],
        [
            'text' => ' Employee Management',
            'url' => 'employees',
            'icon' => 'fas fa-user-tie',
            'active' => ['employees*', 'regex'],
            'can' => 'admin', 'super-admin',

        ],
        [
            'text' => 'My Task',
            'url' => '/my-tasks',
            'icon' => 'fas fa-tasks',
            // 'active' => ['tasks*', 'regex'],
            'can' => 'normal-employee',
        ],
        [
            'text' => ' Attendance Management',
            'icon' => 'fas fa-clock',
            'submenu' => [
                [
                    'text' => 'Attendance',
                    'url' => 'attendances',
                    'icon' => 'fas fa-sign-in-alt',
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => 'Time In/ Time Out',
                    'url' => 'attendances/create',
                    'icon' => 'fas fa-clock',
                ],
                [
                    'text' => 'Timesheet',
                    'url' => '/timesheets',
                    'icon' => 'fas fa-file-alt',
                    'active' => ['/timesheets*', 'regex:/employee\/attendance\/[0-9]+/'],
                    'can' => 'admin', 'super-admin',
                ],   
                [
                    'text' => 'My Timesheet',
                    'url' => '/my-timesheet',
                    'icon' => 'fas fa-file-alt',
                    'can' => 'normal-employee',
                ],                 
            ],
        ],
        [
            'text' => ' Leave Management',
            'icon' => 'fas fa-calendar',
            'submenu' => [
                [
                    'text' => 'Leave List',
                    'url' => 'leaves',
                    'icon' => 'fas fa-list',
                    'can' => 'admin', 'super-admin',
                ],                
                [
                    'text' => 'Apply Leave',
                    'url' => 'leaves/create',
                    'icon' => 'fas fa-calendar-check',
                    'active' => ['leaves/create', 'regex'],
                    'can' => 'normal-employee', 'super-admin',
                ],
                [
                    'text' => 'Leave Sheet',
                    'url' => '/leaves-employees',
                    'icon' => 'fas fa-file',
                    'active' => ['leaves-employees', 'regex:/leaves-employees\/[0-9]+\/leaves/'],
                    'can' => ['admin', 'super-admin'],
                ],
                [
                    'text' => 'Leave Report',
                    'url' => '/leaves-report',
                    'icon' => 'fas fa-print',
                    'active' => ['leaves-report', 'regex:/leaves-report\/[0-9]+\/leaves/'],
                    'can' => ['admin', 'super-admin'],
                ],
                
            ],
        ],
        [
            'text' => ' Payroll Management',
            'icon' => 'fas fa-coins',
            'can' => 'admin', 'super-admin',
            'submenu' => [
                [
                    'text' => 'Payroll',
                    'url' => 'payroll',
                    'icon' => 'fas fa-money-bill-wave',
                    'active' => ['payroll*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Generate Pay Slip',
                    'url' => 'generate',
                    'icon' => 'fas fa-print',
                    'active' => ['generate*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
            ],
        ],
        [
            'text' => ' Contributions',
            'icon' => 'fas fa-hands-helping',
            'can' => 'admin', 'super-admin',
            'submenu' => [
                [
                    'text' => 'SSS',
                    'url' => 'sss',
                    'icon' => 'fas fa-id-card',
                    'active' => ['sss*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                // [
                //     'text' => ' TIN',
                //     'url' => 'tin',
                //     'icon' => 'fas fa-receipt',
                //     'active' => ['tin*', 'regex'],
                //     'can' => 'admin', 'super-admin',
                // ],
                [
                    'text' => ' PAGIBIG',
                    'url' => 'pagibig',
                    'icon' => 'fas fa-house-user',
                    'active' => ['pagibig*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' PHILHEALTH',
                    'url' => 'philhealth',
                    'icon' => 'fas fa-heartbeat',
                    'active' => ['philhealth*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
            ],
        ],
        [
            'text' => ' Loans and CA',
            'icon' => 'fas fa-money-bill-alt',
            'can' => 'admin', 'super-admin',
            'submenu' => [
                [
                    'text' => 'SSS Loan',
                    'url' => 'loansss',
                    'icon' => 'fas fa-id-card',
                    'active' => ['loansss*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' PAGIBIG Loan',
                    'url' => 'loanpagibig',
                    'icon' => 'fas fa-house-user',
                    'active' => ['loanpagibig*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Cash Advance',
                    'url' => 'cashad',
                    'icon' => 'fas fa-money-bill',
                    'active' => ['cashad*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
            ],
        ],
        [
            'text' => '',
            'icon' => 'fas fa-cogs',
            'topnav_right' => true,
            'can' => 'admin', 'super-admin',
            'submenu' => [
                [
                    'text' => ' Leave Type',
                    'url' => 'types',
                    'icon' => 'fas fa-folder',
                    'active' => ['types*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Announcement',
                    'url' => 'posts',
                    'icon' => 'fas fa-bullhorn',
                    'active' => ['posts*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                // [
                //     'text' => ' Birthdays',
                //     'url' => 'birthdays',
                //     'icon' => 'fas fa-birthday-cake',
                //     'active' => ['birthdays*', 'regex'],
                //     'can' => 'admin', 'super-admin',
                // ],
                [
                    'text' => 'Send Task',
                    'url' => 'tasks',
                    'icon' => 'fas fa-tasks',
                    'active' => ['tasks*', 'regex'],
                    'can' => 'admin',
                ],
                [
                    'text' => ' Holiday',
                    'url' => 'holidays',
                    'icon' => 'fas fa-calendar-alt',
                    'active' => ['holidays*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                // [
                //     'text' => ' Province',
                //     'url' => 'provinces',
                //     'icon' => 'fas fa-monument',
                //     'active' => ['provinces*', 'regex'],
                //     'can' => 'admin', 'super-admin',
                // ],
                // [
                //     'text' => ' City',
                //     'url' => 'city',
                //     'icon' => 'fas fa-city',
                //     'active' => ['city*', 'regex'],
                //     'can' => 'admin', 'super-admin',
                // ],
                // [
                //     'text' => ' Barangay',
                //     'url' => 'barangay',
                //     'icon' => 'fas fa-landmark',
                //     'active' => ['barangay*', 'regex'],
                //     'can' => 'admin', 'super-admin',
                // ],
            ],
        ],
        [
            'text' => '',
            'icon' => 'fas fa-users',
            'topnav_right' => true,
            'can' => 'admin', 'super-admin',
            'submenu' => [
                [
                    'text' => ' User',
                    'url' => 'users',
                    'icon' => 'fas fa-user',
                    'active' => ['users*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Roles and Permission',
                    'url' => 'roles',
                    'icon' => 'fas fa-lock',
                    'active' => ['roles*', 'regex'],
                    'can' => 'Super Admin'
                ],
                [
                    'text' => ' Gender',
                    'url' => 'genders',
                    'icon' => 'fas fa-venus-mars',
                    'active' => ['genders*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Position',
                    'url' => 'positions',
                    'icon' => 'fas fa-briefcase',
                    'active' => ['positions*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' Department',
                    'url' => 'departments',
                    'icon' => 'fas fa-sitemap',
                    'active' => ['departments*', 'regex'],
                    'can' => 'admin', 'super-admin',
                ],
                [
                    'text' => ' User Logs',
                    'url' => '/user-activity',
                    'icon' => 'fas fa-history',
                    'active' => ['/user-activity*', 'regex'],
                    'can' => 'super-admin',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];