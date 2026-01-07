<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceSchedule extends Model
{
    use HasFactory;

    public function performance()
    {
        return $this->belongsTo(performance::class);

    }

    protected $casts = [
    'start_time' => 'datetime',
    ];
}
