<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TravelerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('travelers')->insert([
            'id' => 'b3b9c903-55d9-40k9-a8db-e2c1bfb5352d',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'booking_id' => 'b1b2c903-55d9-40a9-a8db-e2c1bfb5352d',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
