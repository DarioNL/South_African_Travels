<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'id' => 'a3b2c903-25d9-40z9-a8db-e2c1bfb5352d',
            'date' => Carbon::today(),
            'user_id' => 'b3b2c903-55d9-40a9-a8db-e2c1bfb5352d',
            'travel_id' => 'b3b2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'price' => 78.54,
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
