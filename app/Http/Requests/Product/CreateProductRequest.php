<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required|unique:product_items,sku',
            'price' => 'required|integer',
            'qty_stock' => 'required|integer',
            'description' => 'required',
            'product_image' => 'required',
            'entry' => 'required',
            'sort' => 'required',
            'current_page' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'sku.required' => 'SKU is required.',
            'sku.unique' => 'SKU is already taken.',
            'price.required' => 'Price is required.',
            'price.integer' => 'Price type is invalid.',
            'qty_stock.required' => 'Quantity Stock is required.',
            'qty_stock.integer' => 'Quantity Stock type is invalid.',
        ];
    }
}
