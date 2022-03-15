<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pass_user_id',
        'title',
        'die_date',
        'content',        
        'for_schools',
        'situation',   
        'type',
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

    public function questions()
    {
        return $this->hasMany(Question::class)->where('show','1');
    }

    public function report_schools()
    {
        return $this->hasMany(ReportSchool::class);
    }
}
