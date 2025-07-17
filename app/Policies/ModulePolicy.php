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
        return in_array($user->role, ['admin', 'author']);
    }

    public function update(User $user, Module $module): bool
    {
        return $user->role === 'admin' || $module->course->user_id === $user->id;
    }

    public function delete(User $user, Module $module): bool
    {
        return $this->update($user, $module);
    }
}
