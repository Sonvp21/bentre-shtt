<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InitiativeEvaluateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'initiative_dossier_id' => 'required|exists:initiative_dossiers,id',
            'name_evaluation' => 'required|string|max:255',
            'name_member' => 'required|string|max:255',
            'score' => 'required|numeric|min:0|max:100',
            'submission_date' => 'required|date',
            'submission_status' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Người dùng không tồn tại.',
            'initiative_dossier_id.exists' => 'Hồ sơ không tồn tại.',
            'initiative_dossier_id.required' => 'Vui lòng chọn hồ sơ.',
            'name_evaluation.required' => 'Tên hội đồng là bắt buộc.',
            'name_member.required' => 'Tên thành viên là bắt buộc.',
            'score.required' => 'Điểm số là bắt buộc.',
            'score.numeric' => 'Điểm số phải là số.',
            'score.min' => 'Điểm số không được nhỏ hơn 0.',
            'score.max' => 'Điểm số không được lớn hơn 100.',
            'submission_date.required' => 'Thời gian chấm là bắt buộc.',
            'submission_date.date' => 'Thời gian chấm phải là ngày hợp lệ.',
            'submission_status.required' => 'Trạng thái là bắt buộc.',
            
        ];
    }
    
}
