<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AttributeValueRequest;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{

    public function create(AttributeValueRequest $request)
    {
        $validated = $request->validated();
        AttributeValue::create([
            'attribute_id' => $validated['attribute_id'],
            'category_id' => $validated['category_id'],
            'name' => ucwords($validated['name']),
        ]);

        return response()->json(['message' => 'Succes'], 201);
    }
}
