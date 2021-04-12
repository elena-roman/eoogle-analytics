<?php

namespace Database\Seeders;

use App\Models\Statistics;
use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statistics::factory()
            ->count(50)
            ->create();
    }
}
