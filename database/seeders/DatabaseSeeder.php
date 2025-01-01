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

        $this->call(PermissionGroupsSeeder::class);
        $this->call(RolesSeeder::class);

        User::create([
            'name' => 'Khaidir Hasan',
            'email' => 'khaidirhasan@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'pic',
            'email' => 'pic@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'security',
            'email' => 'security@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'safety',
            'email' => 'safety@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'enduser',
            'email' => 'enduser@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'legal',
            'email' => 'legal@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'hod',
            'email' => 'hod@gmail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'purchasing',
            'email' => 'purchasing@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $this->call(CountriesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(SiaSeeder::class);
        $this->call(SiaPersonSeeder::class);
        $this->call(SiaExtendedSeeder::class);

        $this->call(VisitorSeeder::class);
        $this->call(VisitorPersonSeeder::class);
        $this->call(VisitorPpeSeeder::class);
        $this->call(PpeSeeder::class);
        $this->call(PpeTypeSeeder::class);
        $this->call(HistorySeeder::class);
        $this->call(PicSeeder::class);
    }
}
