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
        $hrcompliance = Role::create(['name' => 'HR  Compliance']);
        $hrcomben = Role::create(['name' => 'HR ComBen']);
        $employee = Role::create(['name' => 'Employee']);
        $it = Role::create(['name' => 'IT Staff']);
        $hrpolicy = Role::create(['name' => 'HR Policy']);
        $hrhiring = Role::create(['name' => 'HR Hiring']);

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
            'loan-list',
            'loan-create',
            'loan-edit',
            'loan-delete',
            'admin',
            'post-show',

        ]);

        $hrcompliance->givePermissionTo([
            'employee-list',
            'employee-create',
            'employee-edit',
            'department-list',
            'department-create',
            'department-edit',
            'position-list',
            'position-create',
            'position-edit',
            'holiday-list',
            'post-list',
            'post-create',
            'post-edit',
            'hrcompliance',

        ]);
        $hrcomben->givePermissionTo([
            'attendance-list',
            'attendance-create',
            'attendance-edit',
            'holiday-list',
            'holiday-create',
            'holiday-edit',
            'leave-list',
            'leave-create',
            'payroll-list',
            'payroll-create',
            'payroll-edit',
            'contribution-list',
            'contribution-create',
            'contribution-edit',
            'overtime-list',
            'overtime-create',
            'overtime-edit',
            'loan-list',
            'loan-create',
            'loan-edit',
            'hrcomben',
        ]);

        $it->givePermissionTo([
            'inventory-list',
            'inventory-create',
            'inventory-edit',
            'inventory-delete',
            'it-staff',
        ]);
        $hrpolicy->givePermissionTo([
            'credential-list',
            'credential-create',
            'credential-edit',
            'credential-delete',
            'hrpolicy',
        ]);
        $hrhiring->givePermissionTo([
            'hiring-list',
            'hiring-create',
            'hiring-edit',
            'hrhiring',
        ]);

        $employee->givePermissionTo([
            'attendance-create',
            'leave-create',
            'payroll-list',
            'normal-employee',

        ]);
    }
}
