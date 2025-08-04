<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    public function view()
    {
        $logo = Logo::all(); // ✅ This gives you all uploaded logos
        return view('pages.systemmodule.logo', compact('logo'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('reportlogo'), $filename);

        Logo::create([
            'name' => $request->name,
            'path' => $filename,
        ]);

        return redirect()->back()->with('success', 'Logo uploaded successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logo = Logo::findOrFail($id);
        $logo->name = $request->name;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('reportlogo'), $filename);

            // Delete old file
            $oldPath = public_path('reportlogo/' . $logo->path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $logo->path = $filename;
        }

        $logo->save();

        return redirect()->route('logo.view')->with('success', 'Logo updated successfully!');
    }

    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);

        // Delete the logo file
        $filePath = public_path('reportlogo/' . $logo->path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $logo->delete();

        return redirect()->back()->with('success', 'Logo deleted successfully!');
    }

}
