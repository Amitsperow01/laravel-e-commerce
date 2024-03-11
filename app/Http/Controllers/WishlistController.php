<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function storeWishlist(Request $request)
    {
        // dd($request->all());
        if (!Auth::user() == null) {
            $data = $request->all();
            if (Wishlist::where('product_id',$request->product_id)->where('user_id',$request->user_id)->exists()) {
                Wishlist::where('product_id',$request->product_id)->where('user_id',$request->user_id)->delete();
                return redirect()->back();
            } else {
                $wishlist = Wishlist::create($data);
                return redirect()->back()->with('success', 'Add to wishlist successfully.');
            }
        }
        return redirect()->route('customer.login');
    }

    public function destory($productId)
    {
        $product = Wishlist::where('product_id',$productId)->where('user_id',Auth::user()->id)->delete();
        if ($product) {
            return redirect()->route('customer.profile')->with('success', 'Wishlist deleted successfully.');
        } else {
            return redirect()->back();
            // ->withErrors($validator)->withInput();
        }
        
    }
}
