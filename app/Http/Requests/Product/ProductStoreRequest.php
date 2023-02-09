<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "product_id" => ['required', 'string'],
            "type" => ['required', 'string', 'max:255'],
            "brand" => ['required', 'string', 'max:255'],
            "model" => ['required', 'string', 'max:255'],
            "capacity" => ['required', 'string', 'max:255'],
            "quantity" => ['required']
        ];
    }
}
