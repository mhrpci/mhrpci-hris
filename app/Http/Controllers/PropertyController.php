<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the properties.
     */
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_name' => 'required|max:255',
            'type' => 'required|in:rent,sale',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fourth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fifth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'contact_info' => 'required|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|max:255',
        ]);

        // Handle file uploads
        $imageFields = ['main_image', 'first_image', 'second_image', 'third_image', 'fourth_image', 'fifth_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validatedData[$field] = $request->file($field)->store('property_images', 'public');
            }
        }

        $property = Property::create($validatedData);

        return redirect()->route('properties.show', $property->id)->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified property.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validatedData = $request->validate([
            'property_name' => 'required|max:255',
            'type' => 'required|in:rent,sale',
            'main_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fourth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fifth_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'contact_info' => 'required|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|max:255',
        ]);

        // Handle file uploads
        $imageFields = ['main_image', 'first_image', 'second_image', 'third_image', 'fourth_image', 'fifth_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if it exists
                if ($property->$field) {
                    Storage::disk('public')->delete($property->$field);
                }
                $validatedData[$field] = $request->file($field)->store('property_images', 'public');
            }
        }

        $property->update($validatedData);

        return redirect()->route('properties.show', $property->id)->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
}
