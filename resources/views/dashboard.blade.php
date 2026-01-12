<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Edu Fairuzullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('layouts.navbar')
    
    <div class="container">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(Auth::user()->role === 'educator')
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Your Courses</h2>
                <a href="{{ route('courses.create') }}" class="btn btn-success">
                    + Create New Course
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    @if($courses->isEmpty())
                        <p class="text-muted text-center py-4">You haven't created any courses yet.</p>
                    @else
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <td class="fw-bold">{{ $course->title }}</td>
                                    <td>{{ Str::limit($course->description, 50) }}</td>
                                    <td>{{ $course->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            
                                            <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-sm btn-outline-warning fw-bold">
                                                Edit
                                            </a>

                                            <form action="{{ route('courses.destroy', $course->course_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-bold">Delete</button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        @else

            <h2 class="mb-4">Available Courses</h2>

            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('images/course_image.png') }}" class="card-img-top" alt="...">
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    By: {{ $course->educator->name ?? 'Unknown' }}
                                </h6>
                                <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                            </div>
                            
                            <div class="card-footer bg-white border-top-0">
                                @if(in_array($course->course_id, $myEnrollments ?? []))
                                    <button class="btn btn-secondary w-100" disabled>Already Enrolled</button>
                                @else
                                    <form action="{{ route('courses.enroll', $course->course_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">Enroll Now</button>
                                    </form>
                                @endif
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