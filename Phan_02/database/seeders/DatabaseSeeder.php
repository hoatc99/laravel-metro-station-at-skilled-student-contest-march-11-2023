<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RouteSeeder::class,
            StationSeeder::class,
        ]);

        DB::table('route_station')->insert([
            ['route_id' => 1, 'station_id' => 1],
            ['route_id' => 1, 'station_id' => 2],
            ['route_id' => 1, 'station_id' => 3],
            ['route_id' => 1, 'station_id' => 4],
            ['route_id' => 1, 'station_id' => 5],
            ['route_id' => 1, 'station_id' => 6],
            ['route_id' => 1, 'station_id' => 7],
            ['route_id' => 1, 'station_id' => 8],
            ['route_id' => 1, 'station_id' => 9],
            ['route_id' => 1, 'station_id' => 10],
            ['route_id' => 1, 'station_id' => 11],
            ['route_id' => 1, 'station_id' => 12],
            ['route_id' => 1, 'station_id' => 13],
            ['route_id' => 1, 'station_id' => 14],

            ['route_id' => 2, 'station_id' => 1],
            ['route_id' => 2, 'station_id' => 15],
            ['route_id' => 2, 'station_id' => 16],
            ['route_id' => 2, 'station_id' => 17],
            ['route_id' => 2, 'station_id' => 18],
            ['route_id' => 2, 'station_id' => 19],
            ['route_id' => 2, 'station_id' => 20],
            ['route_id' => 2, 'station_id' => 21],
            ['route_id' => 2, 'station_id' => 22],
            ['route_id' => 2, 'station_id' => 23],
            ['route_id' => 2, 'station_id' => 24],
            ['route_id' => 2, 'station_id' => 25],
            ['route_id' => 2, 'station_id' => 26],
            ['route_id' => 2, 'station_id' => 27],

            ['route_id' => 3, 'station_id' => 28],
            ['route_id' => 3, 'station_id' => 20],
            ['route_id' => 3, 'station_id' => 29],
            ['route_id' => 3, 'station_id' => 30],
            ['route_id' => 3, 'station_id' => 31],
            ['route_id' => 3, 'station_id' => 32],
            ['route_id' => 3, 'station_id' => 33],
            ['route_id' => 3, 'station_id' => 34],
            ['route_id' => 3, 'station_id' => 5],
        ]);
    }
}
