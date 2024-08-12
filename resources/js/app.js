import './bootstrap';
if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker.register('/service-worker.js')
        .then(function(swReg) {
            console.log('Service Worker is registered', swReg);

            swReg.pushManager.getSubscription()
                .then(function(subscription) {
                    if (subscription === null) {
                        // User is not subscribed
                        swReg.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: urlB64ToUint8Array(process.env.MIX_VAPID_PUBLIC_KEY)
                        })
                        .then(function(subscription) {
                            console.log('User is subscribed');
                            saveSubscription(subscription);
                        })
                        .catch(function(err) {
                            console.log('Failed to subscribe the user: ', err);
                        });
                    }
                });
        })
        .catch(function(error) {
            console.error('Service Worker Error', error);
        });
}

function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    return Uint8Array.from([...rawData].map(char => char.charCodeAt(0)));
}

function saveSubscription(subscription) {
    return fetch('/save-subscription', {
        method: 'POST',
        body: JSON.stringify(subscription),
        headers: {
            'Content-Type': 'application/json'
        }
    });
}
