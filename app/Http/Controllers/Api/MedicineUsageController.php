<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicineUsage;
use Illuminate\Http\Request;

class MedicineUsageController extends Controller
{
    // List all medicine usage records
    public function index()
    {
        $usages = MedicineUsage::with(['medicine', 'patient', 'doctor', 'appointment'])->get();
        return response()->json($usages);
    }

    // Store new usage record
    public function store(Request $request)
    {
        $data = $request->validate([
            'medicine_id'    => 'required|exists:medicines,id',
            'patient_id'     => 'required|exists:patients,id',
            'doctor_id'      => 'required|exists:doctors,id',
            'appointment_id' => 'required|exists:appointments,id',
            'quantity'       => 'required|integer|min:1',
        ]);

        $usage = MedicineUsage::create($data);

        return response()->json([
            'message' => 'Medicine usage recorded successfully',
            'usage'   => $usage
        ], 201);
    }

    // Show single usage record
    public function show(MedicineUsage $medicineUsage)
    {
        $medicineUsage->load(['medicine', 'patient', 'doctor', 'appointment']);
        return response()->json($medicineUsage);
    }

    // Update usage record
    public function update(Request $request, MedicineUsage $medicineUsage)
    {
        $data = $request->validate([
            'medicine_id'    => 'sometimes|required|exists:medicines,id',
            'patient_id'     => 'sometimes|required|exists:patients,id',
            'doctor_id'      => 'sometimes|required|exists:doctors,id',
            'appointment_id' => 'sometimes|required|exists:appointments,id',
            'quantity'       => 'sometimes|required|integer|min:1',
        ]);

        $medicineUsage->update($data);

        return response()->json([
            'message' => 'Medicine usage updated successfully',
            'usage'   => $medicineUsage
        ]);
    }

    // Delete usage record
    public function destroy(MedicineUsage $medicineUsage)
    {
        $medicineUsage->delete();

        return response()->json([
            'message' => 'Medicine usage deleted successfully'
        ]);
    }
}
