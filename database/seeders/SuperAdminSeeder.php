<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'first_name' => 'System',
            'middle_name' => ' ',
            'last_name' => 'Admin',
            'suffix' => ' ',
            'email' => 'system@admin.com',
            'bio' => 'Sys Admin',
            'password' => Hash::make('mhrpci-admin@2024'),
            'profile_image' => '',
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'first_name' => 'Admin',
            'middle_name' => ' ',
            'last_name' => 'Administrator',
            'suffix' => ' ',
            'email' => 'admin@administrator.com',
            'bio' => 'Admin',
            'password' => Hash::make('Letmein@2024'),
            'profile_image' => '',
        ]);
        $admin->assignRole('Admin');

         // Creating HR Compliance User
         $finance = User::create([
            'first_name' => 'Finance',
            'middle_name' => ' ',
            'last_name' => 'Head',
            'suffix' => ' ',
            'email' => 'finance@head.com',
            'bio' => 'HR Compliance',
            'password' => Hash::make('Finance@2024'),
            'profile_image' => '',
        ]);
        $finance->assignRole('Finance');

         // Creating HR Compliance User
         $hrcompliance = User::create([
            'first_name' => 'HR',
            'middle_name' => ' ',
            'last_name' => 'Compliance',
            'suffix' => ' ',
            'email' => 'hr@compliance.com',
            'bio' => 'HR Compliance',
            'password' => Hash::make('HrCompliance@2024'),
            'profile_image' => '',
        ]);
        $hrcompliance->assignRole('HR  Compliance');

         // Creating HR ComBen User
         $hrcomben = User::create([
            'first_name' => 'HR',
            'middle_name' => ' ',
            'last_name' => 'ComBen',
            'suffix' => ' ',
            'email' => 'hr@comben.com',
            'bio' => 'HR ComBen',
            'password' => Hash::make('HrComben@2024'),
            'profile_image' => '',
        ]);
        $hrcomben->assignRole('HR ComBen');

           // Creating HR Policy User
       $hrhiring = User::create([
        'first_name' => 'HR',
        'middle_name' => ' ',
        'last_name' => 'Hiring',
        'suffix' => ' ',
        'email' => 'hr@hiring.com',
        'bio' => 'HR Hiring',
        'password' => Hash::make('HrHiring@2024'),
        'profile_image' => '',
    ]);
    $hrhiring->assignRole('HR Hiring');

        // Creating MHRHCI Admin User
        $mhrhci = User::create([
            'first_name' => 'MHRHCI',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'mhrhci@supervisor.com',
            'bio' => 'MHRHCI Admin',
            'password' => Hash::make('Mhrhci@2024'),
            'profile_image' => '',
            'department_id' => '3',
        ]);
        $mhrhci->assignRole('Supervisor');

        // Creating Supply Chain Admin User
        $supplyChain = User::create([
            'first_name' => 'Supply Chain',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'supply.chain@supervisor.com',
            'bio' => 'Supply Chain Admin',
            'password' => Hash::make('SupplyChain@2024'),
            'profile_image' => '',
            'department_id' => '4',
        ]);
        $supplyChain->assignRole('Supervisor');

        // Creating BGPDI Admin User
        $bgpdi = User::create([
            'first_name' => 'BGPDI',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'bgpdi@supervisor.com',
            'bio' => 'BGPDI Supervisor',
            'password' => Hash::make('Bgpdi@2024'),
            'profile_image' => '',
            'department_id' => '6',
        ]);
        $bgpdi->assignRole('Supervisor');

        // Creating VHI Admin User
        $vhi = User::create([
            'first_name' => 'VHI',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'vhi@supervisor.com',
            'bio' => 'VHI Supervisor',
            'password' => Hash::make('Vhi@2024'),
            'profile_image' => '',
            'department_id' => '5',
        ]);
        $vhi->assignRole('Supervisor');

        // Creating Finance Admin User
        $finance = User::create([
            'first_name' => 'Finance',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'finance@supervisor.com',
            'bio' => 'Finance Supervisor',
            'password' => Hash::make('Finance@supervisor2024'),
            'profile_image' => '',
            'department_id' => '2',
        ]);
        $finance->assignRole('Supervisor');

        // Creating HR Admin User
        $hr = User::create([
            'first_name' => 'HR',
            'middle_name' => ' ',
            'last_name' => 'Coordinator',
            'suffix' => ' ',
            'email' => 'hr@coordinator.com',
            'bio' => 'HR Coordinator',
            'password' => Hash::make('Hr@coordinator2024'),
            'profile_image' => '',
            'department_id' => '1',
        ]);
        $hr->assignRole('Supervisor');

        // Creating Admin Supervisor User
        $adminSupervisor = User::create([
            'first_name' => 'Admin',
            'middle_name' => ' ',
            'last_name' => 'Supervisor',
            'suffix' => ' ',
            'email' => 'admin@supervisor.com',
            'bio' => 'Admin Supervisor',
            'password' => Hash::make('Admin@supervisor2024'),
            'profile_image' => '',
            'department_id' => '3',
        ]);
        $adminSupervisor->assignRole('Supervisor');

        // Creating Product Manager User
        $productManager = User::create([
            'first_name' => 'Product',
            'middle_name' => ' ',
            'last_name' => 'Specialist',
            'suffix' => ' ',
            'email' => 'mrkgasst.mhrpci@gmail.com',
            'bio' => 'Product Manager',
            'password' => Hash::make('Product@manager2024'),
            'profile_image' => '',
            'department_id' => '',
        ]);
        $productManager->assignRole('Product Manager');

        // Creating Product Manager User
        $productManager = User::create([
            'first_name' => 'Marketing',
            'middle_name' => ' ',
            'last_name' => 'Assistant',
            'suffix' => ' ',
            'email' => 'csr.mhrhealthcare@gmail.com',
            'bio' => 'Marketing Assistant',
            'password' => Hash::make('Marketing@assistant2024'),
            'profile_image' => '',
            'department_id' => '',
        ]);
        $productManager->assignRole('Product Manager');
    }
}