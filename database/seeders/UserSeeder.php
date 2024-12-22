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
            ['email' => 'superadmin@parwestgroup.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('parwestadmin@123'),
                'active' => true,
            ]
        );

        $superadminRole = Role::where('name', 'superadmin')->first();
        if ($superadminRole) {
            $superAdmin->assignRole($superadminRole);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@parwestgroup.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin@123'),
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        $regularUsers = [
            ['name' => 'Faheem', 'email' => 'faheem@parwestgroup.com', 'password' => 'faheem@123'],
            ['name' => 'Ihsaan', 'email' => 'ihsaan@parwestgroup.com', 'password' => 'ihsaan@123'],
            ['name' => 'Sajid', 'email' => 'sajid@parwestgroup.com', 'password' => 'sajid@123'],
            ['name' => 'Ramzan', 'email' => 'ramzan@parwestgroup.com', 'password' => 'ramzan@123'],
            ['name' => 'Alexander', 'email' => 'alex@parwestgroup.com', 'password' => 'alex@123'],
        ];

        $userRole = Role::where('name', 'Receptionist')->first();
        foreach ($regularUsers as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            if ($userRole) {
                $user->assignRole($userRole);
            }
        }
    }
}
