<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view users')->only(['index', 'show']);
        $this->middleware('permission:create users')->only(['create', 'store']);
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        $this->middleware('permission:delete users')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = User::with('roles');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Status filter
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $users = $query->latest()->paginate(10);
        $roles = Role::pluck('name');

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::pluck('name');
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active
            ]);

            $user->assignRole($request->role);

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating user. Please try again.');
        }
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Update role if changed
            if ($request->role && $user->roles->first()->name !== $request->role) {
                $user->syncRoles($request->role);
            }

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating user. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'You cannot delete your own account.');
        }

        try {
            $user->delete();
            return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting user. Please try again.');
        }
    }

    public function toggleStatus(User $user)
    {
        try {
            $user->update(['is_active' => !$user->is_active]);
            return redirect()
                ->back()
                ->with('success', 'User status updated successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating user status. Please try again.');
        }
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        try {
            $user->syncRoles($request->role);
            return redirect()
                ->back()
                ->with('success', 'Role assigned successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error assigning role. Please try again.');
        }
    }
}