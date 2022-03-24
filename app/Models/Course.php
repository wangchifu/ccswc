<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_season_id',
        'type',
        'name',
        'place',
        'hour',
        'teacher',
        'time',
        'students',
        'situation',
        'code',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course_season()
    {
        return $this->belongsTo(CourseSeason::class);
    }
}
