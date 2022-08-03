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
    }
}
