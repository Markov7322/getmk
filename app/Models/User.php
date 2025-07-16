<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Progress;
use App\Models\LessonProgress;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function authoredCourses()
    {
        return $this->hasMany(Course::class, 'author_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->using(Enrollment::class)->withTimestamps();
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
