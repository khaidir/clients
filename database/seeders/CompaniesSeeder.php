<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Companies;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Tech Solutions Ltd.',
                'address' => '123 Tech Street, Tech City',
                'phone' => '1234567890',
                'email' => 'info@techsolutions.com',
                'website' => 'https://techsolutions.com',
                'industry' => 'Technology',
            ],
            [
                'name' => 'HealthFirst Inc.',
                'address' => '456 Health Ave, Wellness City',
                'phone' => '0987654321',
                'email' => 'contact@healthfirst.com',
                'website' => 'https://healthfirst.com',
                'industry' => 'Healthcare',
            ],
            [
                'name' => 'Green Energy Co.',
                'address' => '789 Green Blvd, Energy Town',
                'phone' => '1122334455',
                'email' => 'support@greenenergy.com',
                'website' => 'https://greenenergy.com',
                'industry' => 'Energy',
            ],
        ];

        foreach ($companies as $company) {
            Companies::create($company);
        }
    }
}
