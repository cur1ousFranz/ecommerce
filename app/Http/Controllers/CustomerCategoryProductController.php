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

        // Loop through product
        foreach ($products as $product) {
            $description = json_decode($product->description, true);
            // Loop through product -> description array
            foreach ($description as $key => $value) {
                $filters = json_decode($request->filters);
                // Check if the current key is 'Size'
                // 'Size' key is a nested array of object
                if($key === 'Size') {
                    // Loop through product description -> sizes array
                    foreach($value as $size) {
                        // Loop through lists request and match attributes and values
                        // The $size['count'] indicates how many sizes in specific product
                        foreach ($filters as $filtered) {
                            if($filtered->value === $size['name'] && $size['count'] > 0) {
                                if(!in_array($product, $result)) {
                                    $result[] = $product;
                                }
                            }
                        }
                    }
                } else {
                    foreach ($filters as $filtered) {
                        if($filtered->attribute === $key && $filtered->value === $value) {
                            if(!in_array($product, $result)) {
                                $result[] = $product;
                            }
                        }
                    }
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
