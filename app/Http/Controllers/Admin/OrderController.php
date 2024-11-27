<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('product')->get();
        $orders = Order::with('order_items', 'user_address')->paginate(10);
        return Inertia::render('Admin/Order/Index', [
            'orderItems' => $orderItems,
            'orders' => $orders,
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
}
