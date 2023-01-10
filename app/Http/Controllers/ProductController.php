<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\CreateProductRequest;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        return response()->json([
            'data' => Product::with('productItem')->latest()->paginate($request->entry)
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'data' => Product::with('categories','productItem')->where(['id' => $product->id])->first()
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $product = Product::create([
            'admin_id' => Auth::user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        $imageArray = [];
        foreach ($validated['product_image'] as $image) {
            $path = $image->store('product_images', 's3');
            $imageArray[] = Storage::disk('s3')->url($path);
        }

        $product->categories()->attach($validated['category_id']);
        $product->productItem()->create([
            'sku' => $validated['sku'],
            'qty_stock' => $validated['qty_stock'],
            'product_image' => json_encode($imageArray),
            'price' => $validated['price'],
        ]);

        return response()->json([
            'data' =>  Product::with('productItem')->latest()->paginate($request->entry)
        ]);
    }

    public function destroy(Product $product, Request $request)
    {
        $images = json_decode($product->productItem->product_image);
        foreach ($images as $image) {
            $path = parse_url($image , PHP_URL_PATH);
            Storage::disk('s3')->delete($path);
        }

        $product->delete();
        return response()->json([
            'data' => Product::with('productItem')->latest()->paginate($request->entry)
        ]);
    }
}
