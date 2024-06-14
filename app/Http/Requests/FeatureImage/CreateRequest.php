<?php

namespace App\Http\Requests\FeatureImage;

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
            "feature_image" => ["required"]
        ];

        return $rules;
    }

    public function messages()
    {
        $messages =[];

        $messages['feature_image.required'] = 'Please Select Photo';


        return $messages;
    }
}
