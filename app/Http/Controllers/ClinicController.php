<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    // ✅ List all clinics
    public function index()
    {
        return response()->json(Clinic::all());
    }

    // ✅ Store new clinic
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'contact' => 'nullable|string|max:20',
            'timings' => 'nullable|string',
        ]);

        $clinic = Clinic::create($validated);

        return response()->json(['message' => 'Clinic created', 'data' => $clinic], 201);
    }

    // ✅ Show single clinic
    public function show(Clinic $clinic)
    {
        return response()->json($clinic);
    }

    // ✅ Update clinic
    public function update(Request $request, Clinic $clinic)
    {
        $validated = $request->validate([
            'name'    => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
            'contact' => 'nullable|string|max:20',
            'timings' => 'nullable|string',
        ]);

        $clinic->update($validated);

        return response()->json(['message' => 'Clinic updated', 'data' => $clinic]);
    }

    // ✅ Delete clinic
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return response()->json(['message' => 'Clinic deleted']);
    }
}
