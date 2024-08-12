<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holiday;
use Carbon\Carbon;

class StoreAttendance extends Command
{
    protected $signature = 'attendance:store';
    protected $description = 'Mark attendance as absent if no attendance recorded within 24 hours';

    public function handle()
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2024-07-29');
        $today = Carbon::now();

        if ($today->lt($startDate)) {
            $this->info('Attendance logging has not started yet.');
            return;
        }

        $this->markAbsentIfNoAttendance($today->toDateString());
        $this->markAbsentForPreviousDays($startDate, $today);
        $this->markAttendanceForHolidays($startDate, $today);
    }

    protected function markAbsentIfNoAttendance($date)
    {
        $employees = Employee::all();
        $currentDayOfWeek = Carbon::createFromFormat('Y-m-d', $date)->dayOfWeek;

        foreach ($employees as $employee) {
            $attendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('date_attended', $date)
                ->first();

            if (!$attendance) {
                $this->createAbsentRecord($employee, $date, $currentDayOfWeek);
            } elseif (is_null($attendance->time_in) && is_null($attendance->time_out)) {
                $this->updateAbsentRecord($attendance, $currentDayOfWeek);
            } elseif (!is_null($attendance->time_in) && is_null($attendance->time_out)) {
                $this->updateNoClockOutRecord($attendance);
            }
        }

        $this->info('Attendance records updated for employees.');
    }

    protected function markAbsentForPreviousDays($startDate, $endDate)
    {
        $employees = Employee::all();
        $currentDate = clone $startDate;

        while ($currentDate->lte($endDate)) {
            $formattedDate = $currentDate->toDateString();
            $dayOfWeek = $currentDate->dayOfWeek;

            foreach ($employees as $employee) {
                $attendance = Attendance::where('employee_id', $employee->id)
                    ->whereDate('date_attended', $formattedDate)
                    ->first();

                if (!$attendance) {
                    $this->createAbsentRecord($employee, $formattedDate, $dayOfWeek);
                } elseif (is_null($attendance->time_in) && is_null($attendance->time_out)) {
                    $this->updateAbsentRecord($attendance, $dayOfWeek);
                } elseif (!is_null($attendance->time_in) && is_null($attendance->time_out)) {
                    $this->updateNoClockOutRecord($attendance);
                }
            }

            $currentDate->addDay();
        }

        $this->info('Attendance records updated for previous days.');
    }

    protected function markAttendanceForHolidays($startDate, $endDate)
    {
        $employees = Employee::all();
        $holidays = $this->getHolidays();
        $currentDate = clone $startDate;

        while ($currentDate->lte($endDate)) {
            $formattedDate = $currentDate->toDateString();

            if ($holidays->contains($formattedDate)) {
                foreach ($employees as $employee) {
                    $attendance = Attendance::where('employee_id', $employee->id)
                        ->whereDate('date_attended', $formattedDate)
                        ->first();

                    if (!$attendance || (is_null($attendance->time_in) && is_null($attendance->time_out))) {
                        Attendance::updateOrCreate(
                            [
                                'employee_id' => $employee->id,
                                'date_attended' => $formattedDate,
                            ],
                            [
                                'time_in' => '08:00:00',
                                'time_out' => '17:00:00',
                                'remarks' => 'Holiday',
                                'hours_worked' => '08:00:00',
                            ]
                        );
                    }
                }
            }

            $currentDate->addDay();
        }

        $this->info('Attendance marked for holidays for employees with no records.');
    }

    protected function getHolidays()
    {
        return Holiday::pluck('date')->map(function ($holiday) {
            return Carbon::parse($holiday)->toDateString();
        });
    }

    private function createAbsentRecord($employee, $date, $currentDayOfWeek)
    {
        $timeIn = NULL;
        $timeOut = NULL;
        $hoursWorked = NULL;
        $remarks = 'Absent';

        if ($currentDayOfWeek === Carbon::SATURDAY) {
            $timeIn = '08:00:00';
            $timeOut = '17:00:00';
            $hoursWorked = '08:00:00';
            $remarks = 'Saturday';
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date_attended' => $date,
            'time_in' => $timeIn,
            'time_out' => $timeOut,
            'remarks' => $remarks,
            'hours_worked' => $hoursWorked,
        ]);
    }

    private function updateAbsentRecord($attendance, $currentDayOfWeek)
    {
        $timeIn = null;
        $timeOut = null;
        $hoursWorked = null;
        $remarks = 'Absent';

        if ($currentDayOfWeek === Carbon::SATURDAY) {
            $timeIn = '08:00:00';
            $timeOut = '17:00:00';
            $hoursWorked = '08:00:00';
            $remarks = 'Saturday';
        }

        $attendance->update([
            'time_in' => $timeIn,
            'time_out' => $timeOut,
            'remarks' => $remarks,
            'hours_worked' => $hoursWorked,
        ]);
    }

    private function updateNoClockOutRecord($attendance)
    {
        $attendance->update([
            'remarks' => 'No Clock Out',
        ]);
    }
}