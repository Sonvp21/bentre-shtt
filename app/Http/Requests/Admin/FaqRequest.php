<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'question' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'email.required' => trans('admin.field.required.email'),
            'phone.required' => trans('admin.field.required.phone'),
            'address.required' => trans('admin.field.required.address'),
            'question.required' => trans('admin.field.required.question'),
        ];
    }
}
