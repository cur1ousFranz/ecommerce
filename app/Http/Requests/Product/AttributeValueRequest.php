<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
            'attribute_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|string|unique:attribute_values,name,NULL,id,attribute_id,'. $this->attribute_id . ',category_id,' . $this->category_id,
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Attribute ID is required.',
            'category_id.required' => 'Category ID is required.',
            'name.required' => 'Value is required.',
            'name.string' => 'Value must not contain number and symbols.',
            'name.unique' => 'Value already exist in this attribute.',
        ];
    }
}
