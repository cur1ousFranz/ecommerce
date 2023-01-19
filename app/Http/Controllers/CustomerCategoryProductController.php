<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CustomerCategoryProductController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::where('slug', $request->slug)->first();
        $products = $category->products->load('productItem');
        $result = [];

        foreach ($products as $product) {
            $description = json_decode($product->description, true);
            foreach ($description as $key => $value) {
                if($key === $request->key && $value === $request->value){
                    $result[] = $product;
                }
            }
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function show(Category $category)
    {
        return response()->json([
            'data' => $category->products->load('productItem')
        ]);
    }
}
