<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Requests\Product\AttributeValueRequest;
use App\Models\Category;

class AttributeValueController extends Controller
{

    public function store(AttributeValueRequest $request)
    {
        $validated = $request->validated();
        $attribute = Attribute::find($request->attribute_id);
        $attribute->values()->create(['name' => ucwords($validated['name'])]);
        $category = Category::find($request->category_id);

        return response()->json([
            'data' => $category->attributes
        ]);
    }
}
