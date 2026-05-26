<?php
// php artisan db:seed --class=UserSeeder
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'company' => 'super_admin',
                'role' => 'SuperAdmin'
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'company' => 'Acme Corporation',
                'role' => 'EventOrganizer'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'company' => 'Globex Inc.',
                'role' => 'QueAdmin'
            ],
        ];

        foreach ($users as $data) {
            // Create or get user
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                $user = User::create([
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'password' => $data['password'],
                ]);
            }

            // Find company by name
            $company = Company::where('name', $data['company'])->first();
            if ($company) {
                // Attach via pivot (avoids duplicates)
                $user->companies()->syncWithoutDetaching([$company->id]);
            }

            // Find role by name and attach to user
            if (!empty($data['role'])) {
                $role = Role::where('name', $data['role'])->first();
                if ($role) {
                    $user->roles()->syncWithoutDetaching([$role->id]);
                }
            }
        }
    }
}

