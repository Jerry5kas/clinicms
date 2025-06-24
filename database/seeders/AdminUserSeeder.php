<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        $roles = ['super admin', 'admin'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Super Admins
        $superAdmins = [
            [
                'name' => 'Super Admin One',
                'email' => 'superadmin1@example.com',
                'password' => 'superadmin123'
            ],
            [
                'name' => 'Super Admin Two',
                'email' => 'superadmin2@example.com',
                'password' => 'superadmin123'
            ]
        ];

        foreach ($superAdmins as $admin) {
            $user = User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                ]
            );
            $user->assignRole('super admin');
        }



        // Admins
        $admins = [
            [
                'name' => 'Admin One',
                'email' => 'admin1@example.com',
                'password' => 'admin123'
            ],
            [
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'password' => 'admin123'
            ],
            [
                'name' => 'Admin Three',
                'email' => 'admin3@example.com',
                'password' => 'admin123'
            ]
        ];

        foreach ($admins as $admin) {
            $user = User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                ]
            );
            $user->assignRole('admin');
        }
    }
}
