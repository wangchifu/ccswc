<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'content',
        'resource',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
