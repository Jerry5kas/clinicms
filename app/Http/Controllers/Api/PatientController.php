<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // List all patients
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    // Store new patient
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'        => 'nullable|exists:users,id',
            'full_name'      => 'required|string|max:255',
            'dob'            => 'nullable|date',
            'gender'         => 'nullable|in:male,female,other',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string|max:255',
            'blood_group'    => 'nullable|string|max:10',
            'medical_history'=> 'nullable|array',
        ]);

        $patient = Patient::create($data);

        return response()->json([
            'message' => 'Patient created successfully',
            'patient' => $patient
        ], 201);
    }

    // Show single patient
    public function show(Patient $patient)
    {
        return response()->json($patient);
    }

    // Update patient
    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'user_id'        => 'nullable|exists:users,id',
            'full_name'      => 'sometimes|required|string|max:255',
            'dob'            => 'nullable|date',
            'gender'         => 'nullable|in:male,female,other',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string|max:255',
            'blood_group'    => 'nullable|string|max:10',
            'medical_history'=> 'nullable|array',
        ]);

        $patient->update($data);

        return response()->json([
            'message' => 'Patient updated successfully',
            'patient' => $patient
        ]);
    }

    // Delete patient
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'message' => 'Patient deleted successfully'
        ]);
    }
}
