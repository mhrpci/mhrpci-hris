import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Ensure userId is available
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

if (userId) {
    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            new Notification(notification.title, {
                body: notification.body,
            });
        });
} else {
    console.error('User ID not found');
}

// Request notification permission
if (Notification.permission === 'default') {
    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
        } else {
            console.log('Notification permission denied.');
        }
    });
} else if (Notification.permission === 'denied') {
    alert('Notifications are blocked. Please enable them in your browser settings.');
} else {
    console.log('Notification permission already granted.');
}

window.Echo.private(`notifications`)
    .listen('RealTimeNotification', (e) => {
        // Update notification badge
        updateNotificationBadge(e.notification);

        // Show desktop notification if permitted
        if (Notification.permission === 'granted') {
            showDesktopNotification(e.notification);
        }

        // Play notification sound
        playNotificationSound();
    });

function updateNotificationBadge(notification) {
    const badge = document.getElementById('notification-badge');
    const count = parseInt(badge.textContent || '0');
    badge.textContent = count + 1;

    // Add notification to dropdown
    addNotificationToDropdown(notification);
}

function showDesktopNotification(notification) {
    const options = {
        body: notification.text,
        icon: '/path/to/icon.png',
        badge: '/path/to/badge.png',
        vibrate: [200, 100, 200]
    };

    new Notification(notification.title, options);
}

