<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = "staffs";
    protected $fillable = [
        'staff_season_id',
        'title',
        'name',
        'sex',
        'ps',
        'code',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function staff_season()
    {
        return $this->belongsTo(StaffSeason::class);
    }
}
