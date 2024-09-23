<?php

namespace App\Http\Controllers\APIs;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:user-create', ['only' => ['store']]);
        // $this->middleware('permission:user-edit', ['only' => ['update', 'toggleStatus']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return User::with('roles')->get();
    }

    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'phone_number' => 'nullable|string|max:50',
                'role' => 'nullable|string|exists:roles,name',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'phone_number' => $validated['phone_number'] ?? null,
            ]);

            if (isset($validated['role']) && $validated['role']) {
                $user->assignRole($validated['role']);
            }

            return response()->json($user->load('roles'));
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create user', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6',
                'phone_number' => 'nullable|string|max:50',
                'role' => 'nullable|string|exists:roles,name',
            ]);

            $user->update([
                'name' => $validated['name'] ?? $user->name,
                'email' => $validated['email'] ?? $user->email,
                'phone_number' => $validated['phone_number'] ?? $user->phone_number,
            ]);

            if (!empty($validated['password'])) {
                $user->update(['password' => Hash::make($validated['password'])]);
            }

            // Update the user's role
            if (!empty($validated['role'])) {
                $user->syncRoles($validated['role']);
            }

            return response()->json($user->load('roles'));
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update user', 'message' => $e->getMessage()], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->status = !$user->status;
            $user->save();
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update user status', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return response()->json(['message' => 'User deleted']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete user', 'message' => $e->getMessage()], 500);
        }
    }
}