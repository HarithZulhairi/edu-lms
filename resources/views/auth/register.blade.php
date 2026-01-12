<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Edu Fairuzullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @php
        // 1. Capture the Role from URL (default to learner)
        $role = request('role', 'learner');
        $isEducator = $role === 'educator';

        // 2. Set Dynamic Colors
        $bgClass   = $isEducator ? 'bg-primary' : 'bg-success'; // Blue vs Green Header
        $btnClass  = $isEducator ? 'btn-primary' : 'btn-success'; // Blue vs Green Button
        $cardTitle = $isEducator ? 'Educator Registration' : 'Student Registration';
    @endphp

    <style>
        body { background-color: #f0f2f5; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px 0; }
        .register-card { width: 100%; max-width: 500px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 12px; overflow: hidden;}
        .register-header { padding: 30px 20px; text-align: center; color: white; }
        .role-switch { text-align: center; margin-bottom: 20px; font-size: 0.9rem; }
        .role-switch a { text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex flex-column align-items-center">
                
                <div class="role-switch mb-3">
                    <span class="text-muted">Wrong portal? Switch to:</span><br>
                    @if($isEducator)
                        <a href="{{ route('register', ['role' => 'learner']) }}" class="text-success">Student Registration</a>
                    @else
                        <a href="{{ route('register', ['role' => 'educator']) }}" class="text-primary">Educator Registration</a>
                    @endif
                </div>

                <div class="card register-card">
                    <div class="register-header {{ $bgClass }}">
                        <h3 class="fw-bold mb-0">{{ $cardTitle }}</h3>
                        <small>Create your Edu Fairuzullah Account</small>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <input type="hidden" name="role" value="{{ $role }}">

                            <div class="mb-3">
                                <label for="name" class="form-label text-muted">Full Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-muted">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-muted">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-muted">Confirm Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mt-1" />
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn {{ $btnClass }} btn-lg">
                                    Register
                                </button>
                            </div>

                            <div class="text-center">
                                <span class="text-muted small">Already registered?</span>
                                <a href="{{ route('login', ['role' => $role]) }}" class="fw-bold text-decoration-none {{ $isEducator ? 'text-primary' : 'text-success' }}">
                                    Log in
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="/" class="text-muted text-decoration-none small">&larr; Back to Landing Page</a>
                </div>

            </div>
        </div>
    </div>

</body>
</html>