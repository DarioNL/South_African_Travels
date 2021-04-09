<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'id' => 'b4b9c903-55d9-10a9-a8db-e2c1bfb5352d',
            'country_id' => 'b3b9c903-55d9-10a9-a8db-e2c1bfb5352d',
            'name' => 'Vrijstaat',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
