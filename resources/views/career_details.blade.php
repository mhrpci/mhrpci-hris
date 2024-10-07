<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $hiring->position }} - Job Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0052CC;
            --secondary-color: #00875A;
            --accent-color: #0065FF;
            --background-color: #F4F5F7;
            --text-color: #172B4D;
            --border-color: #DFE1E6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 40px;
        }

        .nav-link {
            color: var(--text-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.2s ease, background-color 0.2s ease;
            border-radius: 4px;
        }

        .nav-link:hover, .nav-link:focus {
            color: var(--accent-color);
            background-color: rgba(0, 101, 255, 0.1);
        }

        /* Job Header Styles */
        .job-header {
            background-color: white;
            padding: 3rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .job-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .job-meta-item {
            display: flex;
            align-items: center;
            color: #5E6C84;
            font-size: 0.95rem;
        }

        .job-meta-item i {
            margin-right: 0.5rem;
            color: var(--secondary-color);
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: #0747A6;
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            color: var(--text-color);
            border-color: var(--border-color);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .btn-outline-secondary:hover, .btn-outline-secondary:focus {
            background-color: var(--border-color);
            color: var(--text-color);
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 2rem;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* List Styles */
        .custom-list {
            list-style: none;
            padding: 0;
        }

        .custom-list li {
            display: flex;
            align-items: start;
            margin-bottom: 1rem;
        }

        .custom-list li i {
            color: var(--secondary-color);
            margin-right: 1rem;
            margin-top: 0.25rem;
        }

        /* Related Jobs Styles */
        .related-job-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .related-job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        /* Modal Styles */
        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }

        .modal-title {
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .job-header {
                padding: 2rem 0;
            }

            .job-title {
                font-size: 1.75rem;
            }

            .job-meta {
                flex-direction: column;
                gap: 0.75rem;
            }

            .d-flex.gap-3 {
                flex-wrap: wrap;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .dropdown {
                width: 100%;
            }

            .dropdown-toggle {
                width: 100%;
                text-align: left;
            }
        }

        /* Accessibility Improvements */
        .btn:focus, .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 82, 204, 0.25);
        }

        /* Improved Readability */
        .job-description, .list-group-item {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        /* Sticky Apply Button for Mobile */
        @media (max-width: 768px) {
            .sticky-apply {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: white;
                padding: 1rem;
                box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
                z-index: 1000;
            }
        }

        /* Animated placeholder for images */
        .img-placeholder {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: placeholderShimmer 1.5s infinite;
        }

        @keyframes placeholderShimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        /* Tooltip styles */
        .custom-tooltip {
            position: relative;
            display: inline-block;
        }

        .custom-tooltip .tooltip-text {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .custom-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO4.png') }}" alt="MHR Logo" height="30" class="d-inline-block align-top me-2">
                    MHRPCI
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/careers">Careers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('saved-jobs') ? 'active' : '' }}" href="{{ url('/saved-jobs') }}">
                                Saved Jobs
                                <span class="badge bg-primary saved-jobs-count">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Job Header -->
    <section class="job-header">
        <div class="container">
            <h1 class="job-title">{{ $hiring->position }}</h1>
            <div class="job-meta">
                <div class="job-meta-item">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $hiring->location }}
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-briefcase"></i>
                    Full-time
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-clock"></i>
                    {{ $hiring->created_at->diffForHumans() }}
                </div>
                <div class="job-meta-item">
                    <i class="fas fa-users"></i>
                    {{ $hiring->department }}
                </div>
            </div>
            <div class="d-flex flex-wrap gap-3">
                <button class="btn btn-primary d-none d-md-inline-block" data-bs-toggle="modal" data-bs-target="#applyModal">
                    Apply Now
                </button>
                <button class="btn btn-outline-secondary save-hiring">
                    <i class="far fa-bookmark"></i>
                    <span>Save Job</span>
                </button>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-share-alt"></i>
                        Share
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="copyLink"><i class="fas fa-link me-2"></i>Copy Link</a></li>
                        <li><a class="dropdown-item" href="#" target="_blank"><i class="fab fa-twitter me-2"></i>Twitter</a></li>
                        <li><a class="dropdown-item" href="#" target="_blank"><i class="fab fa-linkedin me-2"></i>LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <!-- Job Details -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="card-title">Job Description</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 job-description">{!! nl2br(e($hiring->description)) !!}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Qualifications</h2>
                    </div>
                    <div class="card-body">
                        <ul class="custom-list">
                            @foreach(explode("\n", $hiring->requirements) as $requirement)
                                @if(!empty(trim($requirement)))
                                    <li>
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ trim($requirement) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="card-title">Benefits</h2>
                    </div>
                    <div class="card-body">
                        <ul class="custom-list">
                            @foreach(explode("\n", $hiring->benefits) as $benefit)
                                @if(!empty(trim($benefit)))
                                    <li>
                                        <i class="fas fa-gift"></i>
                                        <span>{{ trim($benefit) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Related Jobs</h2>
                    </div>
                    <div class="card-body">
                        @forelse($relatedJobs as $relatedJob)
                            @if($relatedJob->id !== $hiring->id)
                                <div class="card mb-3 border-0 shadow-sm related-job-card">
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
                        @empty
                            <p class="text-muted">No related jobs found at this time.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Company Name. All rights reserved.</p>
        </div>
    </footer>

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

    <!-- Sticky Apply Button for Mobile -->
    <div class="sticky-apply d-md-none">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#applyModal">
            Apply Now
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Save job functionality
            const saveButton = document.querySelector('.save-hiring');
            saveButton.addEventListener('click', function() {
                this.classList.toggle('btn-outline-secondary');
                this.classList.toggle('btn-success');
                const icon = this.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                this.querySelector('span').textContent = this.classList.contains('btn-success') ? 'Saved' : 'Save Job';
            });

            // Copy link functionality
            const copyLink = document.getElementById('copyLink');
            copyLink.addEventListener('click', function(e) {
                e.preventDefault();
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link copied to clipboard!');
                });
            });

            // Smooth scroll to sections
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Lazy loading for images
            const images = document.querySelectorAll('img[data-src]');
            const config = {
                rootMargin: '0px 0px 50px 0px',
                threshold: 0
            };

            let observer = new IntersectionObserver(function (entries, self) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        preloadImage(entry.target);
                        self.unobserve(entry.target);
                    }
                });
            }, config);

            images.forEach(image => {
                observer.observe(image);
            });

            function preloadImage(img) {
                const src = img.getAttribute('data-src');
                if (!src) { return; }
                img.src = src;
            }
        });
    </script>
</body>
</html>
