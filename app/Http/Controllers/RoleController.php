<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage roles');
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();

        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error creating role. Please try again.');
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();

        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            DB::commit();

            return redirect()
                ->route('roles.index')
                ->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating role. Please try again.');
        }
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete role with assigned users.');
        }

        try {
            $role->delete();
            return redirect()
                ->route('roles.index')
                ->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting role. Please try again.');
        }
    }
}