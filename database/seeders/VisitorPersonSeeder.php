<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorPerson;
use Carbon\Carbon;

class VisitorPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisitorPerson::create([
            'visitor_id' => 1, // ID visitor yang sesuai
            'name' => 'John Doe',
            'citizenship' => 'Indonesia',
            'docs_citizenship' => 'KTP',
            'notes' => 'First time visitor.',
            'status' => true,
        ]);

        VisitorPerson::create([
            'visitor_id' => 1, // ID visitor yang sesuai
            'name' => 'Jane Smith',
            'citizenship' => 'American',
            'docs_citizenship' => 'Passport',
            'notes' => 'Important client.',
            'status' => true,
        ]);

        // Tambahkan lebih banyak data dummy sesuai kebutuhan
    }
}
