<?php
namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

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
        return in_array($user->role, ['admin', 'author']);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->role === 'admin' || $lesson->module->course->user_id === $user->id;
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $this->update($user, $lesson);
    }
}
