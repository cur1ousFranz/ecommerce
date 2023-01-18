<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CustomerCategoryAttributeController extends Controller
{
    public function show(Category $category)
    {
        return response()->json([
            'data' => $category->attributes
        ]);
    }
}
