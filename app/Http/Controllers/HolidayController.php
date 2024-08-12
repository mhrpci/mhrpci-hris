<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Add this line for HTTP requests
use Carbon\Carbon; // Make sure Carbon is imported

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:holiday-list|holiday-create|holiday-edit|holiday-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:holiday-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:holiday-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:holiday-delete'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $holidays = Holiday::all();
        return view('holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('holidays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:special holiday,regular holiday', // Validate the type
        ]);

        Holiday::create($request->only('title', 'date', 'type')); // Include type in the creation

        return redirect()->route('holidays.index')
            ->with('success', 'Holiday created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        return view('holidays.show', compact('holiday'));
    }

    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->date = Carbon::parse($holiday->date); // Ensure it's a Carbon instance

        return view('holidays.edit', compact('holiday'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:special holiday,regular holiday', // Validate the type
        ]);

        $holiday->update($request->only('title', 'date', 'type')); // Include type in the update

        return redirect()->route('holidays.index')
            ->with('success', 'Holiday updated successfully.');
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return redirect()->route('holidays.index')
            ->with('success', 'Holiday deleted successfully.');
    }

    public function fetchHolidaysFromGoogleCalendar()
{
    // URL of the public Google Calendar for Philippine Holidays
    $icalUrl = 'https://calendar.google.com/calendar/ical/en.philippines%23holiday%40group.v.calendar.google.com/public/basic.ics';

    // Fetch the iCal feed
    $icalData = file_get_contents($icalUrl);

    if ($icalData !== false) {
        // Split the data into lines
        $lines = explode("\n", $icalData);
        $holidays = [];
        $event = null;
        $currentYear = Carbon::now()->year;

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === 'BEGIN:VEVENT') {
                $event = [];
            } elseif ($line === 'END:VEVENT') {
                if (!empty($event) && isset($event['title']) && isset($event['date'])) {
                    // Only add the event if it belongs to the current year
                    $eventDate = Carbon::parse($event['date']);
                    if ($eventDate->year == $currentYear) {
                        $holidays[] = $event;
                    }
                }
                $event = null;
            } elseif ($event !== null) {
                if (strpos($line, 'SUMMARY:') === 0) {
                    $event['title'] = substr($line, 8);
                } elseif (strpos($line, 'DTSTART;VALUE=DATE:') === 0) {
                    $dateStr = substr($line, 19);
                    $event['date'] = Carbon::createFromFormat('Ymd', $dateStr)->toDateString();
                }
            }
        }

        // Store the holidays in the database
        $storedCount = 0;
        foreach ($holidays as $holiday) {
            $result = Holiday::updateOrCreate(
                ['title' => $holiday['title'], 'date' => $holiday['date']],
                [
                    'title' => $holiday['title'],
                    'date' => $holiday['date'],
                    'type' => 'regular holiday' // Default type, adjust as needed
                ]
            );
            if ($result->wasRecentlyCreated || $result->wasChanged()) {
                $storedCount++;
            }
        }

        return [
            'success' => true,
            'message' => "Fetched and stored $storedCount holidays successfully.",
            'count' => $storedCount
        ];
    }

    return [
        'success' => false,
        'message' => 'Failed to fetch holidays from Google Calendar.',
        'count' => 0
    ];
}
}
