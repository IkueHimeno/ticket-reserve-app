<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    $reservations = \App\Models\Reservation::with(['performanceSchedule.performance', 'seat'])
        ->where('user_id', auth()->id())
        ->join('performance_schedules', 'reservations.performance_schedule_id', '=', 'performance_schedules.id') // スケジュールと結合
        ->orderBy('performance_schedules.start_time', 'asc') // 💡 公演が近い順（昇順）
        ->select('reservations.*')
        ->get();

    return view('dashboard', compact('reservations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/reservations/seats/{id}', [ReservationController::class, 'showSeatMap'])->name('reservations.seats');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/my-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

require __DIR__.'/auth.php';