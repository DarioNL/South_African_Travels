<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travels')->insert([
            'id' => 'b3b2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'code' => 'bloe'.random_int(0, 9).random_int(0, 9,).random_int(0, 9,).random_int(0, 9,),
            'start_date' => Carbon::today()->startOfMonth(),
            'end_date' => Carbon::today()->endOfMonth(),
            'type' => 'Busreis',
            'destination_id' => 'a3b2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'price' => 79.53,
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
            'is_booked' => 1,
        ]);
    }
}
