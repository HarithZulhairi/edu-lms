<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edu Fairuzullah LMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
        .hero-section { padding: 80px 0; text-align: center; }
        .role-card { transition: transform 0.3s; border: none; shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .role-card:hover { transform: translateY(-10px); }
        .icon-box { font-size: 3rem; margin-bottom: 15px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="{{ asset('images/edu_logo.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top me-2">
                Edu Fairuzullah
            </a>
            <div class="d-flex">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm text-primary fw-bold">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2 fw-bold">Log in</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="container hero-section">
        <img src="{{ asset('images/edu_logo.png') }}" alt="Logo" width="180" height="180" class="d-inline-block align-text-top me-2">
        <h1 class="display-4 fw-bold text-dark">Welcome to Edu Fairuzullah</h1>
        <p class="lead text-muted">A Cloud-Based Learning Management System</p>
        <p class="mb-5">Choose your role to get started.</p>

        <div class="row justify-content-center">
            
            <div class="col-md-5 mb-4">
                <div class="card role-card h-100 p-4">
                    <div class="card-body text-center">
                        <div class="icon-box text-primary">👨‍🏫</div>
                        <h3 class="card-title">I am an Educator</h3>
                        <p class="card-text text-muted">
                            Create courses, upload materials, and manage student assessments.
                        </p>
                        <a href="{{ route('register', ['role' => 'educator']) }}" class="btn btn-primary btn-lg w-100 mt-3">
                            Join as Educator
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-4">
                <div class="card role-card h-100 p-4">
                    <div class="card-body text-center">
                        <div class="icon-box text-success">🎓</div>
                        <h3 class="card-title">I am a Learner</h3>
                        <p class="card-text text-muted">
                            Enroll in courses, access learning materials, and view your progress.
                        </p>
                        <a href="{{ route('register', ['role' => 'learner']) }}" class="btn btn-success btn-lg w-100 mt-3">
                            Join as Learner
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="text-center py-4 text-muted mt-5">
        <small>&copy; 2026 Edu Fairuzullah Sdn Bhd. All rights reserved.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>