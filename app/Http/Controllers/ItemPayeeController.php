<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;

class ItemPayeeController extends Controller
{
    /**
     * Store a newly created Payee (for modal form).
     */
    public function store(Request $request)
    {
        $request->validate([
            'payee_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'nullable|date',
        ]);

        // Default status
        $status = $request->status ?? 'For Signature';

        // Create Payee record
        Payee::create([
            'payee_name' => $request->payee_name,
            'amount' => $request->amount,
            'status' => $status,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Payee added successfully.');
    }

    /**
     * Update status of a Payee record.
     */
    public function updateStatus($id)
    {
        $payee = Payee::findOrFail($id);

        if ($payee->status === 'For Signature') {
            $payee->update(['status' => 'For CashAdvance']);
        }

        return redirect()->back()->with('success', 'Payee status updated successfully.');
    }
}
