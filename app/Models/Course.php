<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Enrollment;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'description',
        'price',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)->using(Enrollment::class)->withTimestamps();
    }
}
