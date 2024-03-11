<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login.index');
       }
    
       public function login(Request $request){
         $request->validate([
            'email'=>'required',
            'password'=>'required'
         ]);
          $loginData=$request->only('email','password');
         //  dd($loginData);
          if (Auth::attempt($loginData)){
             return redirect()->route('dashboard');
          }else{
             return redirect()->route('login');
          }
       }
       public function logout(){
          Auth::logout();
          return redirect()->route('login');
       }
}
