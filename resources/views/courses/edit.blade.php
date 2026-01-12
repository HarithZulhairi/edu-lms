<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Course - Edu Fairuzullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    @include('layouts.navbar')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0 fw-bold text-primary">Edit Course</h4>
                    </div>

                    <div class="card-body p-4">
                        
                        <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
                            @csrf
                            @method('PUT') <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Course Title</label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $course->title) }}" 
                                       required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="6" 
                                          required>{{ old('description', $course->description) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-lg px-5">Update Course</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>