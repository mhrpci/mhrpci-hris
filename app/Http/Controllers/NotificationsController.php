<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Holiday;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    // Initialize notification counts for each category
    private $notificationCounts = [
        'birthdays' => 0,
        'posts' => 0,
        'holidays' => 0,
        'leave_requests' => 0
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
    }

    // Generate birthday notifications
    private function generateBirthdayNotifications()
{
    $today = Carbon::today();
    $currentMonth = $today->month;

    // Fetch employees with birthdays in the current month
    $upcomingBirthdays = Employee::whereMonth('birth_date', $currentMonth)->get();

    foreach ($upcomingBirthdays as $employee) {
        $birthDate = Carbon::parse($employee->birth_date);
        $notification = [
            'icon' => 'fas fa-fw fa-birthday-cake', // Update the icon
            'text' => "{$employee->first_name} {$employee->last_name}'s birthday",
            'time' => $birthDate->format('F d'),
        ];

        // Check if the birthday is today
        if ($birthDate->isSameDay($today)) {
            $notification['icon'] .= ' text-warning'; // Highlight icon for today
            $notification['text'] = "Today is " . $notification['text'] . "!";
            $notification['time'] = 'Today';
            $this->notificationCounts['birthdays']++; // Increment count for today's birthdays
        } else {
            $notification['icon'] .= ' text-info'; // Default icon color for upcoming birthdays
            $this->notificationCounts['birthdays']++; // Increment count for upcoming birthdays
        }
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
        $this->notificationCounts['posts']++; // Increment count for new posts
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
        $this->notificationCounts['holidays']++; // Increment count for today's holiday
    }

    // Check for tomorrow's holidays
    $tomorrowsHolidays = $holidays->where('date', $tomorrow->format('Y-m-d'));
    foreach ($tomorrowsHolidays as $holiday) {
        $this->notificationCounts['holidays']++; // Increment count for tomorrow's holidays
    }
}

private function generateLeaveRequestNotifications()
{
    if (Auth::user()->hasRole(['Super Admin', 'Admin'])) {
        $pendingLeaves = Leave::where('status', 'pending')->get();
        foreach ($pendingLeaves as $leave) {
            $this->notificationCounts['leave_requests']++; // Increment count for pending leave requests
        }
    }
}


    // Count the total number of notifications
    private function countTotalNotifications()
    {
        return array_sum($this->notificationCounts); // Sum all counts from notificationCounts
    }

    // Generate HTML for dropdown notifications
    private function generateDropdownHtml()
    {
        $dropdownHtml = '';
        $allNotifications = $this->flattenNotifications();

        foreach ($allNotifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";
            $time = "<span class='float-right text-muted text-sm'>{$not['time']}</span>";
            $dropdownHtml .= "<a href='#' class='dropdown-item'>{$icon}{$not['text']}{$time}</a>";
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
        foreach ($this->notificationCounts as $category => $count) {
            // Generate dummy notifications for each count
            for ($i = 0; $i < $count; $i++) {
                $flattened[] = [
                    'icon' => 'fas fa-fw fa-bell',
                    'text' => ucfirst($category) . " notification " . ($i + 1),
                    'time' => 'Just now',
                ];
            }
        }
        return $flattened;
    }

    // Show all notifications in a view
    public function showAllNotifications(Request $request)
    {
        $this->generateNotifications();
        return view('all-notifications', ['allNotifications' => $this->notificationCounts]);
    }
}
