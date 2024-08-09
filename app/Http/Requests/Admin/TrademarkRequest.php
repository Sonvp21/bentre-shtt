<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TrademarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'district_id' => 'nullable|exists:districts,id',
            'commune_id' => 'nullable|exists:communes,id',
            'user_id' => 'nullable|exists:users,id',
            'type_id' => 'nullable|exists:trademark_types,id',
            'geom' => 'nullable',

            'mark' => 'required|string',
            'mark_colors' => 'nullable|string',
            'mark_feature' => 'nullable|string',
            'vienna_classes' => 'nullable|string',
            'owner' => 'required|string',
            'address' => 'nullable|string',
            'other_owner' => 'nullable|string',
            'application_type' => 'nullable|string',
            'filing_number' => 'required|string|max:20',
            'filing_date' => 'nullable|date',
            'publication_number' => 'nullable|string|max:20',
            'publication_date' => 'nullable|date',
            'registration_number' => 'nullable|string|max:20',
            'registration_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'disclaimer' => 'nullable|string',
            'representative_name' => 'nullable|string',
            'representative_address' => 'nullable|string',
            'status' => 'nullable|string',

            'documents.*' => 'file|mimes:pdf,doc,docx|max:10240', // Giới hạn kích thước tệp đính kèm là 10MB
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.exists' => 'Huyện ID không tồn tại.',
            'commune_id.exists' => 'Xã ID không tồn tại.',
            'user_id.exists' => 'Tài khoản ID không tồn tại.',
            'mark.required' => 'Tên nhãn hiệu là bắt buộc.',
            'mark.string' => 'Tên nhãn hiệu phải là một chuỗi.',
            'mark_colors.array' => 'Màu nhãn hiệu phải là một chuỗi.',
            'mark_feature.string' => 'Kiểu nhãn hiệu phải là một chuỗi.',
            'vienna_classes.string' => 'Phân loại hình phải là một chuỗi.',
            'type_id.exists' => 'Type ID không tồn tại.',
            'owner.string' => 'Chủ sở hữu phải là một chuỗi.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'other_owner.string' => 'Tên chủ khác phải là một chuỗi.',
            'application_type.string' => 'Loại đơn phải là một chuỗi.',
            'filing_number.required' => 'Số đơn là bắt buộc.',
            'filing_number.string' => 'Số đơn phải là một chuỗi.',
            'filing_number.max' => 'Số đơn không được vượt quá 20 ký tự.',
            'filing_date.date' => 'Ngày nộp phải là một ngày hợp lệ.',
            'publication_number.string' => 'Số công bố phải là một chuỗi.',
            'publication_number.max' => 'Số công bố không được vượt quá 20 ký tự.',
            'publication_date.date' => 'Ngày công bố phải là một ngày hợp lệ.',
            'registration_number.string' => 'Số bằng phải là một chuỗi.',
            'registration_number.max' => 'Số bằng không được vượt quá 20 ký tự.',
            'registration_date.date' => 'Ngày cấp bằng phải là một ngày hợp lệ.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'disclaimer.string' => 'Yếu tố loại trừ phải là một chuỗi.',
            'representative_name.string' => 'Tên đại diện phải là một chuỗi.',
            'representative_address.string' => 'Địa chỉ đại diện phải là một chuỗi.',
            'status.string' => 'Trạng thái phải là một chuỗi.',

            'documents.*.file' => 'Tài liệu phải là một tệp tin.',
            'documents.*.mimes' => 'Tài liệu phải có định dạng pdf, doc, hoặc docx.',
            'documents.*.max' => 'Tài liệu không được vượt quá 10MB.',
            'images.*.image' => 'Ảnh phải là một hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'images.*.max' => 'Ảnh không được vượt quá 10MB.',
        ];
    }
}
