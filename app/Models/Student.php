<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'code',
        'user_id',
        't1_sb',
        't1_sg',
        't1_fb',
        't1_fg',
        't2_sb',
        't2_sg',
        't2_fb',
        't2_fg',
        't3_sb',
        't3_sg',
        't3_fb',
        't3_fg',
        't4_sb',
        't4_sg',
        't4_fb',
        't4_fg',
        'a1_sb',
        'a1_sg',
        'a1_fb',
        'a1_fg',
        'a2_sb',
        'a2_sg',
        'a2_fb',
        'a2_fg',
        'a3_sb',
        'a3_sg',
        'a3_fb',
        'a3_fg',
        'a4_sb',
        'a4_sg',
        'a4_fb',
        'a4_fg',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
