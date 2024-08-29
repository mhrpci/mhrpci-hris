<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'position-list',
            'position-create',
            'position-edit',
            'position-delete',
            'gender-list',
            'gender-create',
            'gender-edit',
            'gender-delete',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'province-list',
            'province-create',
            'province-edit',
            'province-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'barangay-list',
            'barangay-create',
            'barangay-edit',
            'barangay-delete',
            'type-list',
            'type-create',
            'type-edit',
            'type-delete',
            'attendance-list',
            'attendance-create',
            'attendance-edit',
            'attendance-delete',
            'employee-list',
            'employee-create',
            'employee-edit',
            'employee-delete',
            'leave-list',
            'leave-create',
            'leave-edit',
            'leave-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-show',
            'holiday-list',
            'holiday-create',
            'holiday-edit',
            'holiday-delete',
            'contribution-list',
            'contribution-create',
            'contribution-edit',
            'contribution-delete',
            'admin',
            'super-admin',
            'normal-employee',
         ];

          // Looping and Inserting Array's Permissions into Permission Table
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
