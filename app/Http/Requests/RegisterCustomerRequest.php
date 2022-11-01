<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'customer_name' => 'required|unique:tbl_customer|min:4',
            'customer_email' => 'required|email|unique:tbl_customer',
            'customer_password'=> 'required|min:4'
            // 'customer_phone'=> 'required|numeric|min:10',
        ];
    }
    public function messages(){
        return [
            'customer_name.required' => 'Tên không được để trống',
            'customer_name.min' => 'Tên phải nhiều hơn 4 kí tự',
            'customer_name.unique' => 'Tên đẫ tồn tại',
            'customer_email.required' => 'Email không được để trống',
            'customer_email.email' => 'Email không đúng định dạng',
            'customer_email.unique' => 'Email đã tồn tại',
            'customer_password.required' => 'Password không được để trống',
            'customer_password.min' => 'Password phải nhiều hơn 4 kí tự'
            // 'customer_phone.required' => 'Số điện thoại không được để trống',
            // 'customer_phone.min' => 'Số điện thoại phải nhiều hơn 10 số',
            // 'customer_phone.numeric' => 'Số điện thoại phải là số',
        ];
    }
}
