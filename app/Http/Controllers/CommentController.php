<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('lesson')->latest()->get();
        return Inertia::render('Comments/Index', ['comments' => $comments]);
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
            'lesson_id' => 'required|exists:lessons,id',
            'content' => 'required|string',
        ]);

        $lesson = Lesson::findOrFail($data['lesson_id']);
        $this->authorize('view', $lesson);

        $comment = $request->user()->comments()->create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $this->authorize('view', $comment);
        return Inertia::render('Comments/Show', ['comment' => $comment->load('lesson')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return Inertia::render('Comments/Edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
