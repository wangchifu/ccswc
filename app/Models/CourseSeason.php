<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSeason extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'season',
        'start_date',
        'code',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
