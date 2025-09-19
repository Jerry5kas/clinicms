<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::with('clinic')->get();
        return response()->json($users);
    }

    // Store new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'clinic_id'      => 'nullable|exists:clinics,id',
            'phone'          => 'nullable|string|unique:users,phone',
            'specialization' => 'nullable|string',
            'designation'    => 'nullable|string',
            'status'         => 'nullable|boolean',
        ]);

        $user = User::create($data);

        return response()->json([
            'message' => 'User created successfully',
            'user'    => $user
        ], 201);
    }

    // Show single user
    public function show(User $user)
    {
        $user->load('clinic');
        return response()->json($user);
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'           => 'sometimes|required|string|max:255',
            'email'          => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password'       => 'nullable|string|min:6',
            'clinic_id'      => 'nullable|exists:clinics,id',
            'phone'          => 'nullable|string|unique:users,phone,' . $user->id,
            'specialization' => 'nullable|string',
            'designation'    => 'nullable|string',
            'status'         => 'nullable|boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $user
        ]);
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
