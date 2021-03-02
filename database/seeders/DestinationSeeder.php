<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            'id' => 'a3b2c903-25d9-40a9-a8db-e2c1bfb5352d',
            'code' => 'bloe',
            'location' => 'bloemfontein',
            'country' => 'Zuid-Africa',
            'province' => 'Vrijstaat',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
