<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // List all medical records
    public function index()
    {
        $records = MedicalRecord::with(['patient', 'doctor', 'appointment'])->get();
        return response()->json($records);
    }

    // Store new medical record
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'     => 'required|exists:patients,id',
            'doctor_id'      => 'required|exists:doctors,id',
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis'      => 'nullable|string',
            'treatment'      => 'nullable|string',
            'prescription'   => 'nullable|array',
            'attachments'    => 'nullable|array',
        ]);

        $record = MedicalRecord::create($data);

        return response()->json([
            'message' => 'Medical record created successfully',
            'record'  => $record
        ], 201);
    }

    // Show single medical record
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient', 'doctor', 'appointment']);
        return response()->json($medicalRecord);
    }

    // Update medical record
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validate([
            'patient_id'     => 'sometimes|required|exists:patients,id',
            'doctor_id'      => 'sometimes|required|exists:doctors,id',
            'appointment_id' => 'sometimes|required|exists:appointments,id',
            'diagnosis'      => 'nullable|string',
            'treatment'      => 'nullable|string',
            'prescription'   => 'nullable|array',
            'attachments'    => 'nullable|array',
        ]);

        $medicalRecord->update($data);

        return response()->json([
            'message' => 'Medical record updated successfully',
            'record'  => $medicalRecord
        ]);
    }

    // Delete medical record
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return response()->json([
            'message' => 'Medical record deleted successfully'
        ]);
    }
}
