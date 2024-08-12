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
            'password' => Hash::make('admin@2024'),
            'profile_image' => 'profile_images/uWZGie62jcA4eWHo099w2bEGm7qUzl0i5M5d1swv.jpg',
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'first_name' => 'Admin', 
            'middle_name' => ' ',
            'last_name' => 'Assistant',
            'suffix' => ' ',
            'email' => 'admin@admin.com',
            'bio' => 'Admin',
            'password' => Hash::make('Letmein@2024'),
            'profile_image' => 'profile_images/cDp8F5Yur5u90Tq84fnoyJz8ibU3cHejkBXCZidK.png',
        ]);
        $admin->assignRole('Admin');

    }
}