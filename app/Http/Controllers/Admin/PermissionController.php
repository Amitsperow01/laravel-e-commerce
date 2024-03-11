<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('manage_permission'), 403);
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('manage_permission'), 403);
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
                
        $data = $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        Permission::create($data);

        if($request->get('action') == 'save') {
            return redirect()->route('permission.index')->withSuccess('Permission add successfully.');
        } else {
            return redirect()->back()->withSuccess('Permission add successfully.');
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
        // echo $id;
        abort_unless(Gate::allows('manage_permission'), 403);
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        // dd($request->all());

        $permission->update($data);
        return redirect()->route('permission.index')->withSuccess('Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // echo $id;
        Permission::where('id', $id)->delete();
        return redirect()->back()->withSuccess('Permission Deleted Successfully.');
    }
}
