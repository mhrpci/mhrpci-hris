<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing sections
        Section::truncate();

        // Create sections 1 through 20
        for ($i = 1; $i <= 20; $i++) {
            Section::create([
                'name' => "Section $i",
                'section_number' => $i
            ]);
        }
    }
}
