<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemTheme;

class SystemController extends Controller
{
    // ✅ View method to load the page
    public function view()
    {
        $latest = SystemTheme::first(); 
        return view('pages.systemmodule.system', compact('latest'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'theme_color' => 'nullable|string',
            'bg_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'system_name' => 'nullable|string',
            'sub_system_name' => 'nullable|string',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('systemlogo'), $logoName);
            $logoPath = $logoName;
        }

        $theme = SystemTheme::first();

        if ($theme) {
            $theme->theme_color = $request->theme_color;
            $theme->bg_color = $request->bg_color;
            $theme->text_color = $request->text_color;
            $theme->system_name = $request->system_name;
            $theme->sub_system_name = $request->sub_system_name;

            if ($logoPath) {
                $theme->logo = $logoPath;
            }

            $theme->save();
        } else {
            SystemTheme::create([
                'logo' => $logoPath,
                'theme_color' => $request->theme_color,
                'bg_color' => $request->bg_color,
                'text_color' => $request->text_color,
                'system_name' => $request->system_name,
                'sub_system_name' => $request->sub_system_name,
            ]);
        }

        return redirect()->back()->with('success', 'System info updated successfully!');
    }
}
