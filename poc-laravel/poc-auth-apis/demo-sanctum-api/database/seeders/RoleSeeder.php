<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

// To run this seeder individually, use:
// php artisan db:seed --class=RoleSeeder
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'SuperAdmin',
            'EventOrganizer',
            'QueAdmin',
            'QueEncoder',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }
    }
}