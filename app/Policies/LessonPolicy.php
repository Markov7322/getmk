<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Lesson $lesson): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['author', 'admin']);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->role === 'admin' || $lesson->module->course->author_id === $user->id;
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $user->role === 'admin' || $lesson->module->course->author_id === $user->id;
    }

    public function restore(User $user, Lesson $lesson): bool
    {
        return $this->delete($user, $lesson);
    }

    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return $this->delete($user, $lesson);
    }
}
