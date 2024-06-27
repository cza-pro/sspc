<?php

namespace App\Http\Requests\Topic;

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
            "name" => ["required", "string", "max:20","alpha_dash"]
        ];

        return $rules;
    }

    public function messages()
    {
        $messages =[];

        $messages['name.required'] = '請輸入主題名稱!';
        $messages['name.alpha_dash'] = '請輸入字元和數字!';


        return $messages;
    }
}
