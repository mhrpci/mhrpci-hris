<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            'Organizational Structure & Management',
            'Employee Conduct & Protocol',
            'Attendance & Leave Policies',
            'Compensation, Benefits & Privileges',
            'Facilities, Equipment & Company Property Use',
            'Staff House & Accommodation',
            'Reporting & Document Management',
            'Workplace Safety & Security',
            'Miscellaneous Policies',
            'Dress Code & Identification Policies',
            'Financial Assistance & Applications',
            'Workforce Management',
            'Employee Development & Education',
            'Employee Engagement & Recognition',
        ];

        foreach ($sections as $index => $section) {
            $sectionNumber = $index + 1;
            DB::table('sections')->insert([
                'name' => "Section {$sectionNumber}: {$section}",
                'section_number' => $sectionNumber,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
