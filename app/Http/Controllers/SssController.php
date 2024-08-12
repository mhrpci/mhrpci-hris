<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sss;
use App\Models\Employee;

class SssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:sss-list|sss-create|sss-edit|sss-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:sss-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:sss-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:sss-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sss = Sss::all();
        return view('sss.index',compact('sss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('sss.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Sss::create($request->all());
        return redirect()->route('sss.index')
        ->with('success','SSS Contribution created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sss $sss)
    {
        return view('sss.show', compact('sss'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Sss $sss)
    {
        $employees=Employee::all();
        return view('sss.edit', compact('sss', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sss $sss)
    {
        $sss->update($request->all());
        return redirect()->route('sss.index')
        ->with('success','SSS Contribution updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sss $sss)
    {
        $sss->delete();
        return redirect()->route('sss.index')
        ->with('success','SSS Contribution deleted successfully');
    }
    
}
