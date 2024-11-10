<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'sia' => ['create', 'read', 'update', 'delete'],
            'sia-person' => ['create', 'read', 'update', 'delete'],
            'sia-extended' => ['create', 'read', 'update', 'delete'],
            'visitor-access' => ['create', 'read', 'update', 'delete'],
            'company' => ['create', 'read', 'update', 'delete'],
        ];

        foreach ($permissions as $key => $actions) {
            foreach ($actions as $action) {
                Permission::create(['name' => "{$key}-{$action}", 'permission_group_id' => 1]);
            }
        }

        // Buat roles dan tetapkan permissions
        $roles = [
            'administrator' => ['administrator'],
            'assistent' => ['assistent'],
            'operator' => ['operator'],
            'company' => ['company'],
            'personil' => ['personil'],
            'root' => ['root'],
        ];

        foreach ($roles as $role => $permissions) {
            $roleInstance = Role::create(['name' => $role]);
        }
    }
}
