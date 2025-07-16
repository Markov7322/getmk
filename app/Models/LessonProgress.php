<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\User;

class LessonProgress extends Model
{
    use HasFactory;

    protected $table = 'lesson_user';

    protected $fillable = [
        'lesson_id',
        'user_id',
        'completed_at',
    ];

    protected $dates = [
        'completed_at',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
