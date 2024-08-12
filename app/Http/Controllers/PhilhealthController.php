<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Philhealth;
use App\Models\Employee;

class PhilhealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:philhealth-list|philhealth-create|philhealth-edit|philhealth-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:philhealth-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:philhealth-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:philhealth-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a lisphilhealthg of the resource.
     */
    public function index()
    {
        $philhealth = Philhealth::all();
        return view('philhealth.index',compact('philhealth'));
    }

    /**
     * Show the form for creaphilhealthg a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('philhealth.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Philhealth::create($request->all());
        return redirect()->route('philhealth.index')
        ->with('success','Philhealth Contribution created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Philhealth $philhealth)
    {
        return view('philhealth.show', compact('philhealth'));
    }

    /**
     * Show the form for ediphilhealthg the specified resource.
     */
    public function edit(Request $request, Philhealth $philhealth)
    {
        $employees = Employee::all();
        return view('philhealth.edit', compact('philhealth', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Philhealth $philhealth)
    {
        $philhealth->update($request->all());
        return redirect()->route('philhealth.index')
        ->with('success','Philhealth Contribution updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Philhealth $philhealth)
    {
        $philhealth->delete();
        return redirect()->route('philhealth.index')
        ->with('success','Philhealth Contribution deleted successfully');
    }
    
}
