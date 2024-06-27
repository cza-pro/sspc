<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            "name" => ["required", "string", "max:20","alpha_dash"],
            "subject_id" => ["required"],
            "grade_id" => ["required"],
            "topic_id" => ["required"],
            "photo_type_id" => ["required"],
            "photo_url" => ["required", "mimes:jpg,jpeg,bmp,png"]
        ];

        return $rules;
    }

    public function messages()
    {
        $messages =[];

        $messages['name.required'] = '請輸入姓名!';
        $messages['name.alpha_dash'] = '請輸入字元和數字';
        $messages['subject_id.required'] = '請選擇主題';
        $messages['grade_id.required'] = '請選擇年級';
        $messages['topic_id.required'] = '請選擇主題';
        $messages['photo_type_id.required'] = '請選擇照片類型';
        $messages['photo_url.required'] = '請選擇照片';
        $messages['photo_url.mimes'] = '請選擇 jpg , jpeg, png,bmp 類型';


        return $messages;
    }
}
