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
