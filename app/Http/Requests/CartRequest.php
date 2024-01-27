<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'price' => ['numeric', 'min:1000'],
            'product_id' => ['required','numeric','exists:products,id'],
            'qyt' => ['required', 'numeric', 'min:1', 'max:5']
        ];
    }
}
