<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'config_key' => 'bail|required|unique:settings|max:255|min:5',
            'config_value' => 'bail|required|unique:settings|max:255|min:5',
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'name.required' => 'Không được phép trống',
//            'name.unique' => 'Không được phép trùng',
//            'name.max' => 'Không được phép quá 255 ký tự',
//            'name.min' => 'Không được phép ít hơn 5 kí tự',
//            'description.required' => 'Không được phép trống',
//        ];
//    }
}


