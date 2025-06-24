<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    public function run()
    {
        Statistic::create([
            'total_views' => 0,
            'active_services' => 22,
        ]);
    }
}
