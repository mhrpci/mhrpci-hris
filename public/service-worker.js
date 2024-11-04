self.addEventListener('install', (event) => {
    console.log('Service Worker installed');
});

self.addEventListener('activate', (event) => {
    console.log('Service Worker activated');
});

self.addEventListener('push', (event) => {
    if (event.data) {
        const data = event.data.json();

        const options = {
            body: data.body,
            icon: data.icon,
            badge: data.badge,
            timestamp: data.timestamp,
            vibrate: data.vibrate,
            requireInteraction: data.requireInteraction,
            data: data.data
        };

        event.waitUntil(
            self.registration.showNotification(data.title, options)
        );
    }
});

self.addEventListener('notificationclick', (event) => {
    event.notification.close();

    // Log notification click for tracking
    console.log('Notification clicked:', event.notification.data);
});

self.addEventListener('notificationclose', (event) => {
    // Log notification close for tracking
    console.log('Notification closed:', event.notification.data);
});
