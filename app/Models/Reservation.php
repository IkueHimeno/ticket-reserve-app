<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'performance_schedule_id',
        'seat_id',
        'user_id',
        'reservation_group_id',
    ];

    public function performanceSchedule()
    {
        return $this->belongsTo(PerformanceSchedule::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
