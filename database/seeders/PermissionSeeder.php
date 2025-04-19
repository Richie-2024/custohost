<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions relevant to hostel management
        $permissions = [
            // Student-related permissions
            'view hostel',
            'apply for room',
            'view room assignment',
            'cancel room application',

            // Hostel Manager permissions
            'view applications',
            'approve applications',
            'reject applications',
            'assign rooms',
            'view students',
            'manage rooms',
            'manage hostel rules',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Super Admin Role (optional: full access)
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Hostel Manager Role
        $hostelManager = Role::firstOrCreate(['name' => 'hostel_manager']);
        $hostelManager->givePermissionTo([
            'view applications',
            'approve applications',
            'reject applications',
            'assign rooms',
            'view students',
            'manage rooms',
            'manage hostel rules',
        ]);

        // Student Role
        $student = Role::firstOrCreate(['name' => 'student']);
        $student->givePermissionTo([
            'view hostel',
            'apply for room',
            'view room assignment',
            'cancel room application',
        ]);
    }
}
