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
        Fund::create($request->only(['type', 'fund_type', 'fund_title']));
        return redirect()->back()->with('success', 'Report template saved successfully!');
    }

    public function report($templateId)
    {
        $funds = Fund::latest()->get();
        $template = Report::first(); 

        return view('fund.report', compact('funds', 'template'));
    }

}
