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
use App\Events\NewNotification;
use Illuminate\Support\Facades\Cache;
use App\Models\CashAdvance;
class NotificationsController extends Controller
{
    // Initialize notification counts for each category
    private $notifications = [
        'birthdays' => [],
        'posts' => [],
        'holidays' => [],
        'leave_requests' => [],
        'tasks' => [],
        'job_applications' => [],
        'cash_advances' => [],
        'hr_comben_leaves' => [] // Add new notification type
    ];

    // Method to fetch notifications data
    public function getNotificationsData(Request $request)
    {
        $cacheKey = 'user_notifications_' . Auth::id();

        // Try to get notifications from cache first
        $cachedNotifications = Cache::get($cacheKey);

        if (!$cachedNotifications) {
            $this->generateNotifications();
        } else {
            $this->notifications = $cachedNotifications;
        }

        $totalNotifications = $this->countTotalNotifications();
        $dropdownHtml = $this->generateDropdownHtml();

        return response()->json([
            'label' => $totalNotifications,
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ]);
    }

    // Generate all types of notifications
    private function generateNotifications()
    {
        try {
            $oldCount = $this->countTotalNotifications();

            // Generate notifications for each category
            $this->generateBirthdayNotifications();
            $this->generatePostNotifications();
            $this->generateHolidayNotifications();
            $this->generateLeaveRequestNotifications();
            $this->generateEmployeeLeaveNotifications();
            $this->generateHRComBenLeaveNotifications();
            $this->generateTaskNotifications();
            $this->generateJobApplicationNotifications();
            $this->generateCashAdvanceNotifications();

            $newCount = $this->countTotalNotifications();

            // If there are new notifications, broadcast them
            if ($newCount > $oldCount) {
                $this->broadcastNewNotifications();
            }

            // Log the count of notifications for debugging
            \Log::info('Notification counts:', $this->notifications);

            // Use environment-specific caching
            $cacheKey = 'user_notifications_' . Auth::id();
            $cacheDuration = now()->addMinutes(5);

            Cache::put($cacheKey, $this->notifications, $cacheDuration);
        } catch (\Exception $e) {
            // Log any exceptions that occur
            \Log::error('Error generating notifications: ' . $e->getMessage());
        }
    }

    // Add a new method to broadcast notifications
    private function broadcastNewNotifications()
    {
        $totalNotifications = $this->countTotalNotifications();
        $dropdownHtml = $this->generateDropdownHtml();

        $notificationData = [
            'label' => $totalNotifications,
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];

        // Use a try-catch block to handle potential broadcasting issues
        try {
            broadcast(new NewNotification($notificationData))->toOthers();
        } catch (\Exception $e) {
            \Log::error('Error broadcasting new notifications: ' . $e->getMessage());
        }
    }

    // Generate birthday notifications
    private function generateBirthdayNotifications()
    {
        $today = Carbon::today();
        $authUserEmail = Auth::user()->email;

        \Log::info('Generating birthday notifications', ['today' => $today, 'authUserEmail' => $authUserEmail]);

        // Fetch employees with birthdays today
        $todaysBirthdays = Employee::whereMonth('birth_date', $today->month)
            ->whereDay('birth_date', $today->day)
            ->get();

        \Log::info('Employees with birthdays today', ['count' => $todaysBirthdays->count()]);

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
                'text' => "{$post->user->first_name} {$post->user->last_name} posted: {$post->title}",
                'time' => $post->created_at->diffForHumans(),
                'details' => "Post details: {$post->content}",
                'id' => $post->id  // Add the post ID to the notification
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

    // Generate leave notifications for the authenticated employee
    private function generateEmployeeLeaveNotifications()
    {
        $authUser = Auth::user();
        $employee = Employee::where('email_address', $authUser->email)->first();

        if ($authUser->hasRole('Employee') && $employee) {
            $leaveRequests = Leave::where('employee_id', $employee->id)
                ->whereIn('status', ['approved', 'rejected'])
                ->where('is_view', false)
                ->get();
            foreach ($leaveRequests as $leave) {
                $updater = $leave->updated_by ? \App\Models\User::find($leave->updated_by) : null;
                $updaterName = $updater ? "{$updater->first_name} {$updater->last_name}" : 'Unknown';

                $notification = [
                    'icon' => 'fas fa-fw fa-calendar-times',
                    'text' => "Your leave request for {$leave->type->name} is: {$leave->status}",
                    'time' => $leave->updated_at->diffForHumans(),
                    'details' => "Leave details: {$leave->reason}. Updated by: {$updaterName}"
                ];
                $this->notifications['leave_requests'][] = $notification;
            }
        }
    }

    // Add this new method
    private function generateCashAdvanceNotifications()
    {
        $authUser = Auth::user();

        // For admins - show pending cash advance requests
        if ($authUser->hasRole(['Super Admin', 'Admin'])) {
            $pendingAdvances = CashAdvance::with('employee')
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($pendingAdvances as $advance) {
                $notification = [
                    'icon' => 'fas fa-fw fa-money-bill-wave text-success',
                    'text' => "{$advance->employee->first_name} {$advance->employee->last_name} requested a cash advance of " .
                             number_format($advance->cash_advance_amount, 2),
                    'time' => $advance->created_at->diffForHumans(),
                    'details' => "Reference: {$advance->reference_number}\n" .
                                "Amount: ₱" . number_format($advance->cash_advance_amount, 2) . "\n" .
                                "Repayment Term: {$advance->repayment_term} months\n" .
                                "Monthly Amortization: ₱" . number_format($advance->monthly_amortization, 2)
                ];
                $this->notifications['cash_advances'][] = $notification;
            }

            // Add notifications for cash advances with zero remaining balance but not yet marked as complete
            $completedAdvances = CashAdvance::with('employee')
                ->where('status', 'active')
                ->get()
                ->filter(function($advance) {
                    return $advance->remainingBalance() == 0;
                });

            foreach ($completedAdvances as $advance) {
                $notification = [
                    'icon' => 'fas fa-fw fa-check-circle text-success',
                    'text' => "Cash advance for {$advance->employee->first_name} {$advance->employee->last_name} has been fully paid",
                    'time' => now()->diffForHumans(),
                    'details' => "Reference: {$advance->reference_number}\n" .
                                "Total Amount: ₱" . number_format($advance->cash_advance_amount, 2) . "\n" .
                                "Status: Ready to mark as complete"
                ];
                $this->notifications['cash_advances'][] = $notification;
            }
        }

        // For employees - show status updates of their cash advance requests
        if ($authUser->hasRole('Employee')) {
            $employee = Employee::where('email_address', $authUser->email)->first();
            if ($employee) {
                $cashAdvances = CashAdvance::where('employee_id', $employee->id)
                    ->whereIn('status', ['active', 'rejected'])
                    ->get();

                foreach ($cashAdvances as $advance) {
                    $notification = [
                        'icon' => 'fas fa-fw fa-money-bill-wave text-success',
                        'text' => "Your cash advance request (₱" . number_format($advance->cash_advance_amount, 2) . ") has been {$advance->status}",
                        'time' => $advance->updated_at->diffForHumans(),
                        'details' => "Reference: {$advance->reference_number}\n" .
                                    "Amount: ₱" . number_format($advance->cash_advance_amount, 2) . "\n" .
                                    "Status: " . ucfirst($advance->status)
                    ];
                    $this->notifications['cash_advances'][] = $notification;
                }

                // Add notifications for employee's cash advances with zero remaining balance but not yet marked as complete
                $completedAdvances = CashAdvance::where('employee_id', $employee->id)
                    ->where('status', 'active')
                    ->get()
                    ->filter(function($advance) {
                        return $advance->remainingBalance() == 0;
                    });

                foreach ($completedAdvances as $advance) {
                    $notification = [
                        'icon' => 'fas fa-fw fa-check-circle text-success',
                        'text' => "Congratulations! Your cash advance has been fully paid",
                        'time' => now()->diffForHumans(),
                        'details' => "Reference: {$advance->reference_number}\n" .
                                    "Total Amount: ₱" . number_format($advance->cash_advance_amount, 2) . "\n" .
                                    "Status: Ready to mark as complete"
                    ];
                    $this->notifications['cash_advances'][] = $notification;
                }
            }
        }
    }

    // Add this new method
    private function generateHRComBenLeaveNotifications()
    {
        try {
            // Only proceed if user has HR ComBen role
            if (!Auth::user()->hasRole('HR ComBen')) {
                return;
            }

            // Get approved leaves that need HR ComBen validation
            $recentlyApprovedLeaves = Leave::with(['employee', 'type', 'approver'])
                ->where('status', 'approved')
                ->whereNull('validated_by_signature')
                ->where('created_at', '>=', now()->subDays(30)) // Only show last 30 days
                ->orderBy('updated_at', 'desc')
                ->get();

            \Log::info('HR ComBen Leaves found:', ['count' => $recentlyApprovedLeaves->count()]);

            foreach ($recentlyApprovedLeaves as $leave) {
                // Get approver details
                $approverName = $leave->approver
                    ? "{$leave->approver->first_name} {$leave->approver->last_name}"
                    : 'System';

                // Format dates for better readability
                $startDate = Carbon::parse($leave->date_from)->format('M d, Y');
                $endDate = Carbon::parse($leave->date_to)->format('M d, Y');

                // Calculate number of days
                $numberOfDays = Carbon::parse($leave->date_from)->diffInDays(Carbon::parse($leave->date_to)) + 1;

                $notification = [
                    'icon' => 'fas fa-fw fa-check-circle text-success',
                    'text' => "Leave request approved for {$leave->employee->first_name} {$leave->employee->last_name} - Needs validation",
                    'time' => $leave->updated_at->diffForHumans(),
                    'details' => "Leave Type: {$leave->type->name}\n" .
                                "Duration: {$numberOfDays} day(s)\n" .
                                "Period: {$startDate} to {$endDate}\n" .
                                "Reason: {$leave->reason_to_leave}\n" .
                                "Approved by: {$approverName}\n" .
                                "Department: {$leave->employee->department}\n" .
                                "Status: Pending HR validation",
                    'id' => $leave->id,
                    'route' => route('leaves.show', $leave->id),
                    'priority' => 'high', // Add priority for urgent items
                    'category' => 'validation_required'
                ];

                $this->notifications['hr_comben_leaves'][] = $notification;
            }

            // Sort notifications by update time
            usort($this->notifications['hr_comben_leaves'], function($a, $b) {
                return strtotime($b['time']) - strtotime($a['time']);
            });

            \Log::info('HR ComBen notifications generated:', [
                'count' => count($this->notifications['hr_comben_leaves'])
            ]);

        } catch (\Exception $e) {
            \Log::error('Error generating HR ComBen leave notifications: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        }
    }

    // Count the total number of notifications
    private function countTotalNotifications()
    {
        return array_sum(array_map('count', $this->notifications));
    }

    // Generate HTML for dropdown notifications
    private function generateDropdownHtml()
    {
        $dropdownHtml = '';
        $allNotifications = $this->flattenNotifications();

        foreach ($allNotifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";
            $time = "<span class='float-right text-muted text-sm'>{$not['time']}</span>";
            $details = htmlspecialchars($not['details'], ENT_QUOTES, 'UTF-8');
            $text = htmlspecialchars($not['text'], ENT_QUOTES, 'UTF-8');

            // Check if notification has a route
            $href = isset($not['route']) ? $not['route'] : '#';
            $dataToggle = isset($not['route']) ? '' : "data-toggle='modal' data-target='#notificationModal'";

            $dropdownHtml .= "<a href='{$href}' class='dropdown-item d-flex justify-content-between align-items-center flex-wrap text-right' {$dataToggle} data-details='{$details}' data-title='{$text}'>
                                <div class='d-flex align-items-center w-100'>
                                    {$icon}
                                    <span class='text-truncate'>{$text}</span>
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
        $flattened = [];
        foreach ($this->notifications as $notifications) {
            $flattened = array_merge($flattened, $notifications);
        }
        usort($flattened, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        return array_slice($flattened, 0, 10); // Limit to 10 most recent notifications
    }

    // Show all notifications in a view
    public function showAllNotifications(Request $request)
    {
        $this->generateNotifications();

        // Add route information for each HR ComBen leave notification
        foreach ($this->notifications['hr_comben_leaves'] as &$notification) {
            if (isset($notification['id'])) {
                $notification['route'] = route('leaves.show', $notification['id']);
            }
        }

        return view('all-notifications', ['allNotifications' => $this->notifications]);
    }
}
