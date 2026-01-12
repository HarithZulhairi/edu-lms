<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Edu Fairuzullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            flex-direction: column; /* Added to stack card and back button */
        }
        .login-card {
            width: 100%;
            max-width: 900px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: white;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px; /* Space for the back button */
        }
        .login-sidebar {
            background: #2c3e50; /* Default Dark */
            color: white;
            padding: 40px;
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: background 0.5s ease;
        }
        .login-form-section {
            width: 60%;
            padding: 50px;
            background: white;
        }
        .role-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            justify-content: center;
        }
        .role-btn {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            width: 140px;
            background: white;
        }
        .role-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .role-btn.active {
            border-color: transparent;
            color: white;
            font-weight: bold;
        }
        /* Role Colors */
        .role-btn.active.learner-btn {
            background-color: #198754; /* Green */
            box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
        }
        .role-btn.active.educator-btn {
            background-color: #0d6efd; /* Blue */
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }
        
        .form-control {
            padding: 12px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border: 1px solid #eee;
        }
        .form-control:focus {
            background-color: white;
            box-shadow: none;
            border-color: #a0aec0;
        }
        .submit-btn {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s;
            border: none;
        }
        
        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #212529;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .login-sidebar { width: 100%; padding: 30px; }
            .login-form-section { width: 100%; padding: 30px; }
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="login-sidebar" id="sidebar">
            <h2 class="mb-3 fw-bold">Edu Fairuzullah</h2>
            <p class="mb-4 text-white-50">Welcome back! Please select your role to continue your journey.</p>
            <i class="fas fa-graduation-cap fa-5x mb-3" id="sidebarIcon"></i>
        </div>

        <div class="login-form-section">
            
            <h3 class="fw-bold text-center mb-4">Sign In</h3>

            <div class="role-selector">
                <div class="role-btn active learner-btn" onclick="selectRole('learner')">
                    <i class="fas fa-user-graduate fa-2x mb-2"></i><br>
                    Student
                </div>
                <div class="role-btn educator-btn" onclick="selectRole('educator')">
                    <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i><br>
                    Educator
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="role_context" id="roleInput" value="learner">

                <div class="mb-3">
                    <label class="form-label small text-muted fw-bold">EMAIL ADDRESS</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-bold">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label small text-muted" for="remember_me">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none text-muted">Forgot password?</a>
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success submit-btn text-white" id="submitBtn">
                        Login to Portal
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-muted small">New here?</span>
                    <a href="{{ route('register') }}" id="registerLink" class="fw-bold text-decoration-none text-success">
                        Create Student Account
                    </a>
                </div>

            </form>
        </div>
    </div>

    <a href="/" class="back-link">
        <i class="fas fa-arrow-left me-2"></i> Back to Home
    </a>

    <script>
        function selectRole(role) {
            const roleInput = document.getElementById('roleInput');
            const submitBtn = document.getElementById('submitBtn');
            const sidebar = document.getElementById('sidebar');
            const registerLink = document.getElementById('registerLink');
            const sidebarIcon = document.getElementById('sidebarIcon');
            
            const learnerBtn = document.querySelector('.learner-btn');
            const educatorBtn = document.querySelector('.educator-btn');

            roleInput.value = role;

            if (role === 'educator') {
                educatorBtn.classList.add('active');
                learnerBtn.classList.remove('active');
                sidebar.style.background = '#0d6efd'; 
                submitBtn.classList.remove('btn-success');
                submitBtn.classList.add('btn-primary');
                
                registerLink.textContent = "Create Educator Account";
                registerLink.href = "/register?role=educator";
                registerLink.classList.remove('text-success');
                registerLink.classList.add('text-primary');

                sidebarIcon.className = "fas fa-chalkboard-teacher fa-5x mb-3";

            } else {
                learnerBtn.classList.add('active');
                educatorBtn.classList.remove('active');
                sidebar.style.background = '#198754';
                submitBtn.classList.remove('btn-primary');
                submitBtn.classList.add('btn-success');

                registerLink.textContent = "Create Student Account";
                registerLink.href = "/register?role=learner";
                registerLink.classList.remove('text-primary');
                registerLink.classList.add('text-success');

                sidebarIcon.className = "fas fa-user-graduate fa-5x mb-3";
            }
        }
    </script>

</body>
</html>