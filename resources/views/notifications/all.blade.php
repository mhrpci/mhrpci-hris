@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-bell me-2 text-primary"></i>&nbsp;All Notifications&nbsp;
                                <span class="badge bg-primary rounded-pill ms-2" id="notification-count">
                                    {{ $allNotifications->flatten()->count() }}
                                </span>
                            </h5>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <button class="btn btn-outline-primary btn-sm" id="mark-all-read">
                                    <i class="fas fa-check-double me-1"></i>Mark All Read
                                </button>
                                <button class="btn btn-outline-danger btn-sm" id="clear-all">
                                    <i class="fas fa-trash-alt me-1"></i>Clear All
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="form-floating">
                                <select class="form-select" id="type-filter">
                                    <option value="all">All Types</option>
                                    <option value="leave">Leave Requests</option>
                                    <option value="cash_advance">Cash Advances</option>
                                </select>
                                <label>Filter by Type</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="form-floating">
                                <select class="form-select" id="status-filter">
                                    <option value="all">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <label>Filter by Status</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="form-floating">
                                <select class="form-select" id="read-filter">
                                    <option value="all">All</option>
                                    <option value="unread">Unread</option>
                                    <option value="read">Read</option>
                                </select>
                                <label>Filter by Read Status</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="search-filter" placeholder="Search...">
                                <label><i class="fas fa-search me-2"></i>Search Notifications</label>
                            </div>
                        </div>
                    </div>

                    <!-- Active Filters Display -->
                    <div class="active-filters mb-3" id="active-filters"></div>

                    <!-- Notifications List -->
                    <div class="notifications-container">
                        @forelse($allNotifications as $date => $notifications)
                            <div class="date-group mb-4">
                                <h6 class="date-header text-muted mb-3">
                                    {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
                                </h6>
                                
                                @foreach($notifications as $notification)
                                    <div class="notification-item card mb-3 notification-{{ $notification['type'] }} status-{{ $notification['status'] }} {{ $notification['is_read'] ? 'read' : 'unread' }}"
                                         data-type="{{ $notification['type'] }}"
                                         data-status="{{ $notification['status'] }}"
                                         data-read="{{ $notification['is_read'] ? 'read' : 'unread' }}"
                                         data-id="{{ $notification['id'] ?? '' }}">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="notification-icon rounded-circle p-2 {{ $notification['type'] === 'leave' ? 'bg-info' : 'bg-warning' }}">
                                                        <i class="{{ $notification['icon'] }} text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h6 class="mb-1 notification-title">{{ $notification['title'] }}</h6>
                                                    <p class="mb-1 text-muted notification-text">{{ $notification['text'] }}</p>
                                                    <div class="notification-meta">
                                                        <small class="text-muted me-3">
                                                            <i class="far fa-clock me-1"></i>{{ $notification['time_human'] }}
                                                        </small>
                                                        <span class="badge {{ $notification['status'] === 'pending' ? 'bg-warning' : ($notification['status'] === 'approved' ? 'bg-success' : 'bg-danger') }}">
                                                            {{ ucfirst($notification['status']) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item toggle-details" href="#" data-bs-toggle="collapse" 
                                                                   data-bs-target="#details-{{ $loop->parent->index }}-{{ $loop->index }}">
                                                                    <i class="fas fa-info-circle me-2"></i>View Details
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item mark-read" href="#">
                                                                    <i class="fas fa-check me-2"></i>Mark as Read
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-danger delete-notification" href="#">
                                                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Collapsible Details -->
                                            <div class="collapse mt-3" id="details-{{ $loop->parent->index }}-{{ $loop->index }}">
                                                <div class="card card-body bg-light border-0">
                                                    <div class="row">
                                                        @foreach($notification['details'] as $key => $value)
                                                            <div class="col-md-6 mb-2">
                                                                <strong class="text-primary">{{ ucfirst($key) }}:</strong> 
                                                                <span class="ms-2">{{ $value }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted">No notifications found</h5>
                                    <p class="text-muted">When you receive notifications, they will appear here.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="notification-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="fas fa-info-circle me-2"></i>
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div> -->

<style>
    .notification-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: transform 0.2s ease;
    }
    
    .notification-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        cursor: pointer;
    }
    
    .notification-item:hover .notification-icon {
        transform: scale(1.1);
    }
    
    .notification-item.unread {
        border-left-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.02);
    }
    
    .notification-item:hover {
        transform: translateX(5px);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .date-header {
        position: relative;
        display: inline-block;
        padding-right: 15px;
        font-weight: 600;
        color: #6c757d;
    }
    
    .date-header:after {
        content: '';
        position: absolute;
        top: 50%;
        right: -50px;
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, #dee2e6 0%, transparent 100%);
    }
    
    .notification-leave .notification-icon {
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    }
    
    .notification-cash_advance .notification-icon {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    }
    
    .notification-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .empty-state {
        animation: fadeIn 0.5s ease;
    }
    
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .filter-badge {
        background-color: #e9ecef;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }
    
    .filter-badge .remove-filter {
        cursor: pointer;
        color: #dc3545;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Status indicators */
    .status-pending .card-body {
        border-right: 4px solid #ffc107;
    }
    
    .status-approved .card-body {
        border-right: 4px solid #198754;
    }
    
    .status-rejected .card-body {
        border-right: 4px solid #dc3545;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .notification-item .row {
            gap: 1rem;
        }
        
        .notification-item .col-auto:last-child {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
        
        .notification-meta {
            flex-wrap: wrap;
        }
        
        .form-floating {
            z-index: 1;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap components
    const toastEl = document.getElementById('notification-toast');
    const toast = new bootstrap.Toast(toastEl);
    
    // Filter functionality
    const typeFilter = document.getElementById('type-filter');
    const statusFilter = document.getElementById('status-filter');
    const readFilter = document.getElementById('read-filter');
    const searchFilter = document.getElementById('search-filter');
    const notificationItems = document.querySelectorAll('.notification-item');
    const notificationCount = document.getElementById('notification-count');
    const activeFiltersContainer = document.getElementById('active-filters');
    
    function showToast(message, type = 'success') {
        const toastBody = document.querySelector('.toast-body');
        toastBody.textContent = message;
        toastEl.classList.remove('bg-success', 'bg-danger');
        toastEl.classList.add(`bg-${type}`);
        toast.show();
    }
    
    function updateActiveFilters() {
        activeFiltersContainer.innerHTML = '';
        const filters = [];
        
        if (typeFilter.value !== 'all') {
            filters.push({
                type: 'Type',
                value: typeFilter.options[typeFilter.selectedIndex].text
            });
        }
        
        if (statusFilter.value !== 'all') {
            filters.push({
                type: 'Status',
                value: statusFilter.options[statusFilter.selectedIndex].text
            });
        }
        
        if (readFilter.value !== 'all') {
            filters.push({
                type: 'Read Status',
                value: readFilter.options[readFilter.selectedIndex].text
            });
        }
        
        if (searchFilter.value) {
            filters.push({
                type: 'Search',
                value: searchFilter.value
            });
        }
        
        filters.forEach(filter => {
            const badge = document.createElement('div');
            badge.className = 'filter-badge';
            badge.innerHTML = `
                <span>${filter.type}: ${filter.value}</span>
                <i class="fas fa-times remove-filter" data-filter-type="${filter.type.toLowerCase()}"></i>
            `;
            activeFiltersContainer.appendChild(badge);
        });
    }
    
    function applyFilters() {
        let visibleCount = 0;
        const searchTerm = searchFilter.value.toLowerCase();
        
        notificationItems.forEach(item => {
            const type = item.dataset.type;
            const status = item.dataset.status;
            const read = item.dataset.read;
            const title = item.querySelector('.notification-title').textContent.toLowerCase();
            const text = item.querySelector('.notification-text').textContent.toLowerCase();
            
            const typeMatch = typeFilter.value === 'all' || type === typeFilter.value;
            const statusMatch = statusFilter.value === 'all' || status === statusFilter.value;
            const readMatch = readFilter.value === 'all' || read === readFilter.value;
            const searchMatch = searchTerm === '' || 
                              title.includes(searchTerm) || 
                              text.includes(searchTerm);
            
            if (typeMatch && statusMatch && readMatch && searchMatch) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        notificationCount.textContent = visibleCount;
        updateActiveFilters();
        
        // Show/hide date headers
        document.querySelectorAll('.date-group').forEach(group => {
            const hasVisibleNotifications = Array.from(group.querySelectorAll('.notification-item'))
                .some(item => item.style.display !== 'none');
            group.style.display = hasVisibleNotifications ? '' : 'none';
        });
    }
    
    // Event Listeners
    [typeFilter, statusFilter, readFilter].forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
    
    searchFilter.addEventListener('input', applyFilters);
    
    activeFiltersContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-filter')) {
            const filterType = e.target.dataset.filterType;
            switch(filterType) {
                case 'type':
                    typeFilter.value = 'all';
                    break;
                case 'status':
                    statusFilter.value = 'all';
                    break;
                case 'read status':
                    readFilter.value = 'all';
                    break;
                case 'search':
                    searchFilter.value = '';
                    break;
            }
            applyFilters();
        }
    });
    
    // Mark as read functionality
    document.querySelectorAll('.mark-read').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const item = this.closest('.notification-item');
            if (!item.classList.contains('read')) {
                item.classList.remove('unread');
                item.classList.add('read');
                item.dataset.read = 'read';
                
                // Update backend
                const notificationId = item.dataset.id;
                fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        showToast('Notification marked as read');
                    }
                });
            }
        });
    });
    
    // Delete notification
    document.querySelectorAll('.delete-notification').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const item = this.closest('.notification-item');
            const notificationId = item.dataset.id;
            
            if (confirm('Are you sure you want to delete this notification?')) {
                fetch(`/notifications/delete/${notificationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    if (response.ok) {
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.remove();
                            applyFilters();
                        }, 300);
                        showToast('Notification deleted successfully');
                    }
                });
            }
        });
    });
    
    // Bulk actions
    document.getElementById('mark-all-read').addEventListener('click', function() {
        fetch('/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(response => {
            if (response.ok) {
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                    item.classList.add('read');
                    item.dataset.read = 'read';
                });
                showToast('All notifications marked as read');
            }
        });
    });
    
    document.getElementById('clear-all').addEventListener('click', function() {
        if (confirm('Are you sure you want to clear all notifications?')) {
            fetch('/notifications/clear-all', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                if (response.ok) {
                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.style.opacity = '0';
                    });
                    setTimeout(() => {
                        document.querySelector('.notifications-container').innerHTML = `
                            <div class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted">No notifications found</h5>
                                    <p class="text-muted">When you receive notifications, they will appear here.</p>
                                </div>
                            </div>
                        `;
                    }, 300);
                    showToast('All notifications cleared');
                }
            });
        }
    });
    
    // Initialize filters
    applyFilters();
});
</script>
@endsection