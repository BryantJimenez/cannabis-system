<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission to Access the Administrative Panel
        $permission=Permission::where('name', 'dashboard')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'dashboard']);
        }

        // User Permissions
        $permission=Permission::where('name', 'users.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'users.index']);
            Permission::create(['name' => 'users.create']);
            Permission::create(['name' => 'users.show']);
            Permission::create(['name' => 'users.edit']);
            Permission::create(['name' => 'users.delete']);
            Permission::create(['name' => 'users.active']);
            Permission::create(['name' => 'users.deactive']);
        }

        // Employee Permissions
        $permission=Permission::where('name', 'employees.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'employees.index']);
            Permission::create(['name' => 'employees.create']);
            Permission::create(['name' => 'employees.show']);
            Permission::create(['name' => 'employees.edit']);
            Permission::create(['name' => 'employees.delete']);
            Permission::create(['name' => 'employees.active']);
            Permission::create(['name' => 'employees.deactive']);
        }

        // Strain Permissions
        $permission=Permission::where('name', 'strains.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'strains.index']);
            Permission::create(['name' => 'strains.create']);
            Permission::create(['name' => 'strains.show']);
            Permission::create(['name' => 'strains.edit']);
            Permission::create(['name' => 'strains.delete']);
            Permission::create(['name' => 'strains.active']);
            Permission::create(['name' => 'strains.deactive']);
        }
    }
}
