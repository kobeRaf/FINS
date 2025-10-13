<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function view()
    {
        $accounts = Account::latest()->get();
        return view('account.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_code' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_classification' => 'required|string|max:255',
        ]);

        $referenceNo = 'ACC-' . strtoupper(uniqid());

        Account::create([
            'reference_no' => $referenceNo,
            'account_code' => $request->account_code,
            'account_name' => $request->account_name,
            'account_classification' => $request->account_classification,
        ]);

        return redirect()->back()->with('success', 'Account added successfully!');
    }
}
