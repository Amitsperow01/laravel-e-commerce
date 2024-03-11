<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Quote;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use App\Models\QuoteItem;
use Illuminate\Support\Str;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   public function checkoutPage()
   {

      $cart_id = Session::get('cart_id');
      $cartdata = Quote::where('cart_id', $cart_id)->first();
      // dd($cartdata );
      return view('website.checkout', compact('cartdata'));
   }


   public function store(Request $request)
   {

      $data = $request->all();

      // dd($data);
      $request->validate([
         'billing_name'   => 'required',
         'billing_email'   => 'required',
         'billing_address_1' => 'required',
         'billing_phone'   => 'required',
         'billing_country' => 'required',
         'billing_state'   => 'required',
         'billing_city'    => 'required',
         'billing_pincode' => 'required',

      ]);

      if ($request->shipping_method == "standard_delivery") {
         $shippingCost = 0;
      } elseif ($request->shipping_method == "express_delivery") {
         $shippingCost = 100;
      } elseif ($request->shipping_method == "next_business_day") {
         $shippingCost = 50;
      };
      $cartId = Session::get('cart_id');
      $quotes = Quote::where('cart_id', $cartId)->first();
      $lastOrder = Order::orderBy('order_increment_id', 'desc')->first();
      if ($lastOrder) {
         $lastId = (int)Str::substr($lastOrder->order_increment_id, -7);
         $orderIncrementId = Str::padLeft($lastId + 1, 7, '0');
      } else {
         $orderIncrementId = '1000000';
      }


      $orderData = Order::create([
         'order_increment_id' => $orderIncrementId,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['billing_name'],
         'email' => $data['billing_email'],
         'phone' => $data['billing_phone'],
         'address' => $data['billing_address_1'],
         'address_2' => $data['billing_address_2'],
         'city' => $data['billing_city'],
         'state' => $data['billing_state'],
         'country' => $data['billing_country'],
         'pincode' => $data['billing_pincode'],
         'subtotal' => $quotes->subtotal,
         'coupon' => $quotes->coupon,
         'coupon_discount' => $quotes->coupon_discount,
         'shipping_cost' => $shippingCost,
         'total' => $quotes->total + $shippingCost,
         'payment_method' => $request->payment,
         'shipping_method' => $request->shipping_method

      ]);


      foreach ($quotes->quoteItems as $item) {
         // echo $item->name . '<br>';
         OrderItem::create([
            'order_id' => $orderData->id,
            'product_id' => $item->product_id,
            'name' => $item->name,
            'sku' => $item->sku,
            'price' => $item->price,
            'qty' => $item->qty,
            'row_total' => $item->row_total,
            'custom_option' => $item->custom_option
         ]);
      }

      $billingAddressType = "billing";
      $shippingAddressType = "shipping";

      $billingAddress = [
         'order_id' => $orderData->id,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['billing_name'],
         'email' => $data['billing_email'],
         'phone' => $data['billing_phone'],
         'address' => $data['billing_address_1'],
         'address_2' => $data['billing_address_2'],
         'city' => $data['billing_city'],
         'state' => $data['billing_state'],
         'country' => $data['billing_country'],
         'pincode' => $data['billing_pincode'],
         'address_type' => $billingAddressType
      ];

      $shippingAddress = [
         'order_id' => $orderData->id,
         'user_id' => $data['user_id'] ?? Auth::user()->id,
         'name' => $data['shipping_name'],
         'email' => $data['shipping_email'],
         'phone' => $data['shipping_phone'],
         'address' => $data['shipping_address_1'],
         'address_2' => $data['shipping_address_2'],
         'city' => $data['shipping_city'],
         'state' => $data['shipping_state'],
         'country' => $data['shipping_country'],
         'pincode' => $data['shipping_pincode'],
         'address_type' => $shippingAddressType
      ];


      OrderAddress::create($billingAddress);



      if ($request->ship_to_different_address == "on") {
         // echo "-----<br>------";
         // print_r($shippingAddress);

         OrderAddress::create($shippingAddress);
      } else {
         // echo "else";
         $billingAddress['address_type'] = $shippingAddressType;
         // print_r($billingAddress);
         OrderAddress::create($billingAddress);
      }

      QuoteItem::where('quote_id', $quotes->id)->delete();
      Quote::where('cart_id', $cartId)->delete();

      // OrderItem::
      return redirect()->route('checkout.success')->with('success', 'Order Placed successfully.!');
   }


   public function success()
   {
      return view('website.checksuccess');
   }
}
