<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('author')->get();
        return Inertia::render('Courses/Index', ['courses' => $courses]);
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        return Inertia::render('Courses/Create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Course::class);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $course = $request->user()->authoredCourses()->create($data);
        return redirect()->route('courses.show', $course);
    }

    public function show(Course $course)
    {
        $course->load('modules');
        return Inertia::render('Courses/Show', ['course' => $course]);
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return Inertia::render('Courses/Edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $course->update($data);
        return redirect()->route('courses.show', $course);
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
        return redirect()->route('courses.index');
    }
}
