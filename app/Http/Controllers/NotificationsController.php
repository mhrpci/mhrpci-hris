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
use App\Models\CashAdvance;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\PushSubscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
    ];

    private $webPush;
    private $hasNewNotifications = false;

    public function __construct()
    {
        $this->initializeWebPush();
    }

    private function initializeWebPush()
    {
        try {
            // Validate required configuration
            if (!config('webpush.public_key') || !config('webpush.private_key')) {
                Log::warning('WebPush configuration missing. Push notifications disabled.');
                return;
            }

            $this->webPush = new WebPush([
                'VAPID' => [
                    'subject' => config('app.url') . '/home',
                    'publicKey' => config('webpush.public_key'),
                    'privateKey' => config('webpush.private_key'),
                    'icon' => config('app.url') . '/vendor/adminlte/dist/img/LOGO4.png',
                    'name' => config('app.name')
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('WebPush initialization failed: ' . $e->getMessage());
            // Continue without web push functionality
        }
    }

    // Method to fetch notifications data
    public function getNotificationsData(Request $request)
    {
        $this->generateNotifications();

        return response()->json([
            'label' => $this->countTotalNotifications(),
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $this->generateDropdownHtml(),
            'timestamp' => now()->timestamp
        ]);
    }

    // Generate all types of notifications
    private function generateNotifications()
    {
        try {
            $oldCount = $this->countTotalNotifications();

            // Use database transactions with a shorter timeout
            DB::beginTransaction();

            // Set a reasonable timeout for the transaction
            DB::statement('SET SESSION innodb_lock_wait_timeout=10');

            // Use eager loading to reduce database queries
            Employee::with(['leaves', 'tasks', 'cashAdvances'])->chunk(100, function($employees) {
                // Process employees in chunks
            });

            // Generate notifications concurrently where possible
            $notifications = [
                $this->generateBirthdayNotifications(),
                $this->generatePostNotifications(),
                $this->generateHolidayNotifications(),
                $this->generateLeaveRequestNotifications(),
                $this->generateEmployeeLeaveNotifications(),
                $this->generateTaskNotifications(),
                $this->generateJobApplicationNotifications(),
                $this->generateCashAdvanceNotifications(),
            ];

            DB::commit();

            $newCount = $this->countTotalNotifications();
            $this->hasNewNotifications = ($newCount > $oldCount);

            if ($this->hasNewNotifications) {
                // Dispatch broadcasting to a job for better performance
                dispatch(function() {
                    $this->broadcastNewNotifications();
                })->afterResponse();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error generating notifications: ' . $e->getMessage());
            throw $e;
        }
    }

    // Add a new method to broadcast notifications
    private function broadcastNewNotifications()
    {
        if (!$this->hasNewNotifications) {
            return;
        }

        try {
            $newNotifications = $this->getNewNotifications();
            $newNotifications = $this->filterAlreadySentNotifications($newNotifications);

            if (empty($newNotifications)) {
                return;
            }

            // Process subscriptions in smaller chunks
            PushSubscription::where('active', true)
                ->select(['endpoint', 'p256dh_key', 'auth_token', 'user_id'])
                ->chunk(25, function($subscriptions) use ($newNotifications) {
                    $this->processPushNotifications($subscriptions, $newNotifications);
                });

            // Broadcast using Laravel's event system
            $broadcastData = [
                'label' => $this->countTotalNotifications(),
                'label_color' => 'danger',
                'icon_color' => 'dark',
                'dropdown' => $this->generateDropdownHtml(),
                'timestamp' => now()->timestamp,
                'sound' => 'notification.mp3'
            ];

            broadcast(new NewNotification($broadcastData))->toOthers();

        } catch (\Exception $e) {
            Log::error('Broadcasting failed: ' . $e->getMessage());
            report($e);
        }
    }

    // New method to handle push notifications processing
    private function processPushNotifications($subscriptions, $notifications)
    {
        if (!$this->webPush) {
            Log::warning('WebPush not initialized. Skipping push notifications.');
            return;
        }

        $batch = [];

        foreach ($subscriptions as $subscription) {
            try {
                $sub = Subscription::create([
                    'endpoint' => $subscription->endpoint,
                    'keys' => [
                        'p256dh' => $subscription->p256dh_key,
                        'auth' => $subscription->auth_token
                    ]
                ]);

                foreach ($notifications as $notification) {
                    $payload = $this->createNotificationPayload($notification, $subscription);
                    if ($payload) {
                        $batch[] = [
                            'subscription' => $sub,
                            'payload' => $payload,
                            'notification' => $notification
                        ];
                    }
                }
            } catch (\Exception $e) {
                Log::error('Failed to create subscription', [
                    'error' => $e->getMessage(),
                    'endpoint' => $subscription->endpoint
                ]);
                continue;
            }
        }

        if (empty($batch)) {
            Log::info('No notifications to send in batch');
            return;
        }

        // Process in smaller batches for better performance
        foreach (array_chunk($batch, 10) as $batchItems) {
            $this->processBatchNotifications($batchItems);
        }
    }

    // New method to create notification payload
    private function createNotificationPayload($notification, $subscription)
    {
        return json_encode([
            'title' => $notification['title'],
            'body' => $notification['text'],
            'icon' => config('app.url') . '/favicon.ico',
            'badge' => config('app.url') . '/favicon.ico',
            'timestamp' => now()->timestamp,
            'requireInteraction' => true,
            'vibrate' => [100, 50, 100],
            'data' => [
                'type' => $notification['type'],
                'details' => $notification['details'] ?? null,
                'time' => now()->toIso8601String(),
                'url' => $this->getNotificationUrl($notification),
                'priority' => $this->getNotificationPriority($notification),
                'user_id' => $subscription->user_id
            ],
            'actions' => $this->getNotificationActions($notification)
        ]);
    }

    // New helper methods for enhanced notifications
    private function getNotificationUrl($notification)
    {
        $urls = [
            'birthday' => '/employees',
            'post' => '/posts',
            'holiday' => '/holidays',
            'leave_request' => '/leaves',
            'task' => '/tasks',
            'job_application' => '/careers',
            'cash_advance' => '/cash-advances'
        ];

        return config('app.url') . ($urls[$notification['type']] ?? '/dashboard');
    }

    private function getNotificationPriority($notification)
    {
        $priorities = [
            'task' => 'high',
            'leave_request' => 'high',
            'cash_advance' => 'high',
            'birthday' => 'normal',
            'post' => 'normal',
            'holiday' => 'normal',
            'job_application' => 'normal'
        ];

        return $priorities[$notification['type']] ?? 'normal';
    }

    private function getNotificationActions($notification)
    {
        $actions = [];

        switch ($notification['type']) {
            case 'task':
                $actions[] = ['action' => 'view', 'title' => 'View Task'];
                $actions[] = ['action' => 'complete', 'title' => 'Mark Complete'];
                break;
            case 'leave_request':
                $actions[] = ['action' => 'approve', 'title' => 'Approve'];
                $actions[] = ['action' => 'reject', 'title' => 'Reject'];
                break;
            default:
                $actions[] = ['action' => 'view', 'title' => 'View'];
        }

        return $actions;
    }

    private function processBatchNotifications($batchItems)
    {
        if (!$this->webPush) {
            return;
        }

        try {
            foreach ($batchItems as $item) {
                $this->webPush->queueNotification(
                    $item['subscription'],
                    $item['payload'],
                    ['timeout' => 5] // Add timeout to prevent hanging
                );
            }

            $reports = $this->webPush->flush();
            $success = $this->handlePushReports($reports);

            if ($success) {
                foreach ($batchItems as $item) {
                    $this->markNotificationAsSent($item['notification']);
                    Log::info('Push notification sent successfully', [
                        'type' => $item['notification']['type'],
                        'endpoint' => $item['subscription']->getEndpoint()
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to process batch notifications', [
                'error' => $e->getMessage(),
                'batch_size' => count($batchItems)
            ]);
        }
    }

    private function getNewNotifications()
    {
        $newNotifications = [];

        // Process birthdays
        foreach ($this->notifications['birthdays'] as $notification) {
            $newNotifications[] = [
                'type' => 'birthday',
                'title' => '🎂 Birthday Notification',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process posts
        foreach ($this->notifications['posts'] as $notification) {
            $newNotifications[] = [
                'type' => 'post',
                'title' => '📢 New Announcement',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process holidays
        foreach ($this->notifications['holidays'] as $notification) {
            $newNotifications[] = [
                'type' => 'holiday',
                'title' => '📅 Holiday Reminder',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process leave requests
        foreach ($this->notifications['leave_requests'] as $notification) {
            $newNotifications[] = [
                'type' => 'leave_request',
                'title' => '📝 Leave Request Update',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process tasks
        foreach ($this->notifications['tasks'] as $notification) {
            $newNotifications[] = [
                'type' => 'task',
                'title' => '📋 Task Update',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process job applications
        foreach ($this->notifications['job_applications'] as $notification) {
            $newNotifications[] = [
                'type' => 'job_application',
                'title' => '👔 New Job Application',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        // Process cash advances
        foreach ($this->notifications['cash_advances'] as $notification) {
            $newNotifications[] = [
                'type' => 'cash_advance',
                'title' => '💰 Cash Advance Update',
                'text' => $notification['text'],
                'details' => $notification['details']
            ];
        }

        return $newNotifications;
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
        if (Auth::user()->hasRole(['HR Hiring', 'Super Admin', 'Admin'])) {
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

        return view('all-notifications', ['allNotifications' => $this->notifications]);
    }

    private function generateNotificationId($notification)
    {
        // Enhanced unique identifier creation
        $idComponents = [
            $notification['type'],
            $notification['text'],
            $notification['details'] ?? '',
            date('Y-m-d'), // Add date component for daily notifications like birthdays
            isset($notification['details']['id']) ? $notification['details']['id'] : '', // Include specific IDs if available
        ];

        return hash('sha256', implode('|', $idComponents));
    }

    private function filterAlreadySentNotifications($notifications)
    {
        return collect($notifications)->filter(function($notification) {
            $notificationId = $this->generateNotificationId($notification);

            // Check both local and production databases
            $exists = DB::table('sent_notifications')
                ->where('notification_type', $notification['type'])
                ->where('notification_id', $notificationId)
                ->where('created_at', '>=', now()->subDays(7)) // Only check last 7 days
                ->exists();

            if (!$exists) {
                // Log new notification for debugging
                Log::info('New notification detected', [
                    'type' => $notification['type'],
                    'id' => $notificationId,
                    'text' => $notification['text']
                ]);
            }

            return !$exists;
        })->all();
    }

    private function markNotificationAsSent($notification)
    {
        try {
            $notificationId = $this->generateNotificationId($notification);

            DB::table('sent_notifications')->insert([
                'notification_type' => $notification['type'],
                'notification_id' => $notificationId,
                'notification_text' => $notification['text'],
                'notification_details' => json_encode($notification['details'] ?? []),
                'environment' => app()->environment(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('Notification marked as sent', [
                'type' => $notification['type'],
                'id' => $notificationId
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to mark notification as sent', [
                'error' => $e->getMessage(),
                'type' => $notification['type']
            ]);
        }
    }

    // Add this new method to clean up old sent notifications
    private function cleanupOldNotifications()
    {
        try {
            // Remove notifications older than 30 days
            DB::table('sent_notifications')
                ->where('created_at', '<', now()->subDays(30))
                ->delete();
        } catch (\Exception $e) {
            Log::error('Failed to cleanup old notifications: ' . $e->getMessage());
        }
    }

    private function handlePushReports($reports)
    {
        $success = true;
        foreach ($reports as $report) {
            $endpoint = $report->getRequest()->getUri()->__toString();

            if (!$report->isSuccess()) {
                $reason = $report->getReason();

                // Handle expired subscriptions
                if (strpos($reason, 'expired') !== false || strpos($reason, '410') !== false) {
                    dispatch(function () use ($endpoint) {
                        PushSubscription::where('endpoint', $endpoint)->delete();
                    })->afterResponse();

                    Log::info('Removed expired subscription', ['endpoint' => $endpoint]);
                } else {
                    // Mark subscription as inactive for other failures
                    dispatch(function () use ($endpoint) {
                        PushSubscription::where('endpoint', $endpoint)
                            ->update(['active' => false]);
                    })->afterResponse();

                    Log::warning('Push notification failed', [
                        'endpoint' => $endpoint,
                        'reason' => $reason
                    ]);
                }

                $success = false;
            } else {
                Log::info('Push notification succeeded', ['endpoint' => $endpoint]);
            }
        }
        return $success;
    }
}

