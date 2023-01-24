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
        $admin->givePermissionTo(['dashboard', 'users.index', 'users.create', 'users.show', 'users.edit', 'users.delete', 'users.active', 'users.deactive', 'employees.index', 'employees.create', 'employees.show', 'employees.edit', 'employees.delete', 'employees.active', 'employees.deactive', 'strains.index', 'strains.create', 'strains.show', 'strains.edit', 'strains.delete', 'strains.active', 'strains.deactive', 'rooms.index', 'rooms.create', 'rooms.show', 'rooms.edit', 'rooms.delete', 'rooms.active', 'rooms.deactive', 'containers.index', 'containers.create', 'containers.show', 'containers.edit', 'containers.delete', 'containers.active', 'containers.deactive', 'harvests.index', 'harvests.create', 'harvests.show', 'harvests.edit', 'harvests.delete', 'harvests.active', 'harvests.deactive', 'stages.cured.index', 'stages.cured.create', 'stages.cured.show', 'stages.cured.edit', 'stages.cured.delete', 'stages.trimmed.index', 'stages.trimmed.create', 'stages.trimmed.show', 'stages.trimmed.edit', 'stages.trimmed.delete', 'stages.trimmed.empty', 'records.cured.index', 'records.cured.show', 'records.trimmed.index', 'records.trimmed.show', 'statistics.index', 'logs.index', 'settings.edit']);

        $supervisor=Role::where('name', 'Supervisor')->first();
        $supervisor->givePermissionTo(['dashboard', 'employees.index', 'employees.show', 'harvests.index', 'harvests.show', 'stages.cured.index', 'stages.cured.show', 'stages.trimmed.index', 'stages.trimmed.show']);

        $employee=Role::where('name', 'Trabajador')->first();
        $employee->givePermissionTo(['dashboard', 'stages.cured.index', 'stages.cured.create', 'stages.cured.show', 'stages.trimmed.index', 'stages.trimmed.create', 'stages.trimmed.show']);
    }
}
