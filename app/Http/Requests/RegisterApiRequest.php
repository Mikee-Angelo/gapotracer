<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterApiRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => "required|numeric|unique:civilians,phone", 
            'age' => "required|numeric", 
            'gender' => "required|numeric", 
            "address" => "required",
            "password" => "required",
            "token" => "required|string"
        ];
    }
}
