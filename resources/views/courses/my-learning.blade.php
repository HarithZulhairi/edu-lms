<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Learning - Edu Fairuzullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('layouts.navbar')

    <div class="container">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h2 class="mb-4">My Learning</h2>

        @if($courses->isEmpty())
            <div class="text-center py-5">
                <h4 class="text-muted">You are not enrolled in any courses yet.</h4>
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Browse Courses</a>
            </div>
        @else
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-success"> <img src="{{ asset('images/course_image.png') }}" class="card-img-top" alt="...">
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Instructor: {{ $course->educator->name ?? 'Unknown' }}
                                </h6>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($course->description, 80) }}
                                </p>
                                
                                <div class="progress mt-3" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">45% Complete</small>
                            </div>
                            
                            <div class="card-footer bg-white border-top-0">
                                <button class="btn btn-outline-success w-100">Continue Learning</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>