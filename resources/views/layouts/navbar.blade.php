@php
    // Determine theme colors based on role
    $isEducator = Auth::user()->role === 'educator';
    $navbarColor = $isEducator ? 'bg-primary' : 'bg-success'; // Blue vs Green
    $btnTextColor = $isEducator ? 'text-primary' : 'text-success'; // Blue Text vs Green Text
@endphp

<nav class="navbar navbar-expand-lg navbar-dark {{ $navbarColor }} shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/edu_logo.png') }}" alt="Logo" width="60" height="60" class="d-inline-block align-text-top me-2">
            
            Edu Fairuzullah
            @if($isEducator)
                <span class="badge bg-light text-primary ms-2" style="font-size: 0.7em;">Educator Portal</span>
            @else
                <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7em;">Student Portal</span>
            @endif
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav me-auto">
                
                @if($isEducator)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            My Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.create') ? 'active' : '' }}" href="{{ route('courses.create') }}">
                            Create Course
                        </a>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            Browse Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.learning') ? 'active' : '' }}" href="{{ route('courses.learning') }}">
                            My Learning
                        </a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                
                <li class="nav-item me-3 text-white">
                    <span class="fw-light">Welcome,</span> 
                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light {{ $btnTextColor }} fw-bold px-3 rounded-pill">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
</nav>