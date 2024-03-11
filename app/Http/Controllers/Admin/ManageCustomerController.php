<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageCustomerController extends Controller
{
    public function index() {

        $customers =User::where('is_admin',0)->get();
        return view('admin.customer.index',compact('customers'));
    }
}
