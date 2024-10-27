<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visitor::create([
            'user_id' => 1,
            'description' => 'Visit to discuss project details',
            'destination' => 'Meeting Room A',
            'duration' => '120', // durasi dalam menit
            'date_request' => Carbon::now(), // saat ini
            'status' => true,
        ]);

        Visitor::create([
            'user_id' => 2,
            'description' => 'Follow-up on the previous visit',
            'destination' => 'Office B',
            'duration' => '60',
            'date_request' => Carbon::now()->addDays(1), // besok
            'status' => false,
        ]);

        // Tambahkan lebih banyak data dummy sesuai kebutuhan
    }
}
