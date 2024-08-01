<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InfringementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'content' => 'required|string',
            'date' => 'required|date',
            'penalty_amount' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên vi phạm là bắt buộc.',
            'content.required' => 'Nội dung là bắt buộc.',
            'date.required' => 'Thời gian là bắt buộc.',
            'date.date' => 'Thời gian phải là định dạng ngày hợp lệ.',
            'penalty_amount.required' => 'Số tiền xử phạt là bắt buộc.',
            'penalty_amount.numeric' => 'Số tiền xử phạt phải là số.',
            'penalty_amount.min' => 'Số tiền xử phạt không được âm.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'document.file' => 'Tài liệu phải là một file.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, doc hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2MB.',
        ];
    }
}
