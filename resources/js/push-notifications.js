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

class NotificationManager {
    constructor() {
        this.permissionGranted = false;
    }

    async init() {
        // Check if the browser supports notifications
        if (!('Notification' in window)) {
            console.log('This browser does not support notifications');
            return;
        }

        // Add notification permission button to DOM
        this.addPermissionButton();

        // Check if already granted
        if (Notification.permission === 'granted') {
            this.permissionGranted = true;
            this.initializeServiceWorker();
        }
    }

    addPermissionButton() {
        // Create notification permission button
        const button = document.createElement('button');
        button.className = 'btn btn-primary notification-permission-btn';
        button.innerHTML = `
            <i class="fas fa-bell"></i>
            ${Notification.permission === 'granted' ? 'Notifications Enabled' : 'Enable Notifications'}
        `;

        // Add button styles
        const style = document.createElement('style');
        style.textContent = `
            .notification-permission-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                padding: 10px 20px;
                border-radius: 20px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
            .notification-permission-btn.granted {
                background-color: #28a745;
                border-color: #28a745;
            }
        `;
        document.head.appendChild(style);

        // Add click handler
        button.addEventListener('click', () => this.requestPermission());

        // Update button state
        if (Notification.permission === 'granted') {
            button.classList.add('granted');
        }

        // Add to DOM
        document.body.appendChild(button);
    }

    async requestPermission() {
        try {
            const permission = await Notification.requestPermission();

            // Update button appearance
            const button = document.querySelector('.notification-permission-btn');

            if (permission === 'granted') {
                this.permissionGranted = true;
                button.innerHTML = '<i class="fas fa-bell"></i> Notifications Enabled';
                button.classList.add('granted');
                this.initializeServiceWorker();

                // Show success notification
                new Notification('Notifications Enabled', {
                    body: 'You will now receive notifications from our system',
                    icon: '/path/to/your/icon.png'
                });
            } else {
                button.innerHTML = '<i class="fas fa-bell"></i> Enable Notifications';
                button.classList.remove('granted');
                console.log('Notification permission denied');
            }
        } catch (error) {
            console.error('Error requesting notification permission:', error);
        }
    }

    async initializeServiceWorker() {
        if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
            console.log('Push notifications not supported');
            return;
        }

        try {
            const registration = await navigator.serviceWorker.register('/service-worker.js');
            const subscription = await registration.pushManager.getSubscription();

            if (subscription) {
                return subscription;
            }

            const response = await fetch('/api/push/vapid-public-key');
            const vapidPublicKey = await response.text();
            const convertedVapidKey = this.urlBase64ToUint8Array(vapidPublicKey);

            const newSubscription = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: convertedVapidKey
            });

            // Send subscription to server
            await fetch('/api/push/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(newSubscription)
            });

            console.log('Push notification subscription successful');
        } catch (error) {
            console.error('Failed to initialize push notifications:', error);
        }
    }

    urlBase64ToUint8Array(base64String) {
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
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const notificationManager = new NotificationManager();
    notificationManager.init();
});
