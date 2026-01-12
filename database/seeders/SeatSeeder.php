<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

        foreach ($rows as $row) {
            for ($num = 1; $num <= 8; $num++) {
                Seat::updateOrCreate(
                    [
                        'row_name' => $row,
                        'seat_number' => $num,
                    ],
                    [
                    'rank' => ($row === 'A') ? '宇宙人シート' : '地球人シート',
                    ]
                );
            }
        }
    }
}
