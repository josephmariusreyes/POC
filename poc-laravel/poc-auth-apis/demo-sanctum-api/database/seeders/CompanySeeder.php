<?php
// To run this seeder individually, use:
// php artisan db:seed --class=CompanySeeder

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Acme Corporation',
                'description' => 'A leading provider of business solutions.',
            ],
            [
                'name' => 'Globex Inc.',
                'description' => 'Innovators in global logistics and supply chain.',
            ],
            [
                'name' => 'super_admin',
                'description' => 'Super admin',
            ],
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate(['name' => $company['name']], $company);
        }
    }
}
