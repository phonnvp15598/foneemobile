<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'product_name' => 'required|unique:tbl_product|min:4',
            'product_price' => 'required|numeric',
            'product_desc' => 'required|min:4',
            'product_content'=> 'required|min:4',

        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại',
            'product_name.min' => 'Tên sản phẩm phải nhiều hơn 4 kí tự',
            'product_price.required' => 'Giá sản phẩm không được để trống',
            'product_price.numeric' => 'Giá sản phẩm phải là số',
            'product_desc.required' => 'Mô tả sản phẩm không được để trống',
            'product_desc.min' => 'Mô tả sản phẩm phải nhiều hơn 4 kí tự',
            'product_content.required' => 'Nội dung sản phẩm không được để trống',
            'product_content.min' => 'Nội dung sản phẩm phải nhiều hơn 4 kí tự',
        ];
    }
}
