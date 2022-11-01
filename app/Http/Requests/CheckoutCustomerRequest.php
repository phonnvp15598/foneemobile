<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutCustomerRequest extends FormRequest
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
            'shipping_name' => 'required',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|numeric|min:10',
            'shipping_address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'shipping_name.required' => 'Tên người nhận không được để trống',
            'shipping_email.required' => 'Email không được để trống!',
            'shipping_email.email' => 'Email không đúng định dạng',
            'shipping_phone.required' => 'Số điện thoại không được để trống',
            'shipping_phone.numeric' => 'Số điện thoại phải là số',
            'shipping_phone.min' => 'Số điện thoại phải hơn 10 số',
            'shipping_address.required' => 'Địa chỉ giao hàng không được để trống',
            'city.required' => 'Tỉnh/TP không được để trống',
            'district.required' => 'Quận/Huyện không được để trống',
            'ward.required' => 'Phường/Xã không được để trống',

        ];
    }
}
