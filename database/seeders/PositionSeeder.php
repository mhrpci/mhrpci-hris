<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;
use Illuminate\Support\Facades\DB; // Import the DB facade

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['name' => 'IT Staff',  'department_id' => '5'],
            ['name' => 'HR Legal', 'department_id' => '1'],
            ['name' => 'HR COMBEN', 'department_id' => '1'],
            ['name' => 'HR Recruitment', 'department_id' => '1'],
            ['name' => 'HR Policy', 'department_id' => '1'],
            ['name' => 'Marketing Supervisor', 'department_id' => '4'],
            ['name' => 'Marketing Assistant', 'department_id' => '4'],
            ['name' => 'Product Specialist', 'department_id' => '4'],
            ['name' => 'PHSS', 'department_id' => '4'],
            ['name' => 'Finance Supervisor', 'department_id' => '2'],
            ['name' => 'Bookkeeper', 'department_id' => '2'],
            ['name' => 'Junior Bookkeeper', 'department_id' => '2'],
            ['name' => 'Credit and Collection', 'department_id' => '2'],
            ['name' => 'Billing Staff', 'department_id' => '2'],
            ['name' => 'Messenger Staff', 'department_id' => '2'],
            ['name' => 'Warehouse Man', 'department_id' => '6'],
            ['name' => 'Driver', 'department_id' => '6'],
            ['name' => 'Warehouse Supervisor', 'department_id' => '6'],
            ['name' => 'Warehouse Assistant', 'department_id' => '6'],
            ['name' => 'Warehouse Assistant', 'department_id' => '6'],
            ['name' => 'Executive Assistant', 'department_id' => '3'],
        ]);
    }
}
