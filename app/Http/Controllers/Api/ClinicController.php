<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClinicController extends Controller
{
    // List all clinics
    public function index()
    {
        $clinics = Clinic::all();
        return response()->json($clinics);
    }

    // Store new clinic
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:255',
            'open_time'  => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'status'     => 'boolean',
        ]);

        $clinic = Clinic::create($data);

        return response()->json([
            'message' => 'Clinic created successfully',
            'clinic'  => $clinic
        ], 201);
    }

    // Show single clinic
    public function show(Clinic $clinic)
    {
        return response()->json($clinic);
    }

    // Update clinic
    public function update(Request $request, Clinic $clinic)
    {
        $data = $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'address'    => 'sometimes|required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:255',
            'open_time'  => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'status'     => 'boolean',
        ]);

        $clinic->update($data);

        return response()->json([
            'message' => 'Clinic updated successfully',
            'clinic'  => $clinic
        ]);
    }

    // Delete clinic
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return response()->json([
            'message' => 'Clinic deleted successfully'
        ]);
    }
}
