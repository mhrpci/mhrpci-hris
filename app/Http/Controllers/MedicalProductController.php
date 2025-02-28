<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MedicalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Super Admin|Product Manager']);
    }

    public function index()
    {
        $categories = Category::with('products')->get();
        return view('medical-products.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('medical-products.create', compact('categories'));
    }

    public function show(MedicalProduct $product)
    {
        return view('medical-products.show', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'details' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $validated['is_featured'] = $request->has('is_featured');

        MedicalProduct::create($validated);

        return redirect()->route('medical-products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(MedicalProduct $product)
    {
        $categories = Category::all();
        return view('medical-products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, MedicalProduct $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'details' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'is_featured' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('medical-products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(MedicalProduct $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('medical-products.index')
            ->with('success', 'Product deleted successfully.');
    }
} 
