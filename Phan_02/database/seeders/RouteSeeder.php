<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Route::insert([
            ['name' => 'Tuyến số 1', 'uptime' => '5:00 - 21:00', 'distance' => 19.7, 'minimum_fare' => 12000, 'unit_price' => 4000],
            ['name' => 'Tuyến số 2', 'uptime' => '4:30 - 21:00', 'distance' => 9.1, 'minimum_fare' => 10000, 'unit_price' => 3000],
            ['name' => 'Tuyến số 5A', 'uptime' => '5:30 - 20:30', 'distance' => 5.2, 'minimum_fare' => 8000, 'unit_price' => 2000],
        ]);
    }
}
