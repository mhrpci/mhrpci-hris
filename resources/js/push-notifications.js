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
