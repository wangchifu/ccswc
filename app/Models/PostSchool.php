<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'code',
        'signed_user_id',
        'signed_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'signed_user_id','id');
    }
}
