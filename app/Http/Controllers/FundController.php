<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Report;

class FundController extends Controller
{
    public function view()
    {
        $funds = Fund::latest()->get();
        $template = Report::first();
        return view('fund.index', compact('funds', 'template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'fund_name' => 'required|string|max:255',
            'fund_description' => 'required|string|max:255',
        ]);

                $reference = 'FUND-' . strtoupper(uniqid());

        Fund::create([
            'reference_no' => $reference,
            'code' => $request->code,
            'fund_name' => $request->fund_name,
            'fund_description' => $request->fund_description,
        ]);

        // Fund::create($request->only(['code', 'fund_name', 'fund_description']));

        return redirect()->back()->with('success', 'Fund record added successfully!');
    }

    public function report($templateId)
    {
        $funds = Fund::latest()->get();
        $template = Report::first();

        return view('fund.report', compact('funds', 'template'));
    }
}
