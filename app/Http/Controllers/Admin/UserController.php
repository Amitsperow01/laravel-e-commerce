<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::orderBy('name')->Paginate(3);
        return view('admin.user.index',compact('users'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('name')->get();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required |unique:users|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'roles' => 'required',
        ]);
      
        $user = User::create([
            'name'=>$request->name ,
            'email'=>$request->email ,
            'password'=>$request->password,
            'roles'=>$request-> roles,
            'is_admin'=>1
        ]);

        $user->syncRoles($request->input('roles'));
        return redirect()->route('user.index')->with('success','Data Save Successfully');
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
        $user = User::findOrFail($id);
        $roles = Role::select('name')->get();
        $slctRole = $user->Roles->pluck('name')->toArray();
        return view('admin.user.edit',compact('user','roles','slctRole'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!($request->password)) {
            $data = $request->validate([
             'name' => 'required',
             "email" => "required|email|unique:users,email," . $id,
             'roles' => 'required',
 
             ]);
            $user = User::where('id',$id)->update([
             "name" => $data["name"],
             "email" => $data["email"],
            ]);
         } else {
             $data = $request->validate([
                 "name" => "required",
                 "email" => "required|email|unique:users,email," . $id,
                 "password" => "required|min:3",
                 "confirm_password" => "required|min:3|same:password",
                  'roles' => 'required',
                 
             ]);
            $user = User::where('id',$id)->update([
             "name" => $data["name"],
             "email" => $data["email"],
             "password" => bcrypt($data["password"]),
            ]);
             
         }
         
         $user = User::findOrFail($id);
         $user->syncRoles($request->roles);
         return redirect()->route("user.index")->with("success", "Data update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        user::where('id',$id)->delete();
        return redirect()->route("user.index")->with("success", "Data delete Successfully");
    }
}
