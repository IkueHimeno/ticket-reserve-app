<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(PerformanceSchedule::class);
    }
}
