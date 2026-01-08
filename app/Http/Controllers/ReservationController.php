<?php

namespace App\Http\Controllers;

use App\Models\PerformanceSchedule;
use App\Models\Seat;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function showSeatMap($id)
    {
        $schedule = PerformanceSchedule::with('performance')->findOrFail($id);
        $seats = Seat::orderBy('row_name')->orderBy('seat_number')->get();
        $reservedSeatIds = Reservation::where('performance_schedule_id', $id)
            ->pluck('seat_id')
            ->toArray();

        return view('reservations.seat_map', compact('schedule', 'seats', 'reservedSeatIds'));
    }

    public function store(Request $request)
    {
        if(!$request->selected_seats)
        {
            return back()->with('error','座席を選択してください。');
        }

        $seatDataArray = explode('|', $request->selected_seats);

        $alreadyReservedByMe = Reservation::where('performance_schedule_id', $request->schedule_id)
                                        ->where('user_id', auth()->id())
                                        ->exists();
        if ($alreadyReservedByMe) {
            return redirect()->route('dashboard')->with('error', 'この公演はすでに予約済みです。');
        }

        DB::beginTransaction();

        try {
            foreach($seatDataArray as $data) {
                $parts = explode(',', $data);
                if (count($parts) !==2) continue;

                $row = trim($parts[0]);
                $num = trim($parts[1]);

                $seat = Seat::where('row_name', $row)
                            ->where('seat_number', $num)
                            ->first();
                
                if($seat) {
                    $isAlreadyReserved = Reservation::where('performance_schedule_id', $request->schedule_id)
                        ->where('seat_id', $seat->id)
                        ->lockForUpdate()
                        ->exists();
                    
                    if ($isAlreadyReserved) {
                        throw new \Exception("座席 {$row}-{$num} は空いていません。");
                    }

                    Reservation::create([
                        'user_id' => auth()->id(),
                        'performance_schedule_id' => $request->schedule_id,
                        'seat_id' => $seat->id,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('dashboard')
                             ->with('success', '予約が完了しました');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('reservations.seats', $request->schedule_id)
                             ->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $reservations = Reservation::with(['performanceSchedule.performance', 'seat'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

            return view('reservations.dashboard', compact('reservations'));
    }

    public function destroy(Reservation $reservation)
    {
        if($reservation->user_id !== auth()->id()) {
            return back()->with('error', 'この予約をキャンセルすることはできません');
        }

        $reservation->delete();

        return back()->with('error', '予約をキャンセルしました。');
    }
}