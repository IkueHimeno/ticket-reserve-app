<?php

namespace App\Http\Controllers;

use App\Models\PerformanceSchedule;
use App\Models\Reservation;
use App\Models\Seat;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $schedules = PerformanceSchedule::with('performance')->orderBy('start_time')->get();
        $totalSeats = 56;

        \Carbon\Carbon::setLocale('ja');

        $dates = $schedules->map(fn($s) => $s->start_time->isoFormat('MM/DD(ddd)'))->unique()->values();
        $times = $schedules->map(fn($s) => $s->start_time->format('H:i'))->unique()->sort()->values();

        $matrix = [];
        foreach ($schedules as $s) {
            $date = $s->start_time->isoFormat('MM/DD(ddd)');
            $time = $s->start_time->format('H:i');

            $reservedCount = Reservation::where('performance_schedule_id', $s->id)->count();
            $ratio = $reservedCount / $totalSeats;

            $status = '◯';
            $color = '#00ff7f';
            if ($ratio >= 1.0) { $status = '×'; $color = '#ff4f4f'; }
            elseif ($ratio >= 0.7) { $status = '△'; $color = '#ffcc00'; }

            $matrix[$time][$date] = [
                'id' => $s->id,
                'status' => $status,
                'color' => $color
            ];
        }

        return view('welcome', compact('dates', 'times', 'matrix'));
    }
}