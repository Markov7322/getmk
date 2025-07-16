<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Course::class);

        $query = Course::with('author');
        if (auth()->user()->role === 'author') {
            $query->where('author_id', auth()->id());
        }
        $courses = $query->get();

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
        ]);
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
            'price' => 'numeric|min:0',
        ]);

        $course = $request->user()->authoredCourses()->create($data);

        return redirect()->route('courses.show', $course);
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);
        $course->load('modules.lessons');

        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return Inertia::render('Courses/Edit', [
            'course' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
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
