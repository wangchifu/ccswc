<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pass_user_id',
        'category_id',
        'title',
        'content',
        'feedback_reason',
        'for_schools',
        'situation',
        'type',
        'views',
        'passed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pass_user()
    {
        return $this->belongsTo(User::class,'pass_user_id','id');
    }
}
