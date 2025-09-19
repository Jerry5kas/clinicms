<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // List all appointments
    public function index()
    {
        $appointments = Appointment::with(['clinic', 'doctor', 'patient'])->get();
        return response()->json($appointments);
    }

    // Store new appointment
    public function store(Request $request)
    {
        $data = $request->validate([
            'clinic_id'        => 'required|exists:clinics,id',
            'doctor_id'        => 'required|exists:doctors,id',
            'patient_id'       => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'status'           => 'nullable|in:pending,confirmed,completed,cancelled,no-show',
            'check_in_time'    => 'nullable|date',
            'check_out_time'   => 'nullable|date',
            'notes'            => 'nullable|string',
        ]);

        $appointment = Appointment::create($data);

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);
    }

    // Show single appointment
    public function show(Appointment $appointment)
    {
        $appointment->load(['clinic', 'doctor', 'patient', 'payment']);
        return response()->json($appointment);
    }

    // Update appointment
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'clinic_id'        => 'sometimes|required|exists:clinics,id',
            'doctor_id'        => 'sometimes|required|exists:doctors,id',
            'patient_id'       => 'sometimes|required|exists:patients,id',
            'appointment_date' => 'sometimes|required|date',
            'appointment_time' => 'sometimes|required|date_format:H:i',
            'status'           => 'nullable|in:pending,confirmed,completed,cancelled,no-show',
            'check_in_time'    => 'nullable|date',
            'check_out_time'   => 'nullable|date',
            'notes'            => 'nullable|string',
        ]);

        $appointment->update($data);

        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ]);
    }

    // Delete appointment
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([
            'message' => 'Appointment deleted successfully'
        ]);
    }
}
