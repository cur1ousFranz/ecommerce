<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerCartController extends Controller
{
    public function getCustomer()
    {
        return Customer::with('cart')->where('user_id', Auth::user()->id)->first();
    }
    public function index()
    {
        $customer = $this->getCustomer();
        return response()->json([
            'data' => $customer->cart->products->load('productItem', 'categories')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['product_id' => 'required', 'size' => 'required']);
        $customer = $this->getCustomer();
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
                    'quantity' => 1,
                    'checkout' => true
                ]);
        }

        return response()->json([
            'data' => $customer->cart->products->load('productItem', 'categories')
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'action' => 'required',
            'product_id' => 'required',
            'cart_id' => 'required',
            'size' => 'required',
            'quantity' => 'required',
        ]);

        $quantity = $validated['quantity'];
        $action = $validated['action'];
        $customer = $this->getCustomer();
        $product = Product::where('id', $validated['product_id'])->first();

        if($action === 'add') {
            $product->carts()->wherePivot('cart_id', $validated['cart_id'])
                ->wherePivot('size', $validated['size'])
                ->update(['quantity' => $quantity + 1]);
        } else {
            $product->carts()->wherePivot('cart_id', $validated['cart_id'])
            ->wherePivot('size', $validated['size'])
            ->update(['quantity' => $quantity - 1]);
        }

        return response()->json([
            'data' => $customer->cart->products->load('productItem', 'categories')
        ]);
    }

    public function updateCheckout(Product $product, Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'size' => 'required',
            'cart_id' => 'required',
            'checkout' => 'required',
        ]);

        $customer = $this->getCustomer();
        $product = Product::where('id', $validated['product_id'])->first();

        if($validated['checkout'] === 'select') {
            $product->carts()->wherePivot('cart_id', $validated['cart_id'])
                ->wherePivot('size', $validated['size'])
                ->update(['checkout' => 1]);
        } else {
            $product->carts()->wherePivot('cart_id', $validated['cart_id'])
            ->wherePivot('size', $validated['size'])
            ->update(['checkout' => 0]);
        }

        return response()->json([
            'data' => $customer->cart->products->load('productItem', 'categories')
        ]);
    }

    public function destroy(Product $product, Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'cart_id' => 'required',
            'size' => 'required'
        ]);
        $product->carts()->wherePivot('cart_id', $validated['cart_id'])
            ->wherePivot('size', $validated['size'])->detach();

        $customer = $this->getCustomer();
        return response()->json([
            'data' => $customer->cart->products->load('productItem', 'categories')
        ]);
    }
}
