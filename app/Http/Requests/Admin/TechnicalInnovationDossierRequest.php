<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalInnovationDossierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'unit_name' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'submission_status' => 'required|string',
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
            'name.required' => 'Vui lòng nhập tên hồ sơ.',
            'name.max' => 'Tên hồ sơ không được vượt quá 255 ký tự.',
            'unit_name.required' => 'Vui lòng nhập tên đơn vị.',
            'unit_name.max' => 'Tên đơn vị không được vượt quá 255 ký tự.',
            'field.required' => 'Vui lòng nhập lĩnh vực.',
            'field.max' => 'Lĩnh vực không được vượt quá 255 ký tự.',
            'submission_date.required' => 'Vui lòng chọn ngày nộp hồ sơ.',
            'submission_date.date' => 'Ngày nộp hồ sơ phải là định dạng ngày tháng.',
            'submission_status.required' => 'Vui lòng chọn trạng thái hồ sơ.',
            'submission_status.in' => 'Trạng thái hồ sơ không hợp lệ.',
            'document.file' => 'Tài liệu phải là một file.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, doc hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2MB.',
        ];
    }
}
