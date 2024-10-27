<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorPpe;

class VisitorPpeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisitorPpe::create([
            'visitor_id' => 1, // Ganti sesuai ID visitor yang ada
            'ppe_id' => 1,
            'date_pickup' => now(),
            'date_return' => now()->addDays(3), // Contoh pengembalian 3 hari kemudian
            'notes' => 'Picked up PPE for site visit.',
            'status' => true,
        ]);

        VisitorPpe::create([
            'visitor_id' => 2, // Ganti sesuai ID visitor yang ada
            'ppe_id' => 2,
            'date_pickup' => now()->subDays(1), // Contoh pengambilan satu hari yang lalu
            'date_return' => now()->addDays(2), // Contoh pengembalian 2 hari kemudian
            'notes' => 'Picked up gloves for safety.',
            'status' => true,
        ]);

        // Tambahkan lebih banyak data dummy sesuai kebutuhan
    }
}
