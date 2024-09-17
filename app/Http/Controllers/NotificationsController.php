<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Task; // Assuming you have a Task model
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    // Initialize notification counts for each category
    private $notifications = [
        'birthdays' => [],
        'posts' => [],
        'holidays' => [],
        'leave_requests' => [],
        'tasks' => [],
        'job_applications' => [] // Add job applications to the notifications array
    ];

    // Method to fetch notifications data
    public function getNotificationsData(Request $request)
    {
        // Generate notifications and update counts
        $this->generateNotifications();

        // Get the total number of notifications
        $totalNotifications = $this->countTotalNotifications();
        // Generate HTML for dropdown notifications
        $dropdownHtml = $this->generateDropdownHtml();

        return [
            'label' => $totalNotifications,
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];
    }

    // Generate all types of notifications
    private function generateNotifications()
    {
        // Generate notifications for each category
        $this->generateBirthdayNotifications();
        $this->generatePostNotifications();
        $this->generateHolidayNotifications();
        $this->generateLeaveRequestNotifications();
        $this->generateTaskNotifications();
        $this->generateJobApplicationNotifications(); // Add job application notifications generation
    }

    // Generate birthday notifications
    private function generateBirthdayNotifications()
    {
        $today = Carbon::today();
        $authUserEmail = Auth::user()->email;

        // Fetch employees with birthdays today
        $todaysBirthdays = Employee::whereMonth('birth_date', $today->month)
            ->whereDay('birth_date', $today->day)
            ->get();

        foreach ($todaysBirthdays as $employee) {
            $notification = [
                'icon' => 'fas fa-fw fa-birthday-cake text-warning',
                'text' => $authUserEmail == $employee->email_address
                    ? "Today is your birthday! Happy Birthday!"
                    : "Today is {$employee->first_name} {$employee->last_name}'s birthday!",
                'time' => 'Today',
                'details' => "Birthday celebration for {$employee->first_name} {$employee->last_name}"
            ];

            $this->notifications['birthdays'][] = $notification;
        }
    }

    private function generatePostNotifications()
    {
        $last24Hours = Carbon::now()->subDay();
        $latestPosts = Post::with('user')
            ->where('created_at', '>=', $last24Hours)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($latestPosts as $post) {
            $notification = [
                'icon' => 'fas fa-fw fa-bullhorn',
                'text' => "{$post->user->first_name} {$post->user->last_name} posted: {$post->title}", // Add title
                'time' => $post->created_at->diffForHumans(),
                'details' => "Post details: {$post->content}" // Add details
            ];
            $this->notifications['posts'][] = $notification;
        }
    }

    private function generateHolidayNotifications()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $holidays = Holiday::orderBy('date', 'asc')->get();

        // Check for today's holidays
        $todaysHoliday = $holidays->firstWhere('date', $today->format('Y-m-d'));
        if ($todaysHoliday) {
            $notification = [
                'icon' => 'fas fa-fw fa-calendar-day',
                'text' => "Today is {$todaysHoliday->name}",
                'time' => 'Today',
                'details' => "Holiday details: {$todaysHoliday->description}" // Add details
            ];
            $this->notifications['holidays'][] = $notification;
        }

        // Check for tomorrow's holidays
        $tomorrowsHolidays = $holidays->where('date', $tomorrow->format('Y-m-d'));
        foreach ($tomorrowsHolidays as $holiday) {
            $notification = [
                'icon' => 'fas fa-fw fa-calendar-day',
                'text' => "Tomorrow is {$holiday->name}",
                'time' => 'Tomorrow',
                'details' => "Holiday details: {$holiday->description}" // Add details
            ];
            $this->notifications['holidays'][] = $notification;
        }
    }

    private function generateLeaveRequestNotifications()
    {
        if (Auth::user()->hasRole(['Super Admin', 'Admin'])) {
            $pendingLeaves = Leave::with('employee')
                ->where('status', 'pending')
                ->where('is_read', false)  // Only fetch unread leave requests
                ->get();
            foreach ($pendingLeaves as $leave) {
                $notification = [
                    'icon' => 'fas fa-fw fa-calendar-times',
                    'text' => "{$leave->employee->first_name} {$leave->employee->last_name} requested leave",
                    'time' => $leave->created_at->diffForHumans(),
                    'details' => "Leave details: {$leave->reason}"
                ];
                $this->notifications['leave_requests'][] = $notification;
            }
        }
    }

    // Generate task notifications for employees and admins
    private function generateTaskNotifications()
    {
        $authUser = Auth::user();
        $employee = Employee::where('email_address', $authUser->email)->first();

        if ($authUser->hasRole('Employee') && $employee) {
            $tasks = Task::where('employee_id', $employee->id)
                         ->where('status', 'pending')
                         ->where('is_read', false)  // Only fetch unread tasks
                         ->get();
            foreach ($tasks as $task) {
                $notification = [
                    'icon' => 'fas fa-fw fa-tasks', // Corrected icon class
                    'text' => "Hey {$authUser->first_name}, you have a new task! {$task->title}",
                    'time' => $task->created_at->diffForHumans(),
                    'details' => "Task details: {$task->description}" // Add details
                ];
                $this->notifications['tasks'][] = $notification;
            }
        }

        if ($authUser->hasRole(['Super Admin', 'Admin'])) {
            $tasks = Task::with('employee')
                         ->whereIn('status', ['on progress', 'done', 'abandoned'])
                         ->where('is_read', false)  // Only fetch unread tasks
                         ->get();
            foreach ($tasks as $task) {
                $notification = [
                    'icon' => 'fas fa-fw fa-tasks',
                    'text' => "Task '{$task->title}' assigned to {$task->employee->first_name} {$task->employee->last_name} is now {$task->status}",
                    'time' => $task->updated_at->diffForHumans(),
                    'details' => "Task details: {$task->description}" // Add details
                ];
                $this->notifications['tasks'][] = $notification;
            }
        }
    }

    // Generate job application notifications for HR Hiring users
    private function generateJobApplicationNotifications()
    {
        if (Auth::user()->hasRole('HR Hiring')) {
            $last24Hours = Carbon::now()->subDay();
            $newApplications = \App\Models\Career::where('created_at', '>=', $last24Hours)
                ->where('is_read', false)  // Only fetch unread applications
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($newApplications as $application) {
                $notification = [
                    'icon' => 'fas fa-fw fa-user-tie',
                    'text' => "New job application received for {$application->position}",
                    'time' => $application->created_at->diffForHumans(),
                    'details' => "Applicant: {$application->name}, Email: {$application->email}"
                ];
                $this->notifications['job_applications'][] = $notification;
            }
        }
    }

    // Count the total number of notifications
    private function countTotalNotifications()
    {
        return array_sum(array_map('count', $this->notifications)); // Sum all counts from notifications
    }

    // Generate HTML for dropdown notifications
    private function generateDropdownHtml()
    {
        $dropdownHtml = '';
        $allNotifications = $this->flattenNotifications();

        foreach ($allNotifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";
            $time = "<span class='float-right text-muted text-sm'>{$not['time']}</span>";
            $dropdownHtml .= "<a href='#' class='dropdown-item d-flex justify-content-between align-items-center flex-wrap text-right' data-toggle='modal' data-target='#notificationModal' data-details='{$not['details']}' data-title='{$not['text']}'>
                                <div class='d-flex align-items-center w-100'>
                                    {$icon}
                                    <span class='text-truncate'>{$not['text']}</span>
                                </div>
                                {$time}
                              </a>";
            if ($key < count($allNotifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        return $dropdownHtml;
    }

    // Flatten the notifications for dropdown HTML generation
    private function flattenNotifications()
    {
        // Return an array of notifications with their counts
        $flattened = [];
        foreach ($this->notifications as $category => $notifications) {
            foreach ($notifications as $notification) {
                $flattened[] = $notification;
            }
        }
        return $flattened;
    }

    // Show all notifications in a view
    public function showAllNotifications(Request $request)
    {
        $this->generateNotifications();
        return view('all-notifications', ['allNotifications' => $this->notifications]);
    }
}
