<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PicSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'name' => 'John Doe',
                'segment' => 'Sales',
                'description' => 'Point of Contact for Sales inquiries',
                'email' => 'khaidirhasan@gmail.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Jane Smith',
                'segment' => 'Support',
                'description' => 'Handles customer support requests',
                'email' => 'khaidirhasan@gmail.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'name' => 'Michale Johnson',
                'segment' => 'General',
                'description' => 'General inquiries without a specific person',
                'email' => 'khaidirhasan@gmail.com',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('pic')->insert($data);
    }
}
