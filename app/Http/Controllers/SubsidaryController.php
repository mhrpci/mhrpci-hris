<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    public function index()
    {
        $subsidiaries = Subsidiary::all();
        return view('subsidiaries.index', compact('subsidiaries'));
    }

    public function create()
    {
        return view('subsidiaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'abbr' => 'required|max:255',
            'description' => 'required',
            'contact_no' => 'nullable|max:255',
            'email_address' => 'nullable|email|max:255',
            'facebook_page' => 'nullable|max:255',
            'website' => 'nullable|max:255',
            'main_image' => 'required|image|max:2048',
            'first_image' => 'nullable|image|max:2048',
            'second_image' => 'nullable|image|max:2048',
            'third_image' => 'nullable|image|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('first_image')) {
            $validated['first_image'] = $request->file('first_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('second_image')) {
            $validated['second_image'] = $request->file('second_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('third_image')) {
            $validated['third_image'] = $request->file('third_image')->store('subsidiaries', 'public');
        }

        Subsidiary::create($validated);

        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary created successfully.');
    }

    public function show(Subsidiary $subsidiary)
    {
        return view('subsidiaries.show', compact('subsidiary'));
    }

    public function edit(Subsidiary $subsidiary)
    {
        return view('subsidiaries.edit', compact('subsidiary'));
    }

    public function update(Request $request, Subsidiary $subsidiary)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'abbr' => 'required|max:255',
            'description' => 'required',
            'contact_no' => 'nullable|max:255',
            'email_address' => 'nullable|email|max:255',
            'facebook_page' => 'nullable|max:255',
            'website' => 'nullable|max:255',
            'main_image' => 'required|image|max:2048',
            'first_image' => 'nullable|image|max:2048',
            'second_image' => 'nullable|image|max:2048',
            'third_image' => 'nullable|image|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('first_image')) {
            $validated['first_image'] = $request->file('first_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('second_image')) {
            $validated['second_image'] = $request->file('second_image')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('third_image')) {
            $validated['third_image'] = $request->file('third_image')->store('subsidiaries', 'public');
        }

        $subsidiary->update($validated);

        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary updated successfully.');
    }

    public function destroy(Subsidiary $subsidiary)
    {
        $subsidiary->delete();

        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary deleted successfully.');
    }
}
