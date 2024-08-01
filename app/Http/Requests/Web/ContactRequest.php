<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'content' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('web.contact_validate.name.required'),
            'name.min' => trans('web.contact_validate.name.min'),
            'name.max' => trans('web.contact_validate.name.max'),
            'email.required' => trans('web.contact_validate.email.required'),
            'email.email' => trans('web.contact_validate.email.email'),
            'phone.required' => trans('web.contact_validate.phone.required'),
            'phone.digits' => trans('web.contact_validate.phone.digits'),
            'content.required' => trans('web.contact_validate.content.required'),
            'content.min' => trans('web.contact_validate.content.min'),
        ];
    }
}
