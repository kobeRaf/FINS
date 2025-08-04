<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function view() {
        $logo = Logo::all();
        $template = Report::all(); // or use where() if needed
        return view('pages.systemmodule.report', compact('logo', 'template'));
    }
    public function store(Request $request)
        {
            $validated = $request->validate([
                'header_logo_1a' => 'nullable|string',
                'header_logo_1b' => 'nullable|string',
                'header_logo_1c' => 'nullable|string',
                'header_logo_1d' => 'nullable|string',
                'report_title'   => 'nullable|string',
                'report_subtitle'=> 'nullable|string',
                'footer_logo_2a' => 'nullable|string',
                'footer_logo_2b' => 'nullable|string',
                'footer_logo_2c' => 'nullable|string',
                'footer_logo_2d' => 'nullable|string',
                'footer_title'   => 'nullable|string',
            ]);

            Report::create($validated);

            return redirect()->back()->with('success', 'Report template saved successfully!');
    }

    public function update(Request $request, $id)
     {
        $validated = $request->validate([
            'header_logo_1a' => 'nullable|string',
            'header_logo_1b' => 'nullable|string',
            'header_logo_1c' => 'nullable|string',
            'header_logo_1d' => 'nullable|string',
            'report_title'   => 'nullable|string',
            'report_subtitle'=> 'nullable|string',
            'footer_logo_2a' => 'nullable|string',
            'footer_logo_2b' => 'nullable|string',
            'footer_logo_2c' => 'nullable|string',
            'footer_logo_2d' => 'nullable|string',
            'footer_title'   => 'nullable|string',
        ]);

        $template = Report::findOrFail($id);
        $template->update($validated);

        return redirect()->back()->with('success', 'Template updated successfully!');
    }
}

