<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed companies
        $this->call(CompanySeeder::class);
        
        // Seed roles
        $this->call(RoleSeeder::class);

        // Seed users
        $this->call(UserSeeder::class);


        //Will use factory seeding later on
        //Seed 3 users of different type
        // User::factory()
        //     ->count(1)
        //     ->withRole('SuperAdmin')
        //     ->create();

        // User::factory()
        //     ->count(1)
        //     ->withRole('EventOrganizer')
        //     ->create();

        // User::factory()
        //     ->count(1)
        //     ->withRole('QueAdmin')
        //     ->create();
        
    }
}
