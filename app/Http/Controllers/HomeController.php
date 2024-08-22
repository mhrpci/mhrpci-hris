<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Post;
use App\Models\Holiday;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Count leaves by status.
     *
     * @param string $status
     * @return int
     */
    public function countLeavesByStatus($status)
    {
        return Leave::where('status', $status)->count();
    }

    /**
     * Fetch detailed leave information for a user and employee with matching first names.
     *
     * @return array|null
     */
    public function fetchLeaveDetails()
    {
        // Assuming auth user's first name matches employee's first name
        $authUser = auth()->user();
        $employee = Employee::where('first_name', $authUser->first_name)->first();

        if (!$employee) {
            return null; // No matching employee found
        }

        // Fetch leave details for the employee
        $leaveDetails = [
            'sick_leave' => $employee->sick_leave,
            'emergency_leave' => $employee->emergency_leave,
            'vacation_leave' => $employee->vacation_leave,
        ];

        return $leaveDetails;
    }

    /**
     * Convert month number to month name.
     *
     * @param int $monthNumber
     * @return string
     */
    protected function monthName($monthNumber)
    {
        return Carbon::create()->month($monthNumber)->format('F');
    }

    /**
     * Get upcoming holidays and check if today is a holiday.
     *
     * @return array
     */
    public function upcomingHolidays()
    {
        // Fetch all holidays
        $holidays = Holiday::orderBy('date', 'asc')->get();

        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Filter upcoming holidays that are in the current month
        $upcomingHolidays = $holidays->filter(function ($holiday) use ($currentMonth, $currentYear) {
            $holidayDate = Carbon::parse($holiday->date);
            return $holidayDate->isFuture() && $holidayDate->month === $currentMonth && $holidayDate->year === $currentYear;
        });

        // Check if today is a holiday
        $today = Carbon::today();
        $todayHoliday = $holidays->firstWhere('date', $today->format('Y-m-d'));

        // Get the month name
        $monthName = $this->monthName($currentMonth);

        return [
            'upcomingHolidays' => $upcomingHolidays,
            'todayHoliday' => $todayHoliday,
            'currentMonthName' => $monthName,
        ];
    }

    /**
     * Get upcoming birthdays and check if today is someone's birthday.
     *
     * @return array
     */
    public function upcomingBirthdays()
    {
        // Get the current month and day
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;

        // Get employees whose birthdays are in the current month
        $upcomingBirthdays = Employee::whereMonth('birth_date', $currentMonth)
            ->whereDay('birth_date', '>', $currentDay)
            ->get();

        // Filter employees whose birthday is today
        $todaysBirthdays = Employee::whereMonth('birth_date', $currentMonth)
            ->whereDay('birth_date', $currentDay)
            ->get();

        // Get the month name
        $currentMonthName = $this->monthName($currentMonth);

        return [
            'upcomingBirthdays' => $upcomingBirthdays,
            'todaysBirthdays' => $todaysBirthdays,
            'currentMonthName' => $currentMonthName,
        ];
    }
/**
 * Count employees by department.
 *
 * @return array
 */
public function countEmployeesByDepartment()
{
    return Employee::select('department_id', \DB::raw('count(*) as count'))
        ->groupBy('department_id')
        ->with('department') // Assuming you have a relationship defined
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->department->name => $item->count]; // Adjust based on your department model
        })->toArray();
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get counts of employees by department
$employeesByDepartment = $this->countEmployeesByDepartment();

        // Fetch upcoming holidays and check if today is a holiday
        $holidaysData = $this->upcomingHolidays();

        // Extract the data
        $upcomingHolidays = $holidaysData['upcomingHolidays'];
        $todayHoliday = $holidaysData['todayHoliday'];
        $currentMonthName = $holidaysData['currentMonthName'];

        // Fetch upcoming birthdays and check if today is someone's birthday
        $birthdaysData = $this->upcomingBirthdays();

        // Extract the data
        $upcomingBirthdays = $birthdaysData['upcomingBirthdays'];
        $todaysBirthdays = $birthdaysData['todaysBirthdays'];
        $currentMonthNameBirthdays = $birthdaysData['currentMonthName'];

        // Get counts of models
        $userCount = User::count();
        $employeeCount = Employee::count();
        $attendanceAllCount = Attendance::count();
        // Get attendance count up to the current date
        $attendanceCount = Attendance::whereDate('date_attended', '=', now())->count();
        // Get counts of leaves by status
        $pendingLeavesCount = $this->countLeavesByStatus('pending');
        $approvedLeavesCount = $this->countLeavesByStatus('approved');
        $rejectedLeavesCount = $this->countLeavesByStatus('rejected');
        $leaveCount = Leave::count();


        // Delete posts where date_end is equal to today
    Post::whereDate('date_end', '=', Carbon::today())->delete();

    // Get the latest 5 posts ordered by the most recent, where the post date is greater than or equal to tomorrow
    $latestPosts = Post::whereDate('date_start', '>=', Carbon::tomorrow())
        ->orderBy('created_at', 'desc')
        ->take(5) // You can adjust this to 5 to display the latest 5 posts
        ->get();

    // Get posts where date_start is equal to today
    $todayPosts = Post::whereDate('date_start', '=', Carbon::today())->get();

    // Fetch detailed leave information for the authenticated user and employee
    $leaveDetails = $this->fetchLeaveDetails();

        // Pass the counts, sum, monthly contributions, latest posts, leave details, holidays, and birthdays to the view
        return view('home', compact(
            'userCount',
            'employeeCount',
            'attendanceAllCount',
            'attendanceCount',
            'leaveCount',
            'pendingLeavesCount',
            'approvedLeavesCount',
            'rejectedLeavesCount',
            'latestPosts',
            'todayPosts',
            'leaveDetails',
            'upcomingHolidays',
            'todayHoliday',
            'currentMonthName',
            'upcomingBirthdays',
            'todaysBirthdays',
            'currentMonthNameBirthdays',
            'employeesByDepartment' // Include the department counts
        ));
    }
}
