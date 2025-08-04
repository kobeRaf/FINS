<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemTheme;

class BudgetController extends Controller
{
    public function view() {

        $latest = SystemTheme::first(); 
        
        return view('pages.budgetmodule.views.home', compact('latest'));//it is always the directory of the file you want to reach.
    }

    public function indexProposal()
    {

        return view('pages.budgetmodule.views.budgetproposal.index');
    }

    public function createProposal()
    {

        return view('pages.budgetmodule.views.budgetproposal.create');
    }

    public function storeProposal(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'remarks' => 'nullable|string|max:1000',
        ]);

        // Save logic here (e.g., BudgetProposal::create($validated);)

        return back()->with('success', 'Proposal submitted successfully.');
    }


}
