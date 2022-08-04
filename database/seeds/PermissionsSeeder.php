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

        // Room Permissions
        $permission=Permission::where('name', 'rooms.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'rooms.index']);
            Permission::create(['name' => 'rooms.create']);
            Permission::create(['name' => 'rooms.show']);
            Permission::create(['name' => 'rooms.edit']);
            Permission::create(['name' => 'rooms.delete']);
            Permission::create(['name' => 'rooms.active']);
            Permission::create(['name' => 'rooms.deactive']);
        }

        // Container Permissions
        $permission=Permission::where('name', 'containers.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'containers.index']);
            Permission::create(['name' => 'containers.create']);
            Permission::create(['name' => 'containers.show']);
            Permission::create(['name' => 'containers.edit']);
            Permission::create(['name' => 'containers.delete']);
            Permission::create(['name' => 'containers.active']);
            Permission::create(['name' => 'containers.deactive']);
        }
    }
}
