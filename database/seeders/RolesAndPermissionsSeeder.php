<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {

        //gatepass perms
        Permission::firstOrCreate(['name' => 'checkin gatepass']);
        Permission::firstOrCreate(['name' => 'delete gatepass']);
        Permission::firstOrCreate(['name' => 'print gatepass']);
        Permission::firstOrCreate(['name' => 'view gatepass']);
        Permission::firstOrCreate(['name' => 'edit gatepass']);
        Permission::firstOrCreate(['name' => 'remove gatepass']);
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'manage roles']);

        $userRole = Role::firstOrCreate(['name' => 'Receptionist']);
        $userRole->givePermissionTo(['checkin gatepass', 'print gatepass']); 
        
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $permissions = Permission::all(); 
        $superadminRole->givePermissionTo($permissions); 

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = $permissions->where('name', '!=', 'manage users');
        $adminRole->givePermissionTo($adminPermissions);
    }
}
