<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        return Cart::with('items.product')->get();
    }

    public function store(Request $request) {
        $cart = Cart::create($request->all());
        return response()->json($cart, 201);
    }

    public function show(Request $request) {
        return $cart->load('items.product');
    }
    public function delete(Request $request){
        $cart->delete();
        return response()->json(null, 204);
    }
}
