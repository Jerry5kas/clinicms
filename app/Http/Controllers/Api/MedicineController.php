<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    // List all medicines
    public function index()
    {
        $medicines = Medicine::with('clinic')->get();
        return response()->json($medicines);
    }

    // Store new medicine
    public function store(Request $request)
    {
        $data = $request->validate([
            'clinic_id'   => 'required|exists:clinics,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock'       => 'nullable|integer|min:0',
            'price'       => 'nullable|numeric|min:0',
            'expiry_date' => 'nullable|date',
        ]);

        $medicine = Medicine::create($data);

        return response()->json([
            'message'  => 'Medicine created successfully',
            'medicine' => $medicine
        ], 201);
    }

    // Show single medicine
    public function show(Medicine $medicine)
    {
        $medicine->load('clinic');
        return response()->json($medicine);
    }

    // Update medicine
    public function update(Request $request, Medicine $medicine)
    {
        $data = $request->validate([
            'clinic_id'   => 'sometimes|required|exists:clinics,id',
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'stock'       => 'nullable|integer|min:0',
            'price'       => 'nullable|numeric|min:0',
            'expiry_date' => 'nullable|date',
        ]);

        $medicine->update($data);

        return response()->json([
            'message'  => 'Medicine updated successfully',
            'medicine' => $medicine
        ]);
    }

    // Delete medicine
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return response()->json([
            'message' => 'Medicine deleted successfully'
        ]);
    }
}
