<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSchool extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_id',
        'code',
        'signed_user_id',
        'review_user_id',
        'signed_at',
        'situation',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'signed_user_id', 'id');
    }

    public function review_user()
    {
        return $this->belongsTo(User::class, 'review_user_id', 'id');
    }
}
