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
            width: 100%;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
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
            .nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
                font-size: 1.5rem;
                color: var(--primary-color);
                cursor: pointer;
            }

            .mobile-menu {
                display: none;
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                background-color: var(--white);
                padding: 1rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .mobile-menu.show {
                display: block;
            }

            .mobile-menu a {
                display: block;
                padding: 0.5rem 0;
                color: var(--text-color);
                text-decoration: none;
                font-weight: 500;
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
            <ul class="nav-links mobile-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
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

            @if($hirings->count() > 0)
                <div class="row">
                    @foreach($hirings as $hiring)
                        <div class="col-lg-6 mb-4">
                            <div class="career-item h-100 d-flex flex-column">
                                <h2 class="h4 mb-3">{{ $hiring->position }}</h2>
                                <p><strong>Description:</strong> {{ Str::limit($hiring->description, 150) }}</p>
                                {{-- <p class="mb-4"><strong>Requirements:</strong> {{ Str::limit($hiring->requirements, 150) }}</p> --}}
                                <div class="mt-auto">
                                    <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $hiring->id }}">
                                        <i class="fas fa-info-circle me-1"></i> View Details
                                    </button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-career-id="{{ $hiring->id }}">
                                        <i class="fas fa-paper-plane me-1"></i> Apply Now
                                    </button>
                                </div>
                            </div>

                            <!-- Details Modal -->
                            <div class="modal fade" id="detailsModal{{ $hiring->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $hiring->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel{{ $hiring->id }}">{{ $hiring->position }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="text-primary">Description:</h6>
                                            <p>{{ $hiring->description }}</p>
                                            <h6 class="text-primary mt-4">Requirements:</h6>
                                            <p>{{ $hiring->requirements }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-career-id="{{ $hiring->id }}" data-bs-dismiss="modal">Apply Now</button>
                                        </div>
                                    </div>
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
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!navLinks.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                    navLinks.classList.remove('show');
                }
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
</body>
</html>
