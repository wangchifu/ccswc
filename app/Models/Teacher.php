<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_season_id',
        'name',
        'sex',
        'course_name',
        'ps',
        'code',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teacher_season()
    {
        return $this->belongsTo(TeacherSeason::class);
    }
}
