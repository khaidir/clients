<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PPE;

class PpeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PPE::create([
            'type_id' => 1, // ID tipe PPE yang sesuai
            'code' => 'PPE-001',
            'merk' => '3M',
            'colour' => 'Red',
            'condition' => 'New',
            'notes' => 'Standard issue PPE.',
            'status' => true,
        ]);

        PPE::create([
            'type_id' => 2, // ID tipe PPE yang sesuai
            'code' => 'PPE-002',
            'merk' => 'DuPont',
            'colour' => 'Blue',
            'condition' => 'Used',
            'notes' => 'Previously used in site.',
            'status' => true,
        ]);

        // Tambahkan lebih banyak data dummy sesuai kebutuhan
    }
}