<?php

return [
    'public_key' => env('VAPID_PUBLIC_KEY'),
    'private_key' => env('VAPID_PRIVATE_KEY'),
    'cache_timeout' => env('NOTIFICATIONS_CACHE_TIMEOUT', 300),
];
