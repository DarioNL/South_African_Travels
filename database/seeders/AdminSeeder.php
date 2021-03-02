<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 'b3b9c903-55d9-40a9-a8db-e2c1bfb5352d',
            'first_name' => 'John',
            'last_name' => 'Admin',
            'email' => 'testadmin@SAD.nl',
            'phone' => '092344569',
            'password' => Hash::make('@SAD2020'),
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ]);
    }
}
