<?php

namespace App\Http\Controllers\APIs;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-edit', ['only' => ['update', 'addUserToRole']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    // a. Show roles list with their users
    public function index()
    {
        try {
            $roles = Role::with('users')->get(); // Eager load users with roles
            return response()->json($roles);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve roles', 'message' => $e->getMessage()], 500);
        }
    }

    // b. Show a specific role with its permissions
    public function show($id)
    {
        try {
            $role = Role::with('permissions')->find($id);
            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            return response()->json($role);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve role', 'message' => $e->getMessage()], 500);
        }
    }

    // c. Create new role
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|unique:roles,name',
                'permissions' => 'required|array',
            ]);

            $role = Role::create(['name' => $validated['name']]);
            $role->syncPermissions($request->permissions);

            DB::commit();
            return response()->json(['success' => 'Role created successfully', 'role' => $role], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create role', 'message' => $e->getMessage()], 500);
        }
    }

    // d. Edit Role - i. Role Name ii. Edit Permissions
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|unique:roles,name,' . $id,
                'permissions' => 'nullable|array',
            ]);

            $role = Role::find($id);
            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            $role->name = $validated['name'];
            $role->save();

            if (!empty($validated['permissions'])) {
                $role->syncPermissions($validated['permissions']);
            }

            DB::commit();
            return response()->json(['success' => 'Role updated successfully', 'role' => $role], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update role', 'message' => $e->getMessage()], 500);
        }
    }

    // e. Add users to role
    public function addUsersToRole(Request $request, $roleId)
    {
        try {
            $validated = $request->validate([
                'user_ids' => 'required|array',
                'user_ids.*' => 'exists:users,id',
            ]);

            $role = Role::find($roleId);
            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            $addedUsers = [];
            $notFoundUsers = [];

            // Assign the role to each user in the array
            foreach ($validated['user_ids'] as $userId) {
                $user = User::find($userId);
                if ($user) {
                    $user->assignRole($role);
                    $addedUsers[] = $userId; // Store the successfully added user ID
                } else {
                    $notFoundUsers[] = $userId; // Store the not found user ID
                }
            }

            return response()->json([
                'success' => 'Users processed',
                'added_users' => $addedUsers,
                'not_found_users' => $notFoundUsers,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to add users to role', 'message' => $e->getMessage()], 500);
        }
    }

    // f. Delete Role
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            $role->delete();

            DB::commit();
            return response()->json(['success' => 'Role deleted successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete role', 'message' => $e->getMessage()], 500);
        }
    }
}