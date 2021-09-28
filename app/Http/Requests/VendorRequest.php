<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo'=>'required_without:id|mimes:png,jpg,jpeg',
            'name'=>'required|string|max:100',
            'email'=>'email|sometimes|nullable',
            'mobile'=>'required|unique:vendors,mobile,'.$this->id,
            'password'=>'required_without:id',
            'category_id'=>'required|exists:main_categories,id'
        ];
    }

    public function messages()
    {
        return[
            'required'=>'هذا الحقل مطلوب',
            'max'=>'هذا الحقل طويل',
            'numeric'=>'هذا الحقل يقبل ارقام فقط',
            'exists'=>'هذا القسم غير موجود'
        ];
    }
}
