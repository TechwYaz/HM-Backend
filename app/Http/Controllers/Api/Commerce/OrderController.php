<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use App\Models\Commerce\Order;
use App\Notifications\Commerce\OrderStatusUpdated;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(
            Order::with(['user:id,name', 'orderItems.menuItem'])->get()
        );
    }
    public function myOrders(Request $request)
    {
        return response()->json(
            $request->user()->orders()->with('orderItems.menuItem')->get()
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'address'        => 'required|string',
            'phone'          => 'required|string',
            'notes'          => 'nullable|string',
            'payment_method' => 'required|in:cash,card'
        ]);

        $cart = $request->user()->cart->load('cartItems.menuItem');

        $total = $cart->cartItems->sum(function ($item) {
            return $item->menuItem->price * $item->quantity;
        });

        $order = Order::create([
            'user_id'        => $request->user()->id,
            'total'          => $total,
            'address'        => $request->address,
            'phone'          => $request->phone,
            'notes'          => $request->notes,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
        ]);
        foreach ($cart->cartItems as $item) {
            $order->orderItems()->create([
                'menu_item_id' => $item->menu_item_id,
                'quantity'     => $item->quantity,
                'unit_price'   => $item->menuItem->price,
            ]);
        }
        $cart->cartItems()->delete();

        return response()->json($order->load('orderItems.menuItem'), 201);
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,in_progress,delivered,rejected'
        ]);

        $order->update(['status' => $request->status]);

        try {
            if ($order->user) {
                $order->user->notify(new OrderStatusUpdated($order));
            }
        } catch (\Throwable) {
        }

        return response()->json($order, 200);
    }
}
