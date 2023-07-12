<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name' => 'bail|required|max:255|min:5',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được phép trống',
            'name.max' => 'Không được phép quá 255 ký tự',
            'name.min' => 'Không được phép ít hơn 5 kí tự',
            'description.required' => 'Không được phép trống',
        ];
    }
}

