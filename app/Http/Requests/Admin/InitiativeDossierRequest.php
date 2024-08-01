<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InitiativeDossierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'initiative_id' => 'required|exists:initiatives,id',
            'name' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'submission_status' => 'required|string|max:255',

            'document' => 'nullable|file|mimes:pdf,xlsx,docx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Người dùng không tồn tại.',
            'initiative_id.exists' => 'Sáng kiến không tồn tại.',
            'initiative_id.required' => 'Vui lòng chọn sáng kiến.',
            'name.required' => 'Tên hồ sơ là bắt buộc.',
            'submission_date.required' => 'Thời gian nộp là bắt buộc.',
            'submission_date.date' => 'Thời gian nộp phải là ngày hợp lệ.',
            'submission_status.required' => 'Trạng thái hồ sơ là bắt buộc.',

            'document.file' => 'Tài liệu phải là một tệp tin.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, xlsx, hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2048 KB.',
        ];
    }
    
}
