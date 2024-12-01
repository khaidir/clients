<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('history')->insert([
            [
                'module' => 'Admin User',
                'action' => 'add',
                'description' => 'Penambahan Admin User',
                'status' => true,
            ],
            [
                'module' => 'Admin User',
                'action' => 'edit',
                'description' => 'Pengubahan data Admin User',
                'status' => true,
            ],
        ]);
    }
}
