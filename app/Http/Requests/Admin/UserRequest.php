<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        $userId = $this->user ? $this->user->id : null;
    
        $rules = [
            'category_id' => 'nullable|exists:user_categories,id',
            'district_id' => 'nullable|exists:districts,id',
            'commune_id' => 'nullable|exists:communes,id',
            'name' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'email_verified_at' => 'nullable|date',
            'birthday' => 'nullable|date',
            'description' => 'nullable|string',
            'ip' => 'nullable|string',
            'status' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ];
    
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8';
        } elseif ($this->isMethod('patch')) {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
            $rules['current_password'] = ['required_with:password', 'string'];
        }
    
        return $rules;
    }
    
    public function messages()
    {
        return [
            'category_id.exists' => 'Danh mục người dùng không hợp lệ.',
            'district_id.exists' => 'Huyện không hợp lệ.',
            'commune_id.exists' => 'Xã không hợp lệ.',
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.string' => 'Tên người dùng phải là một chuỗi ký tự.',
            'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
            'full_name.string' => 'Tên đầy đủ phải là một chuỗi ký tự.',
            'full_name.max' => 'Tên đầy đủ không được vượt quá 50 ký tự.',
            'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là một chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'email_verified_at.date' => 'Ngày xác minh email không hợp lệ.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',
            'ip.string' => 'IP phải là một chuỗi ký tự.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.integer' => 'Trạng thái phải là một số nguyên.',
            'images.image' => 'Tệp tải lên phải là hình ảnh.',
            'images.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'images.max' => 'Hình ảnh không được vượt quá 3MB.',
            'current_password.required_with' => 'Mật khẩu cũ là bắt buộc khi thay đổi mật khẩu.',
        ];
    }
    
}
