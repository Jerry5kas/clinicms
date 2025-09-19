<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage clinics',
            'manage doctors',
            'manage staff',
            'manage patients',
            'manage appointments',
            'manage attendance',
            'manage payments',
            'manage invoices',
            'manage medical records',
            'manage medicines',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = [
            'Admin' => $permissions,
            'Clinic Manager' => [
                'manage doctors',
                'manage staff',
                'manage patients',
                'manage appointments',
                'manage attendance',
                'manage payments',
                'manage invoices',
                'view reports',
            ],
            'Doctor' => [
                'manage patients',
                'manage appointments',
                'manage medical records',
            ],
            'Staff' => [
                'manage patients',
                'manage appointments',
                'manage attendance',
                'manage payments',
                'manage invoices',
            ],
            'Patient' => [
                'manage appointments',
                'manage payments',
                'manage medical records',
            ],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        // 👇 Create default Admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.cms'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // Change in production
            ]
        );

        if (!$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }
    }
}

//php artisan db:seed --class=RolesAndPermissionsSeeder
