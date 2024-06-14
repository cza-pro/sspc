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
            "name" => ["required"],
            "subject_id" => ["required"],
            "grade_id" => ["required"],
            "topic_id" => ["required"],
            "photo_type_id" => ["required"],
            "photo_url" => ["required"]
        ];

        return $rules;
    }

    public function messages()
    {
        $messages =[];

        $messages['name.required'] = 'Please enter Name';
        $messages['subject_id.required'] = 'Please Select Subject';
        $messages['grade_id.required'] = 'Please select Grade';
        $messages['topic_id.required'] = 'Please select topic';
        $messages['photo_type_id.required'] = 'Please select photo type';
        $messages['photo_url.required'] = 'Please Select Photo';


        return $messages;
    }
}
