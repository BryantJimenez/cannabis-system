<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role=Role::where('name', 'Super Admin')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Super Admin']);
    	}
        
        $role=Role::where('name', 'Administrador')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Administrador']);
    	}

        $role=Role::where('name', 'Supervisor')->first();
        if (is_null($role)) {
            Role::create(['name' => 'Supervisor']);
        }

    	$role=Role::where('name', 'Trabajador')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Trabajador']);
    	}

        $superadmin=Role::where('name', 'Super Admin')->first();
        $superadmin->givePermissionTo(Permission::all());

        $admin=Role::where('name', 'Administrador')->first();
        $admin->givePermissionTo(Permission::all());

        $supervisor=Role::where('name', 'Supervisor')->first();
        $supervisor->givePermissionTo(['dashboard', 'employees.index', 'employees.show', 'harvests.index', 'harvests.show', 'stages.cured.index', 'stages.cured.show', 'stages.trimmed.index', 'stages.trimmed.show']);

        $employee=Role::where('name', 'Trabajador')->first();
        $employee->givePermissionTo(['dashboard', 'stages.cured.index', 'stages.cured.create', 'stages.cured.show', 'stages.trimmed.index', 'stages.trimmed.create', 'stages.trimmed.show']);
    }
}
