<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accommodations')->insert([
            'code' => 'BlOE2637',
            'id' => 'a3s2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'destination_id' => 'a3b2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'type' => 'hotel',
            'chambers' => 4,
            'range' => 'zee',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
