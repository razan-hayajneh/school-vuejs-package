<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'student_level' => 'required',
            'email' => 'required|email|max:255|unique:students',


        ];
    }
}
