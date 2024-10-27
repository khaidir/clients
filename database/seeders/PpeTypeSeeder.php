<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PpeType;

class PpeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PpeType::create([
            'goods' => 'Helmet',
            'description' => 'Safety helmet for head protection.',
            'status' => true,
        ]);

        PpeType::create([
            'goods' => 'Gloves',
            'description' => 'Protective gloves for hand safety.',
            'status' => true,
        ]);

        PpeType::create([
            'goods' => 'Goggles',
            'description' => 'Safety goggles for eye protection.',
            'status' => true,
        ]);

        PpeType::create([
            'goods' => 'Mask',
            'description' => 'Protective mask for respiratory safety.',
            'status' => true,
        ]);

        // Tambahkan lebih banyak data dummy sesuai kebutuhan
    }
}
