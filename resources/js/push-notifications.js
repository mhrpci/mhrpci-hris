const webPush = require('web-push');

// VAPID keys should be generated only once.
const vapidKeys = {
    publicKey: 'BADHrOsFv9il-EIA9NoI6H7rbOpYOpvsB50WE_DRS9ZRx56jWxZPBazUiMbVeEOBwH_xXKKy8xvzRVLf0ualyN4',
    privateKey: 'gBT7NRaJZm-OdVXpKMmdeOAWLekagZ-oyDeYOxvzm7A'
};

webPush.setVapidDetails(
    'mailto:example@yourdomain.org',
    vapidKeys.publicKey,
    vapidKeys.privateKey
);

// Function to send push notification
function sendPushNotification(subscription, payload) {
    webPush.sendNotification(subscription, payload)
        .then(response => console.log('Push notification sent:', response))
        .catch(error => console.error('Error sending push notification:', error));
}

// Example usage
const pushSubscription = {
    endpoint: 'https://fcm.googleapis.com/fcm/send/...',
    keys: {
        auth: '...',
        p256dh: '...'
    }
};

const payload = JSON.stringify({
    title: 'Hello!',
    body: 'This is a push notification.',
    icon: '/path/to/icon.png',
    badge: '/path/to/badge.png'
});

sendPushNotification(pushSubscription, payload);

if ('serviceWorker' in navigator && 'PushManager' in window) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful');

                // Subscribe to push notifications
                initPushNotifications(registration);
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
    });
}

function initPushNotifications(registration) {
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported.');
        return;
    }

    if (Notification.permission === 'denied') {
        console.log('User has blocked notifications.');
        return;
    }

    if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported.');
        return;
    }

    subscribe(registration);
}

function subscribe(registration) {
    registration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array('YOUR_VAPID_PUBLIC_KEY')
    })
    .then(function(subscription) {
        // Send subscription to server
        return fetch('/push-subscription', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(subscription)
        });
    })
    .catch(function(e) {
        console.log('Failed to subscribe the user: ', e);
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
