<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBrandRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:tbl_brand|min:4',
            'brand_desc' => 'required|min:4'
        ];
    }
    public function messages()
    {
        return [
            'brand_name.required' => 'Tên thương hiệu không được để trống',
            'brand_name.unique' => 'Tên thương hiệu đã tồn tại',
            'brand_name.min' => 'Tên thương hiệu phải nhiều hơn 4 kí tự',
            'brand_desc.required' => 'Mô tả thương hiệu không được để trống',
            'brand_desc.min' => 'Mô tả thương hiệu phải nhiều hơn 4 kí tự',
        ];
    }
}
