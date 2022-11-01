<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCustomerRequest extends FormRequest
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
            'comment_content' => 'required|min:4',
            'comment_rate' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'comment_content.required' => 'Nội dung bình luận không được để trống',
            'comment_content.min' => 'Nội dung bình luận phải nhiều hơn 4 kí tự',
            'comment_rate.required' => 'Chưa chọn mức độ đánh giá'
        ];
    }
}
