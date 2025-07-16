<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Module;
use App\Models\Comment;
use App\Models\Progress;


class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [

        'module_id',

        'course_id',

        'title',
        'content',
        'video_url',
        'position',
    ];


    public function module()
    {
        return $this->belongsTo(Module::class);

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);

    }
}
