<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'answer',
        'report_id',
        'question_id',   
        'report_school_id',     
        'code',
    ];

    public function report_school()
    {
        return $this->belongsTo(ReportSchool::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
