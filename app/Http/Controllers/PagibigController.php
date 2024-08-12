<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagibig;
use App\Models\Employee;

class PagibigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:pagibig-list|pagibig-create|pagibig-edit|pagibig-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:pagibig-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:pagibig-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:pagibig-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagibig = Pagibig::all();
        return view('pagibig.index',compact('pagibig'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('pagibig.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pagibig::create($request->all());
        return redirect()->route('pagibig.index')
        ->with('success','Pagibig Contribution created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagibig $pagibig)
    {
        return view('pagibig.show', compact('pagibig'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pagibig $pagibig)
    {
        $employees = Employee::all();
        return view('pagibig.edit', compact('pagibig', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagibig $pagibig)
    {
        $pagibig->update($request->all());
        return redirect()->route('pagibig.index')
        ->with('success','Pagibig Contribution updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagibig $pagibig)
    {
        $pagibig->delete();
        return redirect()->route('pagibig.index')
        ->with('success','Pagibig Contribution deleted successfully');
    }
    
}
