<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Holiday;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


class NotificationsController extends Controller
{
    private $notificationCategories = [
        'birthdays' => ['today' => [], 'upcoming' => []],
        'posts' => [],
        'holidays' => ['today' => [], 'upcoming' => []],
        'leave_requests' => []
    ];

    public function getNotificationsData(Request $request)
    {
        $this->generateNotifications();
        
        $totalNotifications = $this->countTotalNotifications();
        $dropdownHtml = $this->generateDropdownHtml();

        return [
            'label' => $totalNotifications,
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];
    }

    private function generateNotifications()
    {
        $this->generateBirthdayNotifications();
        $this->generatePostNotifications();
        $this->generateHolidayNotifications();
        $this->generateLeaveRequestNotifications();
    }

    private function generateBirthdayNotifications()
    {
        $today = Carbon::today();
        $currentMonth = $today->month;

        $upcomingBirthdays = Employee::whereMonth('birth_date', $currentMonth)->get();
        
        foreach ($upcomingBirthdays as $employee) {
            $birthDate = Carbon::parse($employee->birth_date);
            $notification = [
                'icon' => 'fas fa-fw fa-birthday-cake',
                'text' => "{$employee->first_name} {$employee->last_name}'s birthday",
                'time' => $birthDate->format('F d'),
            ];

            if ($birthDate->isSameDay($today)) {
                $notification['icon'] .= ' text-warning';
                $notification['text'] = "Today is " . $notification['text'] . "!";
                $notification['time'] = 'Today';
                $this->notificationCategories['birthdays']['today'][] = $notification;
            } else {
                $notification['icon'] .= ' text-info';
                $this->notificationCategories['birthdays']['upcoming'][] = $notification;
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
            $this->notificationCategories['posts'][] = [
                'icon' => 'fas fa-fw fa-newspaper text-primary',
                'text' => "New post by {$post->user->first_name}: {$post->title}",
                'time' => $post->created_at->diffForHumans(),
            ];
        }
    }

    private function generateHolidayNotifications()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $holidays = Holiday::orderBy('date', 'asc')->get();

        $todaysHoliday = $holidays->firstWhere('date', $today->format('Y-m-d'));
        if ($todaysHoliday) {
            $this->notificationCategories['holidays']['today'][] = [
                'icon' => 'fas fa-fw fa-calendar-day text-success',
                'text' => "Today's Holiday: {$todaysHoliday->title}",
                'time' => 'Today',
            ];
        }

        $tomorrowsHolidays = $holidays->where('date', $tomorrow->format('Y-m-d'));
        foreach ($tomorrowsHolidays as $holiday) {
            $this->notificationCategories['holidays']['upcoming'][] = [
                'icon' => 'fas fa-fw fa-calendar-alt text-success',
                'text' => "Tomorrow's holiday: {$holiday->title}",
                'time' => 'Tomorrow',
            ];
        }
    }

    private function generateLeaveRequestNotifications()
    {
        if (Auth::user()->hasRole(['Super Admin', 'Admin'])) {
            $pendingLeaves = Leave::where('status', 'pending')->get();
            foreach ($pendingLeaves as $leave) {
                $this->notificationCategories['leave_requests'][] = [
                    'icon' => 'fas fa-fw fa-clock text-info',
                    'text' => "Pending leave request from {$leave->employee->first_name} {$leave->employee->last_name}",
                    'time' => $leave->created_at->diffForHumans(),
                ];
            }
        }
    }

    private function countTotalNotifications()
    {
        $total = 0;
        foreach ($this->notificationCategories as $category) {
            if (is_array($category)) {
                foreach ($category as $subcategory) {
                    $total += count($subcategory);
                }
            } else {
                $total += count($category);
            }
        }
        return $total;
    }

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

    private function flattenNotifications()
    {
        $flattened = [];
        foreach ($this->notificationCategories as $category => $notifications) {
            if (is_array($notifications) && isset($notifications['today'])) {
                $flattened = array_merge($flattened, $notifications['today']);
                $flattened = array_merge($flattened, $notifications['upcoming']);
            } else {
                $flattened = array_merge($flattened, $notifications);
            }
        }
        return $flattened;
    }

    public function showAllNotifications(Request $request)
    {
        $this->generateNotifications();
        return view('all-notifications', ['allNotifications' => $this->notificationCategories]);
    }
}