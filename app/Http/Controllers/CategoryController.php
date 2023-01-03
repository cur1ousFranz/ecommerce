<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::take(3)->get();

        return response()->json([
            'data' => $categories
        ]);
    }

    public function show(Category $category)
    {
        $category = Category::find($category->id);

        return response()->json([
            'data' => $category->children
        ]);
    }

    public function showAttribute(Category $category)
    {
        $category = Category::find($category->id);

        return response()->json([
            'data' => $category->attributes
        ]);
    }
}
