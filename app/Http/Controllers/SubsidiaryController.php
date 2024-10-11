<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subsidiaries = Subsidiary::all();
        return view('subsidiaries.index', compact('subsidiaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subsidiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'abbr' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_no' => 'nullable|string|max:255',
            'email_address' => 'nullable|email|max:255',
            'facebook_page' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagline' => 'required|string|max:255', // Add this line
        ]);

        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('subsidiaries', 'public');
        }

        foreach (['first_image', 'second_image', 'third_image'] as $image) {
            if ($request->hasFile($image)) {
                $validatedData[$image] = $request->file($image)->store('subsidiaries', 'public');
            }
        }

        Subsidiary::create($validatedData);

        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subsidiary = Subsidiary::findOrFail($id);
        return view('subsidiaries.show', compact('subsidiary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subsidiary $subsidiary)
    {
        return view('subsidiaries.edit', compact('subsidiary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subsidiary $subsidiary)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'abbr' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_no' => 'nullable|string|max:255',
            'email_address' => 'nullable|email|max:255',
            'facebook_page' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagline' => 'required|string|max:255', // Add this line
        ]);

        if ($request->hasFile('main_image')) {
            $validatedData['main_image'] = $request->file('main_image')->store('subsidiaries', 'public');
        }

        foreach (['first_image', 'second_image', 'third_image'] as $image) {
            if ($request->hasFile($image)) {
                $validatedData[$image] = $request->file($image)->store('subsidiaries', 'public');
            }
        }

        $subsidiary->update($validatedData);

        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subsidiary $subsidiary)
    {
        $subsidiary->delete();
        return redirect()->route('subsidiaries.index')->with('success', 'Subsidiary deleted successfully.');
    }
}
