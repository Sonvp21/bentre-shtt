<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalInnovationResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'technical_id' => 'nullable|exists:technical_innovation_dossiers,id',
            'year' => 'required|integer|min:1900|max:9999',
            'rank' => 'required|string|max:255',
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
            'technical_id.exists' => 'Hồ sơ không tồn tại.',
            'year.required' => 'Vui lòng nhập năm thi.',
            'year.integer' => 'Năm thi phải là số nguyên.',
            'year.min' => 'Năm thi không được nhỏ hơn 1900.',
            'year.max' => 'Năm thi không được lớn hơn 9999.',
            'rank.required' => 'Vui lòng nhập xếp hạng đạt được.',
            'rank.max' => 'Xếp hạng đạt được không được vượt quá 255 ký tự.',
            'status.required' => 'Vui lòng nhập trạng thái.',
            'status.max' => 'Trạng thái không được vượt quá 255 ký tự.',
            'document.file' => 'Tài liệu phải là một file.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, doc hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2MB.',
        ];
    }
}
