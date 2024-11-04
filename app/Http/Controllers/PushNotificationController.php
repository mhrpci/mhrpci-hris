<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PushSubscription;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushNotificationController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Subscription request received', $request->all());

        $this->validate($request, [
            'endpoint' => 'required|url',
            'keys.auth' => 'required|string',
            'keys.p256dh' => 'required|string',
        ]);

        $subscription = json_decode(json_encode($request->all()), true);

        try {
            $pushSubscription = PushSubscription::updateOrCreate(
                [
                    'endpoint' => $subscription['endpoint'],
                ],
                [
                    'user_id' => auth()->id(),
                    'p256dh_key' => $subscription['keys']['p256dh'],
                    'auth_token' => $subscription['keys']['auth'],
                    'active' => true,
                ]
            );

            \Log::info('Subscription stored successfully', ['id' => $pushSubscription->id]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription saved successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error storing subscription: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error storing subscription'
            ], 500);
        }
    }

    public function getVapidPublicKey()
    {
        $key = config('webpush.public_key');
        \Log::info('VAPID public key requested', ['key' => $key]);
        return response($key)->header('Content-Type', 'text/plain');
    }

    public function testNotification()
    {
        try {
            $auth = [
                'VAPID' => [
                    'subject' => config('app.url'),
                    'publicKey' => config('webpush.public_key'),
                    'privateKey' => config('webpush.private_key'),
                ]
            ];

            $webPush = new WebPush($auth);
            $subscriptions = PushSubscription::where('active', true)->get();

            if ($subscriptions->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active subscriptions found'
                ]);
            }

            $payload = json_encode([
                'title' => 'Test Notification',
                'body' => 'This is a test notification sent at ' . now()->format('Y-m-d H:i:s'),
                'icon' => '/favicon.ico',
                'badge' => '/favicon.ico',
                'data' => [
                    'url' => route('home')
                ]
            ]);

            $successCount = 0;
            $failureCount = 0;

            foreach ($subscriptions as $subscription) {
                $sub = Subscription::create([
                    'endpoint' => $subscription->endpoint,
                    'keys' => [
                        'p256dh' => $subscription->p256dh_key,
                        'auth' => $subscription->auth_token
                    ]
                ]);

                $webPush->queueNotification($sub, $payload);
            }

            foreach ($webPush->flush() as $report) {
                $endpoint = $report->getRequest()->getUri()->__toString();

                if ($report->isSuccess()) {
                    $successCount++;
                    \Log::info('Push notification sent successfully', ['endpoint' => $endpoint]);
                } else {
                    $failureCount++;
                    PushSubscription::where('endpoint', $endpoint)->update(['active' => false]);
                    \Log::error('Push notification failed', [
                        'endpoint' => $endpoint,
                        'reason' => $report->getReason()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Notifications processed: {$successCount} successful, {$failureCount} failed"
            ]);

        } catch (\Exception $e) {
            \Log::error('Error sending test notification: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error sending notification: ' . $e->getMessage()
            ], 500);
        }
    }
}
