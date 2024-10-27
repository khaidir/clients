<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiaExtendedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sia_extended')->insert([
            [
                'user_id' => 1,
                'company_id' => 10,
                'type_contract' => 'Full-Time',
                'periode_start' => '2023-01-01',
                'periode_end' => '2024-01-01',
                'requested_at' => Carbon::now()->subDays(30),
                'request_by' => 2,
                'approved_by' => 3,
                'verified_by' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'company_id' => 20,
                'type_contract' => 'Part-Time',
                'periode_start' => '2023-06-01',
                'periode_end' => '2024-06-01',
                'requested_at' => Carbon::now()->subDays(20),
                'request_by' => 5,
                'approved_by' => 6,
                'verified_by' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'company_id' => 30,
                'type_contract' => 'Contractor',
                'periode_start' => '2024-02-01',
                'periode_end' => '2025-02-01',
                'requested_at' => Carbon::now()->subDays(10),
                'request_by' => 8,
                'approved_by' => 9,
                'verified_by' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
