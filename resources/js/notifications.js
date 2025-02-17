import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

class NotificationHandler {
    constructor() {
        this.notificationCount = 0;
        this.notificationList = document.getElementById('notification-list');
        this.notificationBadge = document.querySelector('.navbar-badge');
        this.initializeNotifications();
    }

    initializeNotifications() {
        if (window.Laravel.user) {
            this.listenForNotifications();
            this.loadExistingNotifications();
        }
    }

    listenForNotifications() {
        window.Echo.private(`App.Models.User.${window.Laravel.user.id}`)
            .notification((notification) => {
                this.handleNewNotification(notification);
            });
    }

    async loadExistingNotifications() {
        try {
            const response = await fetch('/notifications/get');
            const data = await response.json();
            this.updateNotificationCount(data.unread_count);
            this.renderNotifications(data.notifications);
        } catch (error) {
            console.error('Error loading notifications:', error);
        }
    }

    handleNewNotification(notification) {
        this.notificationCount++;
        this.updateNotificationCount(this.notificationCount);
        this.addNotificationToList(notification);
        this.showToast(notification);
    }

    updateNotificationCount(count) {
        this.notificationCount = count;
        if (this.notificationBadge) {
            this.notificationBadge.textContent = count;
            this.notificationBadge.style.display = count > 0 ? 'block' : 'none';
        }
    }

    addNotificationToList(notification) {
        if (!this.notificationList) return;

        const notificationHtml = this.createNotificationHtml(notification);
        this.notificationList.insertAdjacentHTML('afterbegin', notificationHtml);
    }

    createNotificationHtml(notification) {
        let icon, title, description;

        if (notification.type.includes('LeaveRequestNotification')) {
            icon = 'fa-calendar';
            title = 'Leave Request';
            description = `${notification.employee_name} - ${notification.leave_type}`;
        } else if (notification.type.includes('CashAdvanceNotification')) {
            icon = 'fa-money-bill';
            title = 'Cash Advance Request';
            description = `${notification.employee_name} - ₱${notification.amount}`;
        }

        return `
            <a href="#" class="dropdown-item notification-item ${notification.read_at ? '' : 'unread'}" 
               data-notification-id="${notification.id}">
                <div class="notification-icon">
                    <i class="fas ${icon}"></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">${title}</div>
                    <div class="notification-text">${description}</div>
                    <div class="notification-time">
                        ${moment(notification.timestamp).fromNow()}
                    </div>
                </div>
            </a>
        `;
    }

    showToast(notification) {
        const toast = new bootstrap.Toast(document.createElement('div'));
        toast.element.innerHTML = this.createToastHtml(notification);
        document.querySelector('.toast-container').appendChild(toast.element);
        toast.show();

        // Remove toast after it's hidden
        toast.element.addEventListener('hidden.bs.toast', () => {
            toast.element.remove();
        });
    }

    createToastHtml(notification) {
        let icon, title;
        
        if (notification.type.includes('LeaveRequestNotification')) {
            icon = 'fa-calendar';
            title = 'New Leave Request';
        } else if (notification.type.includes('CashAdvanceNotification')) {
            icon = 'fa-money-bill';
            title = 'New Cash Advance Request';
        }

        return `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header">
                    <i class="fas ${icon} mr-2"></i>
                    <strong class="mr-auto">${title}</strong>
                    <small>${moment(notification.timestamp).fromNow()}</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    ${notification.employee_name} has submitted a new request.
                </div>
                <div class="toast-progress"></div>
            </div>
        `;
    }
}

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', () => {
    new NotificationHandler();
});

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

document.addEventListener('DOMContentLoaded', function() {
    // Initialize notification system
    initializeNotifications();

    // Set up polling for notifications
    setInterval(fetchNotifications, 30000); // Poll every 30 seconds
});

function initializeNotifications() {
    // Set up CSRF token for AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

    // Initialize Pusher
    const pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        encrypted: true
    });

    // Subscribe to the notifications channel
    const channel = pusher.subscribe('notifications');
    
    // Listen for new notifications
    channel.bind('new-notification', function(data) {
        updateNotificationUI(data);
        playNotificationSound();
    });
}

function fetchNotifications() {
    axios.get('/notifications/data')
        .then(response => {
            updateNotificationUI(response.data);
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
}

function updateNotificationUI(data) {
    // Update notification counter
    const counter = document.getElementById('notification-counter');
    if (counter) {
        counter.textContent = data.count;
        counter.style.display = data.count > 0 ? 'inline-block' : 'none';
    }

    // Update notification dropdown
    const dropdown = document.getElementById('notification-dropdown');
    if (dropdown) {
        dropdown.innerHTML = data.notifications;
    }

    // Show toast notification if there's a new notification
    if (data.toast && data.toast.message) {
        showToast(data.toast);
    }
}

function showToast(toast) {
    // Create toast element
    const toastElement = document.createElement('div');
    toastElement.className = 'toast';
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');
    
    toastElement.innerHTML = `
        <div class="toast-header">
            <i class="${toast.icon} mr-2"></i>
            <strong class="mr-auto">${toast.title}</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            ${toast.message}
        </div>
    `;

    // Add toast to container
    const toastContainer = document.querySelector('.toast-container');
    if (toastContainer) {
        toastContainer.appendChild(toastElement);
        
        // Initialize Bootstrap toast
        const bsToast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 5000
        });
        
        bsToast.show();

        // Remove toast after it's hidden
        toastElement.addEventListener('hidden.bs.toast', function() {
            toastElement.remove();
        });
    }
}

function playNotificationSound() {
    const audio = new Audio('/notification-sound.mp3');
    audio.play().catch(error => {
        console.error('Error playing notification sound:', error);
    });
}

// Mark notification as read
function markAsRead(notificationId) {
    axios.post(`/notifications/${notificationId}/read`)
        .then(response => {
            // Update UI to reflect the read status
            const notificationElement = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationElement) {
                notificationElement.classList.remove('unread');
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
}

// Clear all notifications
function clearAllNotifications() {
    axios.post('/notifications/clear-all')
        .then(response => {
            // Update UI to show no notifications
            const dropdown = document.getElementById('notification-dropdown');
            if (dropdown) {
                dropdown.innerHTML = `
                    <div class="empty-notifications">
                        <i class="fas fa-bell-slash"></i>
                        <p>No new notifications</p>
                    </div>
                `;
            }
            
            // Hide the counter
            const counter = document.getElementById('notification-counter');
            if (counter) {
                counter.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error clearing notifications:', error);
        });
}

