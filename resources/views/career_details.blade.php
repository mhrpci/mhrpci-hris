<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hiring->position }} - Job Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .job-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 0;
            position: relative;
            overflow: hidden;
        }
        .job-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image: radial-gradient(circle, #7000ff 10%, transparent 10%),
                              radial-gradient(circle, #7000ff 10%, transparent 10%);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            opacity: 0.05;
            transform: rotate(45deg);
            z-index: 0;
        }
        .job-header .container {
            position: relative;
            z-index: 1;
        }
        .job-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
        .job-meta {
            color: #6c757d;
        }
        .job-actions {
            margin-top: 20px;
        }
        .btn-apply {
            background-color: #7000ff;
            border-color: #7000ff;
        }
        .btn-apply:hover {
            background-color: #5c00d6;
            border-color: #5c00d6;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .related-jobs {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 20px;
        }
        .btn-saved {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }
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
            color: white;
        }

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

        /* New styles for shape overlays */
        .shape-overlay {
            position: fixed;
            z-index: -1;
            pointer-events: none;
        }

        .shape-1 {
            top: 10%;
            left: 5%;
            width: 300px;
            height: 300px;
            background-color: rgba(112, 0, 255, 0.1);
            border-radius: 50%;
        }

        .shape-2 {
            bottom: 15%;
            right: 10%;
            width: 200px;
            height: 200px;
            background-color: rgba(92, 0, 214, 0.1);
            transform: rotate(45deg);
        }

        .shape-3 {
            top: 40%;
            right: 20%;
            width: 150px;
            height: 150px;
            background-color: rgba(40, 167, 69, 0.1);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .shape-4 {
            bottom: 30%;
            left: 15%;
            width: 250px;
            height: 100px;
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 50px;
        }

        /* Add these new styles for navigation */
        .nav-links {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            color: var(--text-color);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
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

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #ffffff;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
                padding: 1rem 0;
                z-index: 1000;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                margin: 0;
            }

            .nav-links a {
                padding: 0.5rem 2rem;
                display: block;
                border-bottom: 1px solid #f0f0f0;
            }

            .mobile-menu-toggle {
                display: block;
                font-size: 1.5rem;
                color: #4a90e2;
                cursor: pointer;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        /* Enhanced navigation styles */
        header {
            background-color: #ffffff;
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
            color: #4a90e2;
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
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 0.5rem 0;
            display: inline-block;
        }

        .nav-links a:hover {
            color: #4a90e2;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #4a90e2;
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
            background-color: #4a90e2;
            color: white;
        }

        .saved-jobs-count {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: #4a90e2;
            cursor: pointer;
        }

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
                background-color: #ffffff;
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
        }

        .nav-links a.active {
            color: #4a90e2;
            font-weight: 700;
        }

        .nav-links a.active::after {
            visibility: visible;
            transform: scaleX(1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: auto;
            min-height: 100%;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card .card {
            height: auto;
        }

        .section-title {
            color: #4a90e2;
            border-bottom: 2px solid #4a90e2;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .list-group-item {
            border: none;
            padding: 10px 0;
        }

        .list-group-item i {
            color: #28a745;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .btn-outline-primary {
            color: #4a90e2;
            border-color: #4a90e2;
        }

        .btn-outline-primary:hover {
            background-color: #4a90e2;
            color: white;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
            padding-top: 0;
        }

        @media (max-width: 991px) {
            .card {
                margin-bottom: 20px;
            }
        }

        .related-jobs-card {
            height: auto;
        }

        .related-jobs-container {
            max-height: 600px; /* Adjust this value as needed */
            overflow-y: auto;
        }

        .related-jobs-container::-webkit-scrollbar {
            width: 6px;
        }

        .related-jobs-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .related-jobs-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .related-jobs-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
                /* Footer styles */
                footer {
            flex-shrink: 0;
            background-color: var(--white);
            color: var(--gray);
            padding: 20px 0;
        }
        /* Preloader styles */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
    }

    .preloader.fade-out {
        opacity: 0;
        visibility: hidden;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 3px solid #4a90e2;
        border-top: 3px solid #f39c12;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>
    <!-- Add preloader HTML -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Add shape overlays -->
    <div class="shape-overlay shape-1"></div>
    <div class="shape-overlay shape-2"></div>
    <div class="shape-overlay shape-3"></div>
    <div class="shape-overlay shape-4"></div>

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
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/careers') }}" class="{{ request()->is('careers*') ? 'active' : '' }}">Careers</a></li>
                <li>
                    <a href="{{ url('/saved-jobs') }}" class="{{ request()->is('saved-jobs') ? 'active' : '' }}">
                        Saved Jobs
                        <span class="badge saved-jobs-count">0</span>
                    </a>
                </li>
            </ul>
            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>

    <div class="job-header" style="margin-top: 60px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Careers</li>
                    <li class="breadcrumb-item active" aria-current="page">New Job Search</li>
                </ol>
            </nav>
            <h1 class="job-title">{{ $hiring->position }}</h1>
            <div class="job-meta">
                <span class="me-3">{{ $hiring->location }}</span>
                <span>{{ $hiring->job_type }}</span>
            </div>
            <div class="job-actions">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#applyModal">APPLY NOW</button>
                <button class="btn btn-outline-secondary save-hiring {{ in_array($hiring->id, $savedHirings) ? 'saved' : '' }}"
                    data-hiring-id="{{ $hiring->id }}">
                <i class="fas fa-bookmark me-1"></i>
                <span class="button-text">{{ in_array($hiring->id, $savedHirings) ? 'SAVED' : 'SAVE' }}</span>
                <span class="spinner"><i class="fas fa-spinner fa-spin"></i></span>
            </button>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-primary ms-2 dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-share-alt"></i> SHARE
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                        <li><a class="dropdown-item" href="#" id="copyLink"><i class="fas fa-link me-2"></i>Copy Link</a></li>
                        <li><a class="dropdown-item" href="#" id="shareTwitter"><i class="fab fa-twitter me-2"></i>Twitter</a></li>
                        <li><a class="dropdown-item" href="#" id="shareFacebook"><i class="fab fa-facebook-f me-2"></i>Facebook</a></li>
                        <li><a class="dropdown-item" href="#" id="shareLinkedIn"><i class="fab fa-linkedin-in me-2"></i>LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h2 class="section-title">Job Description</h2>
                        <p class="mb-4">{!! nl2br(e($hiring->description)) !!}</p>

                        <h2 class="section-title mt-5">Qualifications</h2>
                        <ul class="list-group list-group-flush">
                            @foreach(explode("\n", $hiring->requirements) as $requirement)
                                @if(trim($requirement) !== '')
                                    <li class="list-group-item">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        {{ trim($requirement) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="section-title">Benefits</h3>
                        <ul class="list-group list-group-flush">
                            @foreach(explode("\n", $hiring->benefits) as $benefit)
                                @if(trim($benefit) !== '')
                                    <li class="list-group-item">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        {{ trim($benefit) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card related-jobs-card">
                    <div class="card-body">
                        <h3 class="section-title">Related Jobs</h3>
                        <div class="related-jobs-container">
                            @foreach($relatedJobs as $relatedJob)
                                @if($relatedJob->id !== $hiring->id)
                                    <div class="card mb-3 border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $relatedJob->position }}</h5>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $relatedJob->location }}
                                                </small>
                                            </p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    {{ Str::limit($relatedJob->description, 100) }}
                                                </small>
                                            </p>
                                            <a href="{{ route('careers.show', $relatedJob->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
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
            // Add preloader script
    window.addEventListener('load', function() {
        const preloader = document.querySelector('.preloader');
        preloader.classList.add('fade-out');
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveButtons = document.querySelectorAll('.save-hiring');
            const savedJobsCount = document.querySelector('.saved-jobs-count');

            // Function to update the saved jobs count
            function updateSavedJobsCount() {
                const savedCount = document.querySelectorAll('.save-hiring.saved').length;
                savedJobsCount.textContent = savedCount;
            }

            // Initial count update
            updateSavedJobsCount();

            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const hiringId = this.dataset.hiringId;
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
                        updateSavedJobsCount();
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
                        updateSavedJobsCount();
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

            // Remove the existing "Highlight current page in navigation" code and replace it with:
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-links a').forEach(link => {
                if (link.classList.contains('active')) {
                    link.setAttribute('aria-current', 'page');
                }
            });

            // Add this new code for share functionality
            const shareDropdown = document.getElementById('shareDropdown');
            const copyLink = document.getElementById('copyLink');
            const shareTwitter = document.getElementById('shareTwitter');
            const shareFacebook = document.getElementById('shareFacebook');
            const shareLinkedIn = document.getElementById('shareLinkedIn');

            const currentUrl = window.location.href;
            const jobId = "{{ $hiring->id }}"; // Get the job ID
            const jobTitle = "{{ $hiring->position }}";
            const companyName = "MHR"; // Replace with your actual company name
            const jobDescription = "{{ Str::limit($hiring->description, 100) }}";

            function handleShareAction(e, shareFunction) {
                e.preventDefault();
                shareFunction();
            }

            function copyToClipboard(text) {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text)
                        .then(() => showToast('Link copied to clipboard!'))
                        .catch(err => {
                            console.error('Failed to copy: ', err);
                            showToast('Failed to copy link. Please try again.', 'error');
                        });
                } else {
                    // Fallback for older browsers
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    document.body.appendChild(textArea);
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        showToast('Link copied to clipboard!');
                    } catch (err) {
                        console.error('Failed to copy: ', err);
                        showToast('Failed to copy link. Please try again.', 'error');
                    }
                    document.body.removeChild(textArea);
                }
            }

            function shareOnTwitter() {
                const twitterText = `Check out this job opportunity: ${jobTitle} at ${companyName}\n\n${jobDescription}`;
                const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(twitterText)}&url=${encodeURIComponent(currentUrl)}`;
                window.open(twitterUrl, '_blank', 'width=550,height=420');
            }

            function shareOnFacebook() {
                const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
                window.open(facebookUrl, '_blank', 'width=550,height=420');
            }

            function shareOnLinkedIn() {
                const linkedInUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(currentUrl)}&title=${encodeURIComponent(jobTitle)}&summary=${encodeURIComponent(jobDescription)}&source=${encodeURIComponent(companyName)}`;
                window.open(linkedInUrl, '_blank', 'width=550,height=420');
            }

            copyLink.addEventListener('click', (e) => handleShareAction(e, () => copyToClipboard(`${currentUrl}?id=${jobId}`)));
            shareTwitter.addEventListener('click', (e) => handleShareAction(e, shareOnTwitter));
            shareFacebook.addEventListener('click', (e) => handleShareAction(e, shareOnFacebook));
            shareLinkedIn.addEventListener('click', (e) => handleShareAction(e, shareOnLinkedIn));

            // Add event listener for dropdown toggle
            shareDropdown.addEventListener('show.bs.dropdown', function () {
                // You can add analytics tracking here
                console.log('Share dropdown opened');
            });

            // Add this new code for mobile menu functionality
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const navLinks = document.getElementById('navLinks');

            mobileMenuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('show');
            });

            // Close menu when a link is clicked
            navLinks.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('show');
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', (event) => {
                if (!event.target.closest('nav') && navLinks.classList.contains('show')) {
                    navLinks.classList.remove('show');
                }
            });

            // Add this new code for the apply modal
            const applyModal = document.getElementById('applyModal');
            applyModal.addEventListener('show.bs.modal', function (event) {
                // You can add any additional logic here if needed
                console.log('Apply modal opened');
            });
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

    <!-- Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="applyModalLabel">Apply for {{ $hiring->position }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('careers.apply') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="hiring_id" value="{{ $hiring->id }}">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name" required>
                                <div class="invalid-feedback">Please enter your first name.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            <div class="invalid-feedback">Please enter your phone number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn Profile (optional)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="Enter your LinkedIn profile URL">
                            </div>
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
                            <div class="invalid-feedback">Please select your years of experience.</div>
                        </div>
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume (PDF)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf" required>
                            <div class="invalid-feedback">Please upload your resume in PDF format.</div>
                        </div>
                        <div class="mb-3">
                            <label for="coverLetter" class="form-label">Cover Letter (optional)</label>
                            <textarea class="form-control" id="coverLetter" name="cover_letter" rows="4" placeholder="Enter your cover letter"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agree_terms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the <a href="#" target="_blank">terms and conditions</a></label>
                            <div class="invalid-feedback">You must agree to the terms and conditions.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i> Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this script at the end of your file, just before the closing </body> tag -->
    <script>
        // Form validation
        (function () {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
