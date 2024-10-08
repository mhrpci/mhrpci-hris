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
            'profile_image' => 'profile_images/NaAuqoGCFtWNmvR67s0eHu64bkqiqDgMeus7kv8S.jpg',
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
            'profile_image' => 'profile_images/IXd0wu98U3pcXpQY5DN5vlbns8VAcGFEys9pFpdt.png',
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
            'profile_image' => 'profile_images/Xc6zeykiblGemJME7XQ89GkS88QAl89IN00CRd4p.png',
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
            'profile_image' => 'profile_images/XS2ujV6rEFPG6dwoSS5ITDo8cBuXGkOHI97FaasF.png',
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
            'profile_image' => 'profile_images/1o5JGmFUqymf6PRajUs8DW3Eesh9cICirLgbArwV.png',
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
           'profile_image' => 'profile_images/TR74WnsnJvyAYhuATgshTm4jysLNzwZba4OP3u7R.png',
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
        'profile_image' => 'profile_images/WSR2ZQQHWrmIwwZ9DeeFC2XxcGd9HhPoEl52hE4A.png',
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
        'profile_image' => 'profile_images/lPdE7GIKbJ165tDe5z17nqvmEV1iYZW4tDAzUaMd.png',
    ]);
    $hrhiring->assignRole('HR Hiring');
    }
}
