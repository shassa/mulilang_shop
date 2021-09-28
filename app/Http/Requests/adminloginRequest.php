<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminloginRequest extends FormRequest
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
            'password' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return[
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
        'password.required' => 'كلمة المرور مطلوبة.'
        ];
    }
}
