<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credentials;
use App\Models\Employee;

class CredentialController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:credential-list|credential-create|credential-edit|credential-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:credential-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:credential-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:credential-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $credentials = Credentials::all();
        return view('credentials.index', compact('credentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('employee_status', 'Active')->get();
        return view('credentials.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'company_number' => 'nullable|numeric',
            'company_email' => 'nullable|email',
            'email_password' => 'nullable|text',
        ]);

        $credential = Credentials::create($validatedData);
        return redirect()->route('credentials.index')->with('success', 'Credentials created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Credentials $credential)
    {
        return view('credentials.show', compact('credential'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credentials $credential)
    {
        $employees = Employee::where('employee_status', 'Active')->get();
        return view('credentials.edit', compact('credential', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credentials $credential)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'company_number' => 'nullable|numeric',
            'company_email' => 'nullable|email',
            'email_password' => 'nullable|string',
        ]);

        $credential->update($validatedData);
        return redirect()->route('credentials.index')->with('success', 'Credentials updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credentials $credential)
    {
        $credential->delete();
        return redirect()->route('credentials.index')->with('success', 'Credentials deleted successfully.');
    }
}
