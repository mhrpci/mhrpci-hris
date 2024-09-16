<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB; // Import the DB facade

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Human Resources Department', 'head_name' => 'Nikkei Tingson'],
            ['name' => 'Finance and Accounting Department', 'head_name' => 'Cheryl Gasang'],
            ['name' => 'Admin Department', 'head_name' => 'Janet R. Refugio'],
            ['name' => 'MHRHCI', 'head_name' => 'Alayza Cali-at'],
            ['name' => 'IT Department', 'head_name' => 'Michael H. Refugio'],
            ['name' => 'Warehouse Department', 'head_name' => 'Michael H. Refugio'],
        ]);
    }
}
