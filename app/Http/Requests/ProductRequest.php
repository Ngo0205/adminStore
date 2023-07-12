<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|unique:products|max:255|min:5',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được phép trống',
            'name.unique' => 'Không được phép trùng',
            'name.max' => 'Không được phép quá 255 ký tự',
            'name.min' => 'Không được phép ít hơn 5 kí tự',
            'price.required' => 'Không được phép trống',
            'category_id.required' => 'Không được phép trống',
            'contents.required' => 'Không được phép trống'
        ];
    }
}
