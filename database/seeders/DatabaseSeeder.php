<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FakeUserSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(TravelSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(AccommodationsSeeder::class);
    }
}
