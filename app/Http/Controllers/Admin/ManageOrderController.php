<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function index()
    {
    $orders = Order::all();
    return view('admin.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        $billingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'billing')->first();
        $shippingAddress = OrderAddress::where('order_id', $id)->where('address_type', 'shipping')->first();
        $orderItems = OrderItem ::where('order_id', $id)->get();
        return view('admin.orders.show', compact('order', 'billingAddress', 'shippingAddress', 'orderItems'));
    }
}
