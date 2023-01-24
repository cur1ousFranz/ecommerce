<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function show(Request $request)
    {
        $validated = $request->validate(['sku' => 'required']);
        $product = Product::with('productItem')->whereHas('productItem', function ($query) use ($validated) {
            $query->where('sku', $validated['sku']);
        })
        ->first();

        if(!$product) {
            return response()->json([
                'error' => 'Product not found!'
            ], 404);
        }

        return response()->json([
            'data' => $product
        ]);
    }
}
