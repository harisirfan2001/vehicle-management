<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
      

        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@superadmin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'active' => true,
            ]
        );

        $superadminRole = Role::where('name', 'superadmin')->first();
        if ($superadminRole) {
            $superAdmin->assignRole($superadminRole);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // $regularUsers = [
        //     ['name' => 'name', 'email' => 'email', 'password' => 'password'],
        // ];
    }
}
