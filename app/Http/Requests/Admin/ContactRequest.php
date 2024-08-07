<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'phone' => 'nullable',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'content.required' => trans('admin.field.required.content'),
            'email.required' => trans('admin.field.required.email'),
        ];
    }
}
