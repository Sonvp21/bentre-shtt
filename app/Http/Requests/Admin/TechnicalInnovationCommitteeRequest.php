<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalInnovationCommitteeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'technical_id' => 'nullable|exists:technical_innovation_dossiers,id',
            'name' => 'required|string|max:255',
            'score' => 'required|numeric|min:0|max:100',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
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
            'name.required' => 'Vui lòng nhập tên hội đồng.',
            'name.max' => 'Tên hội đồng không được vượt quá 255 ký tự.',
            'score.required' => 'Vui lòng nhập điểm số.',
            'score.numeric' => 'Điểm số phải là số.',
            'score.min' => 'Điểm số phải lớn hơn hoặc bằng 0.',
            'score.max' => 'Điểm số không được vượt quá 10.',
            'date.required' => 'Vui lòng chọn thời gian chấm điểm.',
            'date.date' => 'Thời gian chấm điểm phải là định dạng ngày tháng.',
            'status.required' => 'Vui lòng nhập trạng thái.',
            'status.max' => 'Trạng thái không được vượt quá 255 ký tự.',
        ];
    }
}
