<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('module.course')->get();

        return Inertia::render('Lessons/Index', [
            'lessons' => $lessons,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Lesson::class);
        return Inertia::render('Lessons/Create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Lesson::class);

        $data = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'position' => 'integer|min:0',
        ]);

        $lesson = Lesson::create($data);

        return redirect()->route('lessons.show', $lesson);
    }

    public function show(Lesson $lesson)
    {
        $this->authorize('view', $lesson);

        return Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
        ]);
    }

    public function edit(Lesson $lesson)
    {
        $this->authorize('update', $lesson);
        return Inertia::render('Lessons/Edit', [
            'lesson' => $lesson,
        ]);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'position' => 'integer|min:0',
        ]);

        $lesson->update($data);

        return redirect()->route('lessons.show', $lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);
        $lesson->delete();
        return redirect()->back();
    }
}
