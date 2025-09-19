<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // List all doctors
    public function index()
    {
        $doctors = Doctor::with(['clinic', 'user'])->get();
        return response()->json($doctors);
    }

    // Store new doctor
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'         => 'required|exists:users,id',
            'clinic_id'       => 'required|exists:clinics,id',
            'specialization'  => 'required|string|max:255',
            'experience'      => 'nullable|integer|min:0',
            'consultation_fee'=> 'nullable|numeric|min:0',
            'available_days'  => 'nullable|array',
            'available_time'  => 'nullable|array', // ['start'=>'09:00','end'=>'17:00']
        ]);

        $doctor = Doctor::create($data);

        return response()->json([
            'message' => 'Doctor created successfully',
            'doctor'  => $doctor
        ], 201);
    }

    // Show single doctor
    public function show(Doctor $doctor)
    {
        $doctor->load(['clinic', 'user']);
        return response()->json($doctor);
    }

    // Update doctor
    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'user_id'         => 'sometimes|required|exists:users,id',
            'clinic_id'       => 'sometimes|required|exists:clinics,id',
            'specialization'  => 'sometimes|required|string|max:255',
            'experience'      => 'nullable|integer|min:0',
            'consultation_fee'=> 'nullable|numeric|min:0',
            'available_days'  => 'nullable|array',
            'available_time'  => 'nullable|array',
        ]);

        $doctor->update($data);

        return response()->json([
            'message' => 'Doctor updated successfully',
            'doctor'  => $doctor
        ]);
    }

    // Delete doctor
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return response()->json([
            'message' => 'Doctor deleted successfully'
        ]);
    }
}
