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
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\PushSubscription;
use Illuminate\Support\Facades\Log;
use Predis\Connection\ConnectionException;
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
        $userId = Auth::id();
        $cacheKey = 'user_notifications_' . $userId;

        try {
            // Use Laravel's cache system
            $cachedNotifications = Cache::get($cacheKey);
            if (!$cachedNotifications) {
                $this->generateNotifications();
                Cache::put($cacheKey, $this->notifications, 300); // Cache for 5 minutes
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

        } catch (\Exception $e) {
            Log::error('Error getting notifications data: ' . $e->getMessage(), [
                'user_id' => $userId,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'label' => 0,
                'label_color' => 'danger',
                'icon_color' => 'dark',
                'dropdown' => '<div class="dropdown-item">Error loading notifications</div>',
            ]);
        }
    }

    // Generate all types of notifications
    private function generateNotifications()
    {
        try {
            $oldCount = $this->countTotalNotifications();

            // Use database transactions for consistency
            DB::beginTransaction();

            // Generate notifications for each category
            $this->generateBirthdayNotifications();
            $this->generatePostNotifications();
            $this->generateHolidayNotifications();
            $this->generateLeaveRequestNotifications();
            $this->generateEmployeeLeaveNotifications();
            $this->generateTaskNotifications();
            $this->generateJobApplicationNotifications();
            $this->generateCashAdvanceNotifications();

            DB::commit();

            $newCount = $this->countTotalNotifications();
            $this->hasNewNotifications = ($newCount > $oldCount);

            if ($this->hasNewNotifications) {
                $this->broadcastNewNotifications();
            }

            // Log notification counts for monitoring
            Log::info('Notifications generated', [
                'user_id' => Auth::id(),
                'old_count' => $oldCount,
                'new_count' => $newCount,
                'types' => array_map('count', $this->notifications)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error generating notifications: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
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
            $batch = [];
            $newNotifications = $this->getNewNotifications();

            // Filter out already sent notifications
            $newNotifications = $this->filterAlreadySentNotifications($newNotifications);

            if (empty($newNotifications)) {
                return;
            }

            $subscriptions = PushSubscription::where('active', true)
                ->select(['endpoint', 'p256dh_key', 'auth_token'])
                ->chunk(100, function($subscriptions) use (&$batch, $newNotifications) {
                    foreach ($subscriptions as $subscription) {
                        $sub = Subscription::create([
                            'endpoint' => $subscription->endpoint,
                            'keys' => [
                                'p256dh' => $subscription->p256dh_key,
                                'auth' => $subscription->auth_token
                            ]
                        ]);

                        // Process each new notification
                        foreach ($newNotifications as $notification) {
                            $payload = json_encode([
                                'title' => $notification['title'],
                                'body' => $notification['text'],
                                'icon' => '/favicon.ico',
                                'badge' => '/favicon.ico',
                                'timestamp' => time(),
                                'requireInteraction' => true,
                                'vibrate' => [200, 100, 200],
                                'data' => [
                                    'type' => $notification['type'],
                                    'details' => $notification['details'] ?? null,
                                    'time' => now()->toIso8601String()
                                ]
                            ]);

                            $batch[] = [
                                'subscription' => $sub,
                                'payload' => $payload,
                                'notification' => $notification
                            ];
                        }
                    }
                });

            // Process notifications in batches
            foreach (array_chunk($batch, 50) as $batchItems) {
                foreach ($batchItems as $item) {
                    $this->webPush->queueNotification(
                        $item['subscription'],
                        $item['payload']
                    );
                }

                // Send batch and handle results
                $reports = $this->webPush->flush();

                // If successful, mark notifications as sent
                if ($this->handlePushReports($reports)) {
                    foreach ($batchItems as $item) {
                        $this->markNotificationAsSent($item['notification']);
                    }
                }
            }

            // Broadcast through Laravel's broadcasting system
            broadcast(new NewNotification([
                'label' => $this->countTotalNotifications(),
                'label_color' => 'danger',
                'icon_color' => 'dark',
                'dropdown' => $this->generateDropdownHtml(),
            ]))->toOthers();

        } catch (\Exception $e) {
            Log::error('Error broadcasting notifications: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            // Don't throw the exception - allow the application to continue
            // but log it for monitoring
            report($e);

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

    private function filterAlreadySentNotifications($notifications)
    {
        return collect($notifications)->filter(function($notification) {
            $notificationId = $this->generateNotificationId($notification);
            return !DB::table('sent_notifications')
                ->where('notification_type', $notification['type'])
                ->where('notification_id', $notificationId)
                ->exists();
        })->all();
    }

    private function generateNotificationId($notification)
    {
        // Create a unique identifier based on the notification content
        $idComponents = [
            $notification['type'],
            $notification['text'],
            $notification['details'] ?? '',
            // Add any other relevant fields that make the notification unique
        ];

        return md5(implode('|', $idComponents));
    }

    private function markNotificationAsSent($notification)
    {
        DB::table('sent_notifications')->insert([
            'notification_type' => $notification['type'],
            'notification_id' => $this->generateNotificationId($notification),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function handlePushReports($reports)
    {
        $success = true;
        foreach ($reports as $report) {
            if (!$report->isSuccess()) {
                $endpoint = $report->getRequest()->getUri()->__toString();

                // Update subscription status asynchronously
                dispatch(function () use ($endpoint) {
                    PushSubscription::where('endpoint', $endpoint)
                        ->update(['active' => false]);
                })->afterResponse();

                Log::warning('Push notification failed', [
                    'endpoint' => $endpoint,
                    'reason' => $report->getReason()
                ]);

                $success = false;
            }
        }
        return $success;
    }
}

