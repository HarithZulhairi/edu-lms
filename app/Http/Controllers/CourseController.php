<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CourseController extends Controller
{
    /**
     * DASHBOARD LOGIC (The most important part)
     * Shows different views based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'educator') {
            // EDUCATOR VIEW: Show only courses THEY created
            $courses = Course::where('user_id', $user->user_id)->get();
            return view('dashboard', compact('courses'));
        } else {
            // LEARNER VIEW: Show ALL available courses
            // We also load the 'educator' relationship to display the teacher's name
            $courses = Course::with('educator')->get();
            
            // Get list of courses the student is already enrolled in
            $myEnrollments = $user->enrolledCourses()->pluck('courses.course_id')->toArray();

            return view('dashboard', compact('courses', 'myEnrollments'));
        }
    }

    /**
     * SHOW CREATE FORM (Educator Only)
     */
    public function create()
    {
        // Simple Security Check
        if (Auth::user()->role !== 'educator') {
            abort(403, 'Only educators can create courses.');
        }

        return view('courses.create');
    }

    /**
     * STORE NEW COURSE (CRUD: Create)
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'educator') {
            abort(403);
        }

        // 1. Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Create Data (Using the relationship)
        Auth::user()->courses()->create([
            'title' => $request->title,
            'description' => $request->description,
            // 'thumbnail_url' => ... (You can add file upload later if needed)
        ]);

        return redirect()->route('dashboard')->with('success', 'Course created successfully!');
    }

    /**
     * DELETE COURSE (CRUD: Delete)
     */
    public function destroy(Course $course)
    {
        // Security: Ensure only the OWNER can delete it
        if (Auth::id() !== $course->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $course->delete();

        return redirect()->route('dashboard')->with('success', 'Course deleted.');
    }

    public function myLearning()
    {
        $user = Auth::user();

        if ($user->role !== 'learner') {
            abort(403);
        }

        // Fetch courses the user is enrolled in
        $courses = $user->enrolledCourses; 

        return view('courses.my-learning', compact('courses'));
    }

    /**
     * UPDATE: ENROLL STUDENT
     * (Change redirect to the new My Learning page)
     */
    public function enroll(Course $course)
    {
        $user = Auth::user();

        if ($user->role !== 'learner') {
            abort(403, 'Only learners can enroll.');
        }

        $user->enrolledCourses()->syncWithoutDetaching([$course->course_id]);

        // CHANGED: Now redirects to 'my-learning' route
        return redirect()->route('courses.learning')
                         ->with('success', 'You have successfully enrolled in ' . $course->title . '!');
    }

    /**
     * SHOW EDIT FORM
     */
    public function edit(Course $course)
    {
        // Security: Ensure only the OWNER can edit
        if (Auth::id() !== $course->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('courses.edit', compact('course'));
    }

    /**
     * UPDATE COURSE (CRUD: Update)
     */
    public function update(Request $request, Course $course)
    {
        // Security Check
        if (Auth::id() !== $course->user_id) {
            abort(403);
        }

        // 1. Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Update Data
        $course->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Course updated successfully!');
    }
}