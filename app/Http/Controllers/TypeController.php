<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:type-list|type-create|type-edit|type-delete', ['only' => ['index','show']]);
        $this->middleware('permission:type-create', ['only' => ['create','store']]);
        $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:type-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Type::create($request->all());
        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $type->update($request->all());
        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index');
    }
}
