<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'id' => 'c3s2c903-25d9-40s9-a8db-e2c1bfb5352d',
            'accommodation_id' => 'a3s2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'name' => 'zwembad',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
