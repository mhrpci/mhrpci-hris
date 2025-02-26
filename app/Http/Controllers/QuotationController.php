<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\QuotationRequestMail;
use App\Mail\QuotationConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\QuotationRequest;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = QuotationRequest::orderBy('created_at', 'desc')->get();
        return view('quotations.index', compact('quotations'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|string|in:pending,processed,completed,rejected',
                'notes' => 'nullable|string|max:500'
            ], [
                'status.required' => 'Please select a status',
                'status.in' => 'Invalid status selected',
                'notes.max' => 'Notes cannot exceed 500 characters'
            ]);

            $quotation = QuotationRequest::findOrFail($id);
            $oldStatus = $quotation->status;
            
            $quotation->update([
                'status' => $validatedData['status'],
                'notes' => $validatedData['notes'] ?? null,
                'updated_at' => now()
            ]);

            $message = 'Quotation status updated successfully from ' . ucfirst($oldStatus) . ' to ' . ucfirst($validatedData['status']);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'status' => $validatedData['status']
                ]);
            }

            return redirect()->route('quotations.index')->with('success', $message);

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            Log::error('Quotation Update Error: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update quotation status'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to update quotation status')
                ->withInput();
        }
    }

    public function sendRequest(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string',
                'product_id' => 'required|numeric',
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'hospital_name' => 'required|string'
            ]);

            // Save to database
            $quotationRequest = QuotationRequest::create([
                'product_id' => $validatedData['product_id'],
                'product_name' => $validatedData['product_name'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'hospital_name' => $validatedData['hospital_name'],
                'status' => 'pending'
            ]);

            // Send email to company
            Mail::to('edmarcrescencio856@gmail.com')
                ->send(new QuotationRequestMail($quotationRequest));

            // Send confirmation email to customer
            Mail::to($validatedData['email'])
                ->send(new QuotationConfirmationMail($quotationRequest));

            return response()->json([
                'success' => true,
                'message' => 'Quotation request sent successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Quotation Request Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'There was an error sending your request. Please try again.'
            ], 500);
        }
    }
} 