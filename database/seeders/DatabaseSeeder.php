<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'End User',
            'email' => 'enduser@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'HOD',
            'email' => 'hod@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Procurement',
            'email' => 'procurement@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Permit & Legal',
            'email' => 'permitlegal@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Dokter',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Buat pengguna biasa
        User::create([
            'name' => 'Labs Games',
            'email' => 'labs.games@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->call(CountriesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(SiaSeeder::class);
        $this->call(SiaPersonSeeder::class);
        $this->call(SiaExtendedSeeder::class);
        $this->call(PermissionGroupsSeeder::class);
        $this->call(RolesSeeder::class);

        $this->call(VisitorSeeder::class);
        $this->call(VisitorPersonSeeder::class);
        $this->call(VisitorPpeSeeder::class);
        $this->call(PpeSeeder::class);
        $this->call(PpeTypeSeeder::class);
        $this->call(HistorySeeder::class);
        $this->call(PicSeeder::class);
    }
}
