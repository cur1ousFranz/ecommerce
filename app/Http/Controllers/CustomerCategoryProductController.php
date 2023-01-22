<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerCategoryProductController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate(['slug' => 'required', 'price_range' => 'required']);
        $category = Category::where('slug', $validated['slug'])->first();
        $products = $category->products->load('productItem');
        $result = [];
        // Loop through product
        if($request->has('filters')) {
            foreach ($products as $product) {
                if($product->productItem->price <= $validated['price_range']) {
                    $description = json_decode($product->description, true);
                    $filters = json_decode($request->filters);
                    // Loop through product -> description array
                    foreach ($description as $key => $value) {
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
            }
        } else {
            foreach ($products as $product) {
                if($product->productItem->price <= $validated['price_range']) {
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
            'data' => $category->products()->latest()->with('productItem')->get()
        ]);
    }

    public function search(Request $request)
    {
        $validated = $request->validate(['search' => 'required', 'slug' => 'required']);
        $search = $validated['search'];
        $category = Category::where('slug', $validated['slug'])->first();
        $products = $category->products->load('productItem');
        $result = [];

        $productList = Product::with('productItem')->whereHas('productItem', function ($query) use ($search) {
            $query->where('sku', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%');
            })
            ->orWhere('name', 'like', '%'.$search.'%')
            ->whereHas('categories', function ($query) use ($validated) {
                $query->where('slug', $validated['slug']);
            })
            ->get();

        foreach ($productList as $product) {
            if(!in_array($product, $result)) {
                $result[] = $product;
            }
        }

        foreach ($products as $product) {
            $description = json_decode($product->description, true);
            foreach ($description as $key => $value) {
                if($key === 'Size') {
                    foreach($value as $size) {
                        if($size['name'] === $search && $size['count'] > 0) {
                            if(!in_array($product, $result)) {
                                $result[] = $product;
                            }
                        }
                    }
                } else {
                    if($value == $search) {
                        if(!in_array($product, $result)) {
                            $result[] = $product;
                        }
                    }
                }
            }
        }

        return response()->json([
            'data' => $result
        ]);
    }
}
