<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $employee = Role::create(['name' => 'Employee']);

        $admin->givePermissionTo([
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
            'employee-list',
            'employee-create',
            'employee-edit',
            'employee-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'attendance-list',
            'attendance-create',
            'attendance-edit',
            'province-list',
            'province-create',
            'province-edit',
            'city-list',
            'city-create',
            'city-edit',
            'barangay-list',
            'barangay-create',
            'barangay-edit',
            'leave-list',
            'leave-create',
            'leave-edit',
            'type-list',
            'type-create',
            'type-edit',
            'holiday-list',
            'holiday-create',
            'holiday-edit',
            'contribution-list',
            'contribution-create',
            'contribution-edit',
            'admin',
            'post-show',

        ]);

        $employee->givePermissionTo([
            'attendance-create',
            'leave-create',
            'normal-employee',

        ]);
    }
}
