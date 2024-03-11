<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('manage_roles'), 403);
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('manage_roles'), 403);
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create($data);

        $role->syncPermissions($request->input('permissions'));

        if($request->get('action') == 'save') {
            return redirect()->route('role.index')->withSuccess('Role add successfully.');
        } else {
            return redirect()->back()->withSuccess('Role add successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('manage_roles'), 403);
        $role = Role::find($id);
        $permissions = Permission::all();
        $role_permission = $role->permissions->pluck('name')->toArray();
        return view('admin.role.edit', compact('role', 'role_permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $role = Role::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|unique:roles,id,:id'
        ]);
        $role->update($data);

        // if ($request->has('permissions')) {
        //     $role->syncPermissions($request->permissions);
        // }

        
            $role->syncPermissions($request->permissions);
        
        return redirect()->route('role.index')->withSuccess('Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id', $id)->delete();
        return redirect()->back()->withSuccess('Role Deleted Successfully.');
    }
}
