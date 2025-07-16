<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::where('user_id', auth()->id())->with('course')->get();
        return Inertia::render('Enrollments/Index', [
            'enrollments' => $enrollments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $course = Course::findOrFail($data['course_id']);
        $this->authorize('view', $course);

        $enrollment = Enrollment::firstOrCreate([
            'course_id' => $course->id,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('courses.show', $course);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        $this->authorize('view', $enrollment->course);
        return Inertia::render('Enrollments/Show', ['enrollment' => $enrollment->load('course')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $this->authorize('delete', $enrollment->course);
        $enrollment->delete();
        return redirect()->back();
    }
}
