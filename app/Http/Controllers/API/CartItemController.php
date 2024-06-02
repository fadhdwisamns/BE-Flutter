<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'cart_id' => 'required|exists:carts,id',
                'product_id' => 'required|exists:products,id',
                'stock' => 'required|integer|min:1',
            ]);

            $cartItem = CartItem::create($request->all());
            return response()->json($cartItem, 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    public function update(Request $request, CartItem $cartItem)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $cartItem->update($request->all());
            return response()->json($cartItem, 200);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return response()->json(null, 204);
    }
}