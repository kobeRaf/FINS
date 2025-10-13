<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;

class EntityController extends Controller
{
    public function view()
    {
        $entities = Entity::latest()->get();
        return view('entity.index', compact('entities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'entity_name' => 'required|string|max:255',
            'entity_type' => 'required|string|max:255',
            'entity_address' => 'nullable|string|max:255',
        ]);

   
        $typeCodes = [
            'Supplier' => 'SUP',
            'Contractor' => 'CON',
            'Employee' => 'EMP',
            'Other' => 'OTH',
        ];

        $typeCode = $typeCodes[$request->entity_type] ?? 'OTH';
        $referenceNo = 'ENTITY-' . $typeCode . '-' . strtoupper(uniqid());

        Entity::create([
            'reference_no' => $referenceNo,
            'entity_name' => $request->entity_name,
            'entity_type' => $request->entity_type,
            'entity_address' => $request->entity_address,
        ]);

        return redirect()->back()->with('success', 'Entity added successfully!');
    }
}
