<?php

namespace App\Http\Controllers\Api\Commerce;

use App\Http\Controllers\Controller;
use App\Models\Commerce\Cart;
use App\Models\Commerce\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->user()->cart;

        if (!$cart) {
            return response()->json(['cart_items' => []]);
        }

        return response()->json($cart->load('cartItems.menuItem'));
    }


    public function addItem(Request $request)
    {

        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity'     => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);


        $cartItem = $cart->cartItems()->updateOrCreate(
            ['menu_item_id' => $request->menu_item_id],
            ['quantity'     => $request->quantity]
        );



        return response()->json(
            $request->user()->cart->load('cartItems.menuItem'),
            201
        );
    }


    public function updateItem(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json($cartItem);
    }


    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart'], 200);
    }
}
