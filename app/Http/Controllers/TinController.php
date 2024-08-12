<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tin;
use App\Models\Employee;

class TinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:tin-list|tin-create|tin-edit|tin-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:tin-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:tin-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:tin-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tin = Tin::all();
        return view('tin.index',compact('tin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('tin.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tin::create($request->all());
        return redirect()->route('tin.index')
        ->with('success','Tin Contribution created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tin $tin)
    {
        return view('tin.show', compact('tin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tin $tin)
    {
        $employees = Employee::all();
        return view('tin.edit', compact('tin', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tin $tin)
    {
        $tin->update($request->all());
        return redirect()->route('tin.index')
        ->with('success','Tin Contribution updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tin $tin)
    {
        $tin->delete();
        return redirect()->route('tin.index')
        ->with('success','Tin Contribution deleted successfully');
    }
    
}
