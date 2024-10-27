<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sia')->insert([
            [
                'user_id' => 1,
                'company_id' => 10,
                'description' => 'Initial request for project A',
                'request_by' => 2,
                'approved_by' => 3,
                'doc_verified_by' => 4,
                'license_verified_by' => 5,
                'inducted_by' => 6,
                'evaluated_by' => 7,
                'dete_request' => Carbon::now()->subDays(30),
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'company_id' => 20,
                'description' => 'Safety assessment for project B',
                'request_by' => 8,
                'approved_by' => 9,
                'doc_verified_by' => 10,
                'license_verified_by' => 11,
                'inducted_by' => 12,
                'evaluated_by' => 13,
                'dete_request' => Carbon::now()->subDays(20),
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'company_id' => 30,
                'description' => 'Compliance check for project C',
                'request_by' => 14,
                'approved_by' => 15,
                'doc_verified_by' => 16,
                'license_verified_by' => 17,
                'inducted_by' => 18,
                'evaluated_by' => 19,
                'dete_request' => Carbon::now()->subDays(10),
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

// $table->integer('user_id')->nullable();
// $table->integer('company_id')->default(0);
// $table->string('name')->nullable();
// $table->string('dete_request')->nullable();
