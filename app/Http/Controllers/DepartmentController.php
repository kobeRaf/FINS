<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Report;

class DepartmentController extends Controller
{
    
    public function view() {
        $department = Department::latest()->get();
        $template = Report::first(); 
        return view('department.index', compact('department', 'template'));
    }

   public function store(Request $request) 
{
    $reference = 'DEPT-' . strtoupper(uniqid());

    Department::create([
        'department_no'   => $reference,
        'department_acronym' => $request->department_acronym,
        'department_name'  => $request->department_name,
        'department_head'  => $request->department_head
        
    ]);

    return redirect()->back()->with('success', 'Department successfully added!');
}
}
