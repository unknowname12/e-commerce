<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'category_id' => ['nullable' ,'numeric', 'exists:categories,id'],
            'images' => ['nullable', 'mimes:jpeg,jpg,png']
        ];
    }
}
