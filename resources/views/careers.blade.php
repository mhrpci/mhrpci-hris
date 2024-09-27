<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers at MHR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f39c12;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --gray: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
        }

        /* Header and Navigation styles */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .app-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-left: 2rem;
            position: relative;
        }

        .nav-links a {
            color: var(--text-color);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 0.5rem 0;
            display: inline-block;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }

        .nav-links a:hover::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.25em 0.6em;
            border-radius: 50%;
            vertical-align: top;
            margin-left: 5px;
            background-color: var(--primary-color);
            color: var(--white);
        }

        .saved-jobs-count {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
        }

        /* Career item styles */
        .career-item {
            background-color: var(--white);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .career-item:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        .career-item h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .career-item p {
            color: var(--gray);
            margin-bottom: 20px;
        }

        /* Button styles */
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        /* Modal styles */
        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: var(--primary-color);
            color: var(--white);
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .modal-title {
            font-weight: 600;
        }

        /* Footer styles */
        footer {
            flex-shrink: 0;
            background-color: var(--white);
            color: var(--gray);
            padding: 20px 0;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            nav {
                padding: 0.5rem 1rem;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--white);
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                margin: 0;
            }

            .nav-links a {
                padding: 1rem;
                display: block;
                border-bottom: 1px solid #f0f0f0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .career-item {
                padding: 20px;
            }

            .btn {
                padding: 8px 16px;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        /* Add these new styles */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        /* Enhanced Background shapes */
        .bg-shape {
            position: fixed;
            z-index: -1;
        }

        .bg-shape-1 {
            top: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            background-color: rgba(74, 144, 226, 0.1);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        .bg-shape-2 {
            bottom: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background-color: rgba(243, 156, 18, 0.1);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite reverse;
        }

        .bg-shape-3 {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background-color: rgba(46, 204, 113, 0.1);
            border-radius: 50%;
            animation: pulse 10s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }

        /* Decorative elements */
        .decorative-icon {
            position: absolute;
            opacity: 0.1;
            color: var(--primary-color);
        }

        .icon-1 { top: 10%; left: 5%; font-size: 2rem; }
        .icon-2 { top: 30%; right: 8%; font-size: 1.5rem; }
        .icon-3 { bottom: 15%; left: 10%; font-size: 1.8rem; }

        .save-hiring.saved {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
            transition: all 0.3s ease;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .save-hiring.saved .fa-bookmark {
            animation: pulse 0.3s ease-in-out;
            color: white; /* Ensure icon is visible on green background */
        }

        /* Add these new styles */
        .save-hiring {
            position: relative;
            overflow: hidden;
        }

        .save-hiring .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .save-hiring.loading .spinner {
            display: inline-block;
        }

        .save-hiring.loading .button-text {
            visibility: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .save-hiring.saved .button-text {
            animation: fadeIn 0.3s ease-in-out;
        }

        .nav-links li:not(:last-child) {
            margin-right: 1rem;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.25em 0.6em;
            border-radius: 50%;
            vertical-align: top;
            margin-left: 5px;
        }

        .saved-jobs-count {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .nav-links a.active {
            color: var(--primary-color);
            font-weight: 700;
        }

        .nav-links a.active::after {
            visibility: visible;
            transform: scaleX(1);
        }

         /* Enhanced search bar styles */
    #careerSearch {
        border-radius: 50px;
        padding: 10px 20px 10px 40px;
        border: 2px solid var(--primary-color);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    #careerSearch:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.3);
    }

    #careerSearch::placeholder {
        color: #aaa;
    }

    .fa-search {
        font-size: 1rem;
        color: var(--primary-color);
    }
    </style>
</head>
<body>
    <!-- Add these elements just after the opening body tag -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>

    <!-- Decorative icons -->
    <i class="fas fa-briefcase decorative-icon icon-1"></i>
    <i class="fas fa-users decorative-icon icon-2"></i>
    <i class="fas fa-chart-line decorative-icon icon-3"></i>

    <header>
        <nav>
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHR Logo">
                </div>
                <div class="app-name">
                    MHRPCI
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/careers') }}" class="{{ request()->is('careers*') ? 'active' : '' }}">Careers</a></li>
<li>
                    <a href="{{ url('/saved-jobs') }}" class="{{ request()->is('saved-jobs') ? 'active' : '' }}">
                        Saved Jobs
                        <span class="badge saved-jobs-count">0</span>
                    </a>
                </li>
            </ul>
            <div class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        <div class="container" style="margin-top: 80px;">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h1 class="mb-4 text-center">Careers at MHR</h1>
            <p class="lead mb-5 text-center">Join our team and help revolutionize HR management!</p>

            <!-- Add this new search input with icon -->
            <div class="mb-4 position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" id="careerSearch" class="form-control ps-5" placeholder="Search for positions...">
            </div>

            @if($hirings->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 g-4" id="careerList">
                @foreach($hirings as $hiring)
                    <div class="col career-item-container">
                        <div class="career-item h-100 d-flex flex-column">
                            <h2 class="h4 mb-3">{{ $hiring->position }}</h2>
                                <p><strong>Description:</strong> {{ Str::limit($hiring->description, 150) }}</p>
                                <div class="mt-auto d-flex flex-wrap gap-2">
                                    <a href="{{ route('careers.show', $hiring->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-1"></i> View Details
                                    </a>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-career-id="{{ $hiring->id }}">
                                        <i class="fas fa-paper-plane me-1"></i> Apply Now
                                    </button>
                                    <button class="btn btn-outline-secondary save-hiring {{ in_array($hiring->id, $savedHirings) ? 'saved' : '' }}"
                                            data-hiring-id="{{ $hiring->id }}">
                                        <i class="fas fa-bookmark me-1"></i>
                                        <span class="button-text">{{ in_array($hiring->id, $savedHirings) ? 'Saved' : 'Save' }}</span>
                                        <span class="spinner"><i class="fas fa-spinner fa-spin"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">
                    <p class="mb-0">There are currently no open positions. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hiring_id" id="hiringIdInput">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn Profile (optional)</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="Enter your LinkedIn profile URL">
                        </div>
                        <div class="mb-3">
                            <label for="experience" class="form-label">Years of Experience</label>
                            <select class="form-select" id="experience" name="experience" required>
                                <option value="">Select experience</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-3">1-3 years</option>
                                <option value="3-5">3-5 years</option>
                                <option value="5+">5+ years</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume (PDF)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf" required>
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter (optional)</label>
                            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4" placeholder="Enter your cover letter"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the <a href="#" target="_blank">terms and conditions</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-1"></i> Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} MHR. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var applyModal = document.getElementById('applyModal');
            applyModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var careerId = button.getAttribute('data-career-id');
                var hiringIdInput = document.getElementById('hiringIdInput');
                hiringIdInput.value = careerId;
            });

            var alertElements = document.querySelectorAll('.alert');
            alertElements.forEach(function(alertElement) {
                setTimeout(function() {
                    var alert = new bootstrap.Alert(alertElement);
                    alert.close();
                }, 5000);
            });

            var mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            var navLinks = document.querySelector('.nav-links');

            mobileMenuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('show');
                this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!navLinks.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                    navLinks.classList.remove('show');
                    mobileMenuToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Highlight current page in navigation
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-links a').forEach(link => {
                if (link.classList.contains('active')) {
                    link.setAttribute('aria-current', 'page');
                }
            });

            // Save/Unsave hiring functionality
            var saveButtons = document.querySelectorAll('.save-hiring');
            saveButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var hiringId = this.getAttribute('data-hiring-id');
                    if (this.classList.contains('saved')) {
                        unsaveHiring(hiringId, this);
                    } else {
                        saveHiring(hiringId, this);
                    }
                });
            });

            function saveHiring(hiringId, button) {
                toggleSaveButton(button, true);

                fetch('{{ route("careers.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        hiring_id: hiringId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    toggleSaveButton(button, false);
                    if (data.success) {
                        updateSaveButtonState(button, true);
                        showToast('Job saved successfully!');
                        updateSavedJobsCount(); // Update count after saving
                    } else {
                        showToast(data.message || 'Error saving job. Please try again.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toggleSaveButton(button, false);
                    showToast('An error occurred. Please try again.', 'error');
                });
            }

            function unsaveHiring(hiringId, button) {
                toggleSaveButton(button, true);

                fetch('{{ route("unsave.hiring") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        hiring_id: hiringId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    toggleSaveButton(button, false);
                    if (data.success) {
                        updateSaveButtonState(button, false);
                        showToast('Job removed from saved list.');
                        updateSavedJobsCount(); // Update count after unsaving
                    } else {
                        showToast(data.message || 'Error removing job. Please try again.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toggleSaveButton(button, false);
                    showToast('An error occurred. Please try again.', 'error');
                });
            }

            function toggleSaveButton(button, isLoading) {
                button.classList.toggle('loading', isLoading);
                button.disabled = isLoading;
            }

            function updateSaveButtonState(button, isSaved) {
                button.classList.toggle('saved', isSaved);
                button.classList.toggle('btn-outline-secondary', !isSaved);
                button.classList.toggle('btn-success', isSaved);
                button.querySelector('.button-text').textContent = isSaved ? 'Saved' : 'Save';
                button.disabled = false;

                if (isSaved) {
                    const icon = button.querySelector('.fa-bookmark');
                    icon.classList.remove('fa-bookmark');
                    void icon.offsetWidth; // Trigger reflow
                    icon.classList.add('fa-bookmark');
                }
            }

            function showToast(message, type = 'success') {
                // Create and show a Bootstrap toast
                var toastHtml = `
                    <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;
                var toastContainer = document.createElement('div');
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                toastContainer.innerHTML = toastHtml;
                document.body.appendChild(toastContainer);

                var toast = new bootstrap.Toast(toastContainer.querySelector('.toast'));
                toast.show();

                // Remove the toast container after it's hidden
                toastContainer.addEventListener('hidden.bs.toast', function () {
                    document.body.removeChild(toastContainer);
                });
            }

            // Add this new function to update the saved jobs count
            function updateSavedJobsCount() {
                fetch('{{ route("saved-jobs.count") }}')
                    .then(response => response.json())
                    .then(data => {
                        const savedJobsCount = document.querySelector('.saved-jobs-count');
                        savedJobsCount.textContent = data.count;
                        savedJobsCount.style.display = 'inline-block'; // Always display the badge
                    })
                    .catch(error => console.error('Error fetching saved jobs count:', error));
            }

            // Call the function when the page loads
            updateSavedJobsCount();
        });
    </script>
    <script>
            // Allow right-click but prevent default context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault(); // Prevent the default context menu
                // Custom context menu logic can be added here if needed
            });

            // Disable F12, Ctrl+Shift+I, Ctrl+U
            document.addEventListener('keydown', function(e) {
                if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I') || (e.ctrlKey && e.key === 'U')) {
                    e.preventDefault();
                }
            });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('careerSearch');
    const careerList = document.getElementById('careerList');
    const careerItems = careerList.getElementsByClassName('career-item-container');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        Array.from(careerItems).forEach(function(item) {
            const position = item.querySelector('h2').textContent.toLowerCase();
            const description = item.querySelector('p').textContent.toLowerCase();

            if (position.includes(searchTerm) || description.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });

        // Show a message if no results are found
        const visibleItems = Array.from(careerItems).filter(item => item.style.display !== 'none');
        if (visibleItems.length === 0) {
            let noResultsMessage = document.getElementById('noResultsMessage');
            if (!noResultsMessage) {
                noResultsMessage = document.createElement('div');
                noResultsMessage.id = 'noResultsMessage';
                noResultsMessage.className = 'alert alert-info text-center mt-4';
                noResultsMessage.innerHTML = '<p class="mb-0">No positions found matching your search.</p>';
                careerList.parentNode.insertBefore(noResultsMessage, careerList.nextSibling);
            }
            noResultsMessage.style.display = '';
        } else {
            const existingMessage = document.getElementById('noResultsMessage');
            if (existingMessage) {
                existingMessage.style.display = 'none';
            }
        }
    });
});
    </script>
</body>
</html>
