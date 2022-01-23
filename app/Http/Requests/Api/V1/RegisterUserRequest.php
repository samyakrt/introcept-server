<?php

namespace App\Http\Requests\Api\V1;

use App\Rules\ValidPhoneNumber;
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
            'name' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required',new ValidPhoneNumber],
            'address' => ['required','min:10'],
            'nationality' => ['required'],
            'education_background' => ['required','min:10'],
            'gender' => ['required'],
            'mode_of_contact' => ['required']
        ];
    }
}
