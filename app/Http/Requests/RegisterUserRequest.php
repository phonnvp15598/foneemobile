<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|unique:users|min:4',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:4'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Username không được để trống',
            'name.min' => 'Username phải nhiều hơn 4 kí tự',
            'name.unique' => 'Tên username đẫ tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải nhiều hơn 4 kí tự',
        ];
    }
}
