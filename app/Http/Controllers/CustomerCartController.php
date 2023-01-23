<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerCartController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();

        return response()->json([
            'data' => $customer->cart->products->load('productItem')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['product_id' => 'required', 'size' => 'required']);
        $customer = Customer::with('cart')->where('user_id', Auth::user()->id)->first();
        $product = Product::with('carts')->where('id', $validated['product_id'])->first();

        $cart_product = DB::table('cart_product')->where([
            'cart_id' => $customer->cart->id,
            'product_id' => $validated['product_id'],
            'size' => $validated['size']
        ])->first();

        if($cart_product) {
            $product->carts()->updateExistingPivot($customer->cart->id,
            [
                'quantity' => $cart_product->quantity + 1
            ]);
        } else {
            $customer->cart->products()->attach(
                $validated['product_id'],
                [
                    'size' => $validated['size'],
                    'quantity' => 1
                ]);
        }

        return response()->json([
            'data' => $customer->cart->products->load('productItem')
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'action' => 'required',
            'product_id' => 'required',
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);

        $quantity = $validated['quantity'];
        $action = $validated['action'];
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $product = Product::where('id', $validated['product_id'])->first();

        if($action === 'add') {
            $product->carts()->updateExistingPivot($validated['cart_id'],
                [
                    'quantity' => $quantity + 1
                ]);
        } else {
            $product->carts()->updateExistingPivot($validated['cart_id'],
            [
                'quantity' => $quantity - 1
            ]);
        }

        return response()->json([
            'data' => $customer->cart->products->load('productItem')
        ]);
    }

    public function destroy(Product $product, Request $request)
    {
        $validated = $request->validate(['product_id' => 'required', 'cart_id' => 'required']);
        // TODO:: delete only specific product size
        $product->carts()->detach($validated['cart_id']);
        $customer = Customer::where('user_id', Auth::user()->id)->first();

        return response()->json([
            'data' => $customer->cart->products->load('productItem')
        ]);
    }
}
