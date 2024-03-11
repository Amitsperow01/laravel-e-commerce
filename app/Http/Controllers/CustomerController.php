<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class CustomerController extends Controller
{
    public function index()
    {
        return view('website.customer.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|numeric|min:5',
        ]);
        $customer = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);

        if ($customer) {
            return redirect()->route('customer.login')->with('success', 'User create successfully !');
        } else {
            return back()->with('error', 'Oops something went wrong! Please try again !');
        }
    }

    public function login(Request $request)
    {
        // $request->session()->regenerateToken();


        return view('website.customer.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            reActiveCart(Auth::user()->id);

            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'You have successfully logged in!');
        }

        return back()->with('error', 'Your provided credentials do not match in our records.')->onlyInput('email');
    }

    public function profile()
    {
        $userId = Auth::user()->id ?? null;
        if ($userId) {
            $orders = Order::where('user_id', $userId)->get();
            $orderAddress = OrderAddress::where('user_id', $userId)->where('address_type', 'shipping_address')->get();
            $wishlists = Wishlist::where('user_id', $userId)->with('product')->get();

            return view('website.customer.profile', compact('orders', 'wishlists', 'orderAddress'));
        } else {
            return redirect()->route('customer.login')->with('error', 'You are login credentials fill.!');
        }
    }

    public function update(Request $request)
    {
        $auth = Auth::user();

        if (!Hash::check($request->current_pwd, $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }
        if (strcmp($request->current_pwd, $request->new_pwd) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_pwd);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }

    public function updateOrCreateAddress(Request $request)
    {
        if ($request->addressId) {
            OrderAddress::where('id', $request->addressId)->update([
                'user_id' => $request->user_id ?? Auth::user()->id,
                'name'    => $request->name,
                'phone'   => $request->phone,
                'address' => $request->address,
                'country' => $request->country,
                'state'   => $request->state,
                'city'    => $request->city,
                'pincode' => $request->pincode
            ]);
            return back()->with('success', "Address Updated Successfully");
        } else {
            OrderAddress::create([
                'user_id'      => Auth::user()->id ?? null,
                'name'         => $request->name,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'country'      => $request->country,
                'state'        => $request->state,
                'city'         => $request->city,
                'pincode'      => $request->pincode,
                'address_type' => 'shipping_address	'
            ]);
            return back()->with('success', "Address Created Successfully");
        }
    }


    public function logout(Request $request)
    {

        Session::forget('cart_id');

        Auth::logout();
        $request->session()->invalidate();
        // $request->session()->regenerateToken();  
        return redirect()->route('home')->with('success', 'You have logged out successfully!');;
    }
}
