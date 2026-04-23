<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->superAdmin()->create();
        Role::factory()->eventOrganizer()->create();
        Role::factory()->queAdmin()->create();
        Role::factory()->queEncoder()->create();

        User::factory()
            ->count(1)
            ->withRole('SuperAdmin')
            ->create();

        User::factory()
            ->count(1)
            ->withRole('EventOrganizer')
            ->create();

        User::factory()
            ->count(1)
            ->withRole('QueAdmin')
            ->create();
    }
}
