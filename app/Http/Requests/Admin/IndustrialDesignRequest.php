<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IndustrialDesignRequest extends FormRequest
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
            'geom' => 'nullable',
            'type_id' => 'nullable|exists:industrial_design_types,id', // Sửa tên bảng từ design_types thành industrial_design_types
            'name' => 'required|string',
            'description' => 'nullable|string',
            'owner' => 'nullable|string',
            'address' => 'nullable|string',

            'filing_number' => 'required|string|max:20',
            'filing_date' => 'nullable|date',
            'publication_number' => 'nullable|string|max:20',
            'publication_date' => 'nullable|date',
            'registration_number' => 'nullable|string|max:20',
            'registration_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',

            'designer' => 'nullable|string',
            'designer_address' => 'nullable|string',
            'locarno_classes' => 'nullable|string',
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
            'district_id.exists' => 'ID của quận không tồn tại.',
            'commune_id.exists' => 'ID của xã không tồn tại.',
            'user_id.exists' => 'ID của người dùng không tồn tại.',
            'type_id.required' => 'Nhóm ngành là bắt buộc.',
            'type_id.exists' => 'Nhóm ngành không tồn tại.',
            'name.required' => 'Tên kiểu dáng là bắt buộc.',
            'name.string' => 'Tên kiểu dáng phải là một chuỗi.',
            'owner.required' => 'Chủ sở hữu là bắt buộc.',
            'owner.string' => 'Chủ sở hữu phải là một chuỗi.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'filing_number.required' => 'Số đơn gốc là bắt buộc.',
            'filing_number.string' => 'Số đơn gốc phải là một chuỗi.',
            'filing_number.max' => 'Số đơn gốc không được vượt quá 20 ký tự.',
            'filing_date.date' => 'Ngày nộp đơn phải là một ngày hợp lệ.',
            'publication_number.string' => 'Số công bố phải là một chuỗi.',
            'publication_number.max' => 'Số công bố không được vượt quá 20 ký tự.',
            'publication_date.date' => 'Ngày công bố phải là một ngày hợp lệ.',
            'registration_number.string' => 'Số bằng phải là một chuỗi.',
            'registration_number.max' => 'Số bằng không được vượt quá 20 ký tự.',
            'registration_date.date' => 'Ngày cấp bằng phải là một ngày hợp lệ.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'designer.string' => 'Tên người thiết kế phải là một chuỗi.',
            'designer_address.string' => 'Địa chỉ người thiết kế phải là một chuỗi.',
            'locarno_classes.string' => 'Phân loại locarno phải là một chuỗi.',
            'representative_name.string' => 'Tên đại diện pháp luật phải là một chuỗi.',
            'representative_address.string' => 'Địa chỉ đại diện pháp luật phải là một chuỗi.',
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
