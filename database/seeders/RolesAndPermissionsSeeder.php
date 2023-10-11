<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::create(['name' => 'client']);
        // Role::create(['name' => 'admin']);

        // Permission::create(['name' => 'submit industrial visit request']);
        // Permission::create(['name' => 'manage industrial visit requests']);

        // $clientRole = Role::findByName('client');
        // $adminRole = Role::findByName('admin');

        // $clientRole->givePermissionTo('submit industrial visit request');
        // $adminRole->givePermissionTo('manage industrial visit requests');
    }
}
