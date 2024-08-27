<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;

class GeneratePayrolls extends Command
{
    protected $signature = 'payroll:generate';
    protected $description = 'Generate payrolls for all employees';

    public function handle()
    {
        $employees = Employee::all();
        $currentDate = Carbon::now();

        if ($currentDate->day <= 10) {
            // Generate payroll for 26th of previous month to 10th of current month
            $startDate = $currentDate->copy()->subMonth()->startOfMonth()->addDays(25);
            $endDate = $currentDate->copy()->startOfMonth()->addDays(9);
        } else {
            // Generate payroll for 11th to 25th of current month
            $startDate = $currentDate->copy()->startOfMonth()->addDays(10);
            $endDate = $currentDate->copy()->startOfMonth()->addDays(24);
        }

        foreach ($employees as $employee) {
            $payroll = new Payroll([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
            $payroll->employee()->associate($employee);
            $payroll->calculatePayroll();
            $payroll->save();

            $this->info("Payroll generated for {$employee->first_name} {$employee->last_name}");
        }

        $this->info('All payrolls generated successfully.');
    }
}
