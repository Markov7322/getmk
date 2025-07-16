<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;

class ModulePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Module $module): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['author', 'admin']);
    }

    public function update(User $user, Module $module): bool
    {
        return $user->role === 'admin' || $module->course->author_id === $user->id;
    }

    public function delete(User $user, Module $module): bool
    {
        return $this->update($user, $module);
    }

    public function restore(User $user, Module $module): bool
    {
        return $this->update($user, $module);
    }

    public function forceDelete(User $user, Module $module): bool
    {
        return $this->update($user, $module);
    }
}
