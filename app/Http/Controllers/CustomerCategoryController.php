<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CustomerCategoryController extends Controller
{
    public function womenIndex()
    {
        $category = Category::with('children')->where('name', 'Women')->first();
        return response()->json([
            'data' => $category
        ]);
    }

    public function menIndex()
    {
        $category = Category::with('children')->where('name', 'Men')->first();
        return response()->json([
            'data' => $category
        ]);
    }

    public function kidsIndex()
    {
        $category = Category::with('children')->where('name', 'Kids')->first();
        return response()->json([
            'data' => $category
        ]);
    }

}
