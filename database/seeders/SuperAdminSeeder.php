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
            'profile_image' => 'profile_images/pt0A0MAbtxRQPmfVe3wAeP80abZmIhUSzUSLTmVA.jpg',
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
            'profile_image' => 'profile_images/IJayaUxj1xqx9itjmnBCwTKx0Ct0GR3lNGVqKypo.png',
        ]);
        $admin->assignRole('Admin');


         // Creating HR Compliance User
         $hrcompliance = User::create([
            'first_name' => 'HR',
            'middle_name' => ' ',
            'last_name' => 'Compliance',
            'suffix' => ' ',
            'email' => 'hr@compliance.com',
            'bio' => 'HR Compliance',
            'password' => Hash::make('HrCompliance@2024'),
            'profile_image' => 'profile_images/OhijskJdfiaQmhdXpayOEoO1zDIbxSPQb8nKdQ1a.png',
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
            'profile_image' => 'profile_images/GJiZ0evJk5NqsJDBLoLTLjAYrh2ySBAhf0dI8Hng.png',
        ]);
        $hrcomben->assignRole('HR ComBen');


        // Creating IT Staff User
        $it = User::create([
           'first_name' => 'IT',
           'middle_name' => ' ',
           'last_name' => 'Staff',
           'suffix' => ' ',
           'email' => 'it@staff.inventory',
           'bio' => 'IT Inventory',
           'password' => Hash::make('Edssa#081021'),
           'profile_image' => 'profile_images/PvOHNzoyEK0ooforPZqCO2sj6KhVFCBFlvJ9Ekfx.png',
       ]);
       $it->assignRole('IT Staff');

       // Creating HR Policy User
       $hrpolicy = User::create([
        'first_name' => 'HR',
        'middle_name' => ' ',
        'last_name' => 'Policy',
        'suffix' => ' ',
        'email' => 'hr@policy.com',
        'bio' => 'HR Policy',
        'password' => Hash::make('HrPolicy@2024'),
        'profile_image' => 'profile_images/CG63ffa29NM1M1PWitEydKCTbZbcZxo6DSWyAro2.png',
    ]);
    $hrpolicy->assignRole('HR Policy');

           // Creating HR Policy User
       $hrhiring = User::create([
        'first_name' => 'HR',
        'middle_name' => ' ',
        'last_name' => 'Hiring',
        'suffix' => ' ',
        'email' => 'hr@hiring.com',
        'bio' => 'HR Hiring',
        'password' => Hash::make('HrHiring@2024'),
        'profile_image' => 'profile_images/CGiEkjD4gL1FyE23tFDjJYSmWBacgZnxDOQc4WBu.png',
    ]);
    $hrhiring->assignRole('HR Hiring');
    }
}
