<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\Module;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;
use App\Policies\CommentPolicy;
use App\Policies\ModulePolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Module::class, ModulePolicy::class);
        Gate::policy(Lesson::class, LessonPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}
