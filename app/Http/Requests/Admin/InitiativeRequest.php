<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InitiativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'fields' => 'required|string|max:255',
            'recognition_year' => 'required|integer|digits:4',
            'status' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Người dùng không tồn tại.',
            'name.required' => 'Tên sáng kiến là bắt buộc.',
            'author.required' => 'Tác giả là bắt buộc.',
            'owner.required' => 'Chủ sở hữu là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'fields.required' => 'Lĩnh vực là bắt buộc.',
            'recognition_year.required' => 'Năm công nhận là bắt buộc.',
            'recognition_year.integer' => 'Năm công nhận phải là số nguyên.',
            'recognition_year.digits' => 'Năm công nhận phải gồm 4 chữ số.',
        ];
    }
    
}
