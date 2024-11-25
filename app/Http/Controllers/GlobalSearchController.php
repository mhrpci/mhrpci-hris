<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\CashAdvance;
use App\Models\Accountability;
use App\Models\Payroll;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $user = auth()->user();
        
        if (empty($query)) {
            return response()->json([
                'results' => [],
                'count' => 0
            ]);
        }

        $results = collect();

        // Employee Search - Restricted to HR Compliance, Finance, Admin and Super Admin
        if ($user->hasAnyRole(['HR Compliance', 'Finance', 'Admin', 'Super Admin'])) {
            $employees = Employee::where(function($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                  ->orWhere('last_name', 'LIKE', "%{$query}%")
                  ->orWhere('email_address', 'LIKE', "%{$query}%")
                  ->orWhere('employee_status', 'LIKE', "%{$query}%")
                  ->orWhere('company_id', 'LIKE', "%{$query}%");
            })
            ->with(['department', 'position', 'leaves', 'cashAdvances'])
            ->take(5)
            ->get()
            ->map(function($employee) {
                $hiredDate = \Carbon\Carbon::parse($employee->date_hired);
                $employmentDuration = $hiredDate->diffForHumans(now(), true);
                
                // Get recent leave
                $recentLeave = $employee->leaves()->latest()->first();
                
                // Get active cash advance
                $activeCashAdvance = $employee->cashAdvances()
                    ->where('status', 'active')
                    ->first();

                return [
                    'type' => 'Employee',
                    'id' => $employee->id,
                    'title' => "{$employee->first_name} {$employee->last_name}",
                    'subtitle' => $employee->position->name ?? 'No Position',
                    'description' => implode(' • ', array_filter([
                        $employee->department->name ?? 'No Department',
                        $employee->employmentStatus(),
                        "Employed for {$employmentDuration}",
                        $recentLeave ? "Latest Leave: {$recentLeave->status}" : null,
                        $activeCashAdvance ? "Has Active Cash Advance" : null
                    ])),
                    'url' => url("/employees/{$employee->slug}"),
                    'icon' => 'fas fa-user',
                    'meta' => [
                        'company_id' => $employee->company_id,
                        'email' => $employee->email_address,
                        'contact' => $employee->contact_no,
                        'department' => $employee->department->name ?? 'N/A',
                        'position' => $employee->position->name ?? 'N/A',
                        'status' => $employee->employmentStatus()
                    ]
                ];
            });
            
            $results = $results->concat($employees);
        }

        // Leave Search - Restricted to HR ComBen, Admin and Super Admin
        if ($user->hasAnyRole(['HR ComBen', 'Admin', 'Super Admin'])) {
            $leavesQuery = Leave::search($query)->with(['employee', 'type', 'approvedByUser']);
            
            // Add condition for HR ComBen role
            if ($user->hasRole('HR ComBen')) {
                $leavesQuery->where('status', 'approved')
                           ->whereNull('validated_by_signature');
            }
            
            $leaves = $leavesQuery->take(5)
                ->get()
                ->map(function($leave) {
                    $description = collect([
                        "Type: {$leave->type->name}",
                        "Status: {$leave->status}",
                        $leave->payment_status,
                        "Duration: {$leave->date_range}"
                    ])->filter()->join(' • ');

                    return [
                        'type' => 'Leave Request',
                        'id' => $leave->id,
                        'title' => "{$leave->employee->first_name} {$leave->employee->last_name}",
                        'subtitle' => "Leave Request ({$leave->type->name})",
                        'description' => $description,
                        'url' => url("/leaves/{$leave->id}"),
                        'icon' => 'fas fa-calendar-alt',
                        'meta' => [
                            'company_id' => $leave->employee->company_id,
                            'department' => $leave->employee->department->name ?? 'N/A',
                            'status' => [
                                'text' => ucfirst($leave->status),
                                'class' => $leave->status_badge
                            ],
                            'date_range' => $leave->date_range,
                            'approved_by' => $leave->approvedByUser?->name ?? 'Pending'
                        ]
                    ];
                });
                
            $results = $results->concat($leaves);
        }

        // Cash Advance Search - Restricted to Admin and Super Admin only
        if ($user->hasAnyRole(['Admin', 'Super Admin'])) {
            $cashAdvances = CashAdvance::where('status', 'LIKE', "%{$query}%")
                ->orWhere('reference_number', 'LIKE', "%{$query}%")
                ->with('employee')
                ->take(5)
                ->get()
                ->map(function($ca) {
                    return [
                        'type' => 'Cash Advance',
                        'id' => $ca->id,
                        'title' => $ca->employee->first_name . ' ' . $ca->employee->last_name,
                        'subtitle' => "Cash Advance ({$ca->status})",
                        'description' => "Ref: {$ca->reference_number}, Amount: ₱" . number_format($ca->cash_advance_amount, 2),
                        'url' => url("/cash_advances/{$ca->id}"),
                        'icon' => 'fas fa-money-bill-wave'
                    ];
                });
                
            $results = $results->concat($cashAdvances);
        }

        // Payroll Search - Restricted to Finance, Admin and Super Admin
        if ($user->hasAnyRole(['Finance', 'Admin', 'Super Admin'])) {
            $payrolls = Payroll::where('slug', 'LIKE', "%{$query}%")
                ->orWhereHas('employee', function($q) use ($query) {
                    $q->where('first_name', 'LIKE', "%{$query}%")
                      ->orWhere('last_name', 'LIKE', "%{$query}%");
                })
                ->with('employee')
                ->take(5)
                ->get()
                ->map(function($payroll) {
                    return [
                        'type' => 'Payroll',
                        'id' => $payroll->id,
                        'title' => $payroll->employee->first_name . ' ' . $payroll->employee->last_name,
                        'subtitle' => "Payroll Record",
                        'description' => implode(' • ', [
                            "Period: {$payroll->start_date} to {$payroll->end_date}",
                            "Net: ₱" . number_format($payroll->net_salary, 2)
                        ]),
                        'url' => url("/payrolls/{$payroll->slug}"),
                        'icon' => 'fas fa-file-invoice-dollar',
                        'meta' => [
                            'company_id' => $payroll->employee->company_id,
                            'gross_salary' => number_format($payroll->gross_salary, 2),
                            'net_salary' => number_format($payroll->net_salary, 2),
                            'period' => "{$payroll->start_date} to {$payroll->end_date}"
                        ]
                    ];
                });
                
            $results = $results->concat($payrolls);
        }

        // Accountability Search - keeping it as is, but you might want to add restrictions here too
        $accountabilities = Accountability::where('notes', 'LIKE', "%{$query}%")
            ->with(['employee', 'itInventories'])
            ->take(5)
            ->get()
            ->map(function($accountability) {
                return [
                    'type' => 'Accountability',
                    'id' => $accountability->id,
                    'title' => $accountability->employee->first_name . ' ' . $accountability->employee->last_name,
                    'subtitle' => 'IT Accountability',
                    'description' => \Str::limit($accountability->notes, 50),
                    'url' => url("/accountabilities/{$accountability->id}"),
                    'icon' => 'fas fa-laptop'
                ];
            });

        $results = $results->concat($accountabilities);

        return response()->json([
            'results' => $results->take(15),
            'count' => $results->count()
        ]);
    }
} 