<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\HolidayController;

class FetchHolidays extends Command
{
    protected $signature = 'holidays:fetch';
    protected $description = 'Fetch holidays from Google Calendar';

    public function handle()
    {
        $controller = new HolidayController();
        $result = $controller->fetchHolidaysFromGoogleCalendar();

        if ($result['success']) {
            $this->info($result['message']);
        } else {
            $this->error($result['message']);
        }
    }
}