<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'district_id' => 'nullable|exists:districts,id',
            'commune_id' => 'nullable|exists:communes,id',
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'representatives' => 'required|string|max:255',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document.*' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'submission_date' => 'nullable|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'district_id.exists' => 'Huyện không hợp lệ.',
            'commune_id.exists' => 'Xã không hợp lệ.',
            'user_id.exists' => 'Người dùng không hợp lệ.',
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'owner.required' => 'Chủ sở hữu là bắt buộc.',
            'owner.max' => 'Chủ sở hữu không được vượt quá 255 ký tự.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'contact.required' => 'Liên hệ là bắt buộc.',
            'contact.max' => 'Liên hệ không được vượt quá 255 ký tự.',
            'representatives.required' => 'Đại diện là bắt buộc.',
            'representatives.max' => 'Đại diện không được vượt quá 255 ký tự.',
            'image.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2048KB.',
            'document.*.mimes' => 'Tài liệu phải có định dạng: pdf, doc, docx.',
            'document.*.max' => 'Tài liệu không được vượt quá 2048KB.',
        ];
    }
}
