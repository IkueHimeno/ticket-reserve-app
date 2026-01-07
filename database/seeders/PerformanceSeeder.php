<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Performance;
use App\Models\PerformanceSchedule;

class PerformanceSeeder extends Seeder
{
    public function run(): void
    {
        $performance = Performance::create([
            'title' => '舞台「スペースなスペース」',
            'venue' => 'アトリエファンファーレ東池袋',
            's_price' => 10000,
            'a_price' => 6500,
        ]);

        $dates = [
            '2021-11-03 19:00',
            '2021-11-04 14:00', '2021-11-04 19:00',
            '2021-11-05 14:00', '2021-11-05 19:00',
            '2021-11-06 13:00', '2021-11-06 18:00',
            '2021-11-07 12:00', '2021-11-07 17:00',
        ];

        foreach ($dates as $date) {
            PerformanceSchedule::create([
                'performance_id' => $performance->id,
                'start_time' => $date,
            ]);
        }
    }
}
