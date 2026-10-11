<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Equipment::query();

    foreach (['category', 'location'] as $field) {
        if ($request->query($field) !== null) {
            $query->where($field, $request->query($field));
        }
    }

    return response()->json($query->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'location' => 'required|string',
        'quantity' => 'required|integer|min:0',
        'condition' => 'required|string',
    ]);

    $equipment = Equipment::create($validated);

    return response()->json($equipment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        return response()->json($equipment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
        'name' => 'sometimes|required|string',
        'category' => 'sometimes|required|string',
        'location' => 'sometimes|required|string',
        'quantity' => 'sometimes|required|integer|min:0',
        'condition' => 'sometimes|required|string',
    ]);

    $equipment->update($validated);

    return response()->json($equipment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
          $equipment->delete();

    return response()->noContent();
    }
}
