<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;

class PermissionGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionGroup::create([
            'name' => 'User Management',
            'slug' => 'user-management',
            'description' => 'Permissions related to user management like creating, editing users.',
        ]);

        PermissionGroup::create([
            'name' => 'Visitor',
            'slug' => 'visitor',
            'description' => 'Visitor related to visitor creating, editing allowed visitor.',
        ]);

        PermissionGroup::create([
            'name' => 'New Worker',
            'slug' => 'new-worker',
            'description' => 'New Worker related to visitor creating, editing.',
        ]);

        PermissionGroup::create([
            'name' => 'Extended',
            'slug' => 'extended',
            'description' => 'Extended related to visitor creating, editing allowed visitor.',
        ]);

        PermissionGroup::create([
            'name' => 'Company',
            'slug' => 'company',
            'description' => 'Company related to visitor creating, editing allowed.',
        ]);

        PermissionGroup::create([
            'name' => 'Goods',
            'slug' => 'goods',
            'description' => 'Goods related to visitor creating, editing allowed.',
        ]);

        PermissionGroup::create([
            'name' => 'Rules',
            'slug' => 'rules',
            'description' => 'Rules related to visitor creating, editing rules.',
        ]);

        PermissionGroup::create([
            'name' => 'Permissions',
            'slug' => 'permissions',
            'description' => 'Permissions related to visitor creating, editing permissions.',
        ]);
    }
}
