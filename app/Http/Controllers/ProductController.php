<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Nette\Utils\Json;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $validated = $request->validate(['sort' => 'required', 'entry' => 'required', 'current_page' => 'required']);

        return response()->json([
            'data' => $this->sort($validated['sort'], $validated['entry'], $validated['current_page'])
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'data' => Product::with('categories', 'productItem')->where(['id' => $product->id])->first()
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

        $products = $this->sort($validated['sort'], $validated['entry'], $validated['current_page']);
        return response()->json([
            'data' => $products
        ]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $validated = $request->validated();
        $newImageArray = [];
        if ($request->has('deleted_image')) {
            foreach ($request->deleted_image as $image) {
                $path = parse_url($image, PHP_URL_PATH);
                Storage::disk('s3')->delete($path);

                $productImages = json_decode($product->productItem->product_image);
                foreach ($productImages as $productImage) {
                    if ($productImage != $image) {
                        $newImageArray[] = $productImage;
                    }
                }
            }
            $product->productItem->product_image = json_encode($newImageArray);
        }

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->productItem->sku = $validated['sku'];
        $product->productItem->qty_stock = $validated['qty_stock'];
        $product->productItem->price = $validated['price'];
        $product->productItem->save();
        $product->save();

        $products = $this->sort($validated['sort'], $validated['entry'], $validated['current_page']);
        return response()->json([
            'data' => $products
        ]);
    }

    public function destroy(Product $product, Request $request)
    {
        $validated = $request->validate(['sort' => 'required', 'entry' => 'required', 'current_page' => 'required']);

        $images = json_decode($product->productItem->product_image);
        foreach ($images as $image) {
            $path = parse_url($image, PHP_URL_PATH);
            Storage::disk('s3')->delete($path);
        }

        $product->delete();
        $products = $this->sort($validated['sort'], $validated['entry'], $validated['current_page']);
        return response()->json([
            'data' => $products
        ]);
    }

    public function search(Request $request)
    {
        $validated = $request->validate(['entry' => 'required']);
        $search = $request->search;
        $entry = $validated['entry'];

        $products = Product::with('productItem')->orWhereHas('productItem', function ($query) use ($search) {
            $query->where('sku', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%');
        })
        ->orWhere('name', 'like', '%'.$search.'%')
        ->paginate($entry);

        return response()->json([
            'data' => $products
        ]);
    }

    public function sort($sort, $perPage, $currentPage)
    {
        $products = Product::with('productItem');

        switch($sort) {
            case 'Latest': $products->latest();
                break;
            case 'Sku': $products->join('product_items', 'products.id', '=', 'product_items.product_id')
                    ->orderBy('product_items.sku');
                break;
            case 'Name': $products->orderBy('name');
                break;
            case 'Qty': $products->join('product_items', 'products.id', '=', 'product_items.product_id')
                    ->orderBy('product_items.qty_stock');
                break;
            case 'Price': $products->join('product_items', 'products.id', '=', 'product_items.product_id')
                    ->orderBy('product_items.price');
                break;
        }

        // Return at the same page
        return $products->paginate($perPage, ['*'], 'page', $currentPage);
    }
}
