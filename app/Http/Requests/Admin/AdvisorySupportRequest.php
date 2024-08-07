<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdvisorySupportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'parent_id' => 'nullable|exists:advisory_supports,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document.*' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Tên thông tin là bắt buộc.',
            'title.string' => 'Tên thông tin phải là chuỗi ký tự.',
            'title.max' => 'Tên thông tin không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'status.string' => 'Ghi chú phải là chuỗi ký tự.',
            'status.max' => 'Ghi chú không được vượt quá 255 ký tự.',
            'published_at.required' => 'Thời gian đăng là bắt buộc.',
            'published_at.date' => 'Thời gian đăng phải là ngày hợp lệ.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'document.mimes' => 'Tài liệu phải có định dạng: pdf, doc, docx.',
            'document.max' => 'Tài liệu không được vượt quá 2MB.',
        ];
    }
}
