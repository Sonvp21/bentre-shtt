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
            'geom' => 'nullable',
            'lat' => 'nullable|string',
            'lon' => 'nullable|string',
            'color' => 'nullable|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'type_id' => 'required|exists:trademark_types,id',
            'owner' => 'required|string',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
            'application_number' => 'required|string|max:20',
            'submission_date' => 'required|date',
            'submission_status' => 'required|string',
            'publication_number' => 'nullable|string|max:20',
            'publication_date' => 'nullable|date',
            'out_of_date' => 'nullable|date',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'nullable|file|mimes:pdf,xlsx,docx|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.exists' => 'Huyện ID không tồn tại.',
            'commune_id.exists' => 'Xã ID không tồn tại.',
            'user_id.exists' => 'Tài khoản ID không tồn tại.',
            'lat.string' => 'Latitude phải là một chuỗi.',
            'lon.string' => 'Longitude phải là một chuỗi.',
            'color.string' => 'Color phải là một chuỗi.',
            'code.required' => 'Mã là bắt buộc.',
            'code.string' => 'Mã phải là một chuỗi.',
            'code.max' => 'Mã không được vượt quá 20 ký tự.',
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'type_id.exists' => 'Type ID không tồn tại.',
            'type_id.required' => 'Chọn nhóm ngành.',
            'owner.required' => 'Chủ sở hữu là bắt buộc.',
            'owner.string' => 'Chủ sở hữu phải là một chuỗi.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'contact.string' => 'Liên hệ phải là một chuỗi.',
            'document.file' => 'Tài liệu phải là một tệp tin.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, xlsx, hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2048 KB.',
            'application_number.required' => 'Số đơn là bắt buộc.',
            'application_number.string' => 'Số đơn phải là một chuỗi.',
            'application_number.max' => 'Số đơn không được vượt quá 20 ký tự.',
            'submission_date.required' => 'Ngày nộp là bắt buộc.',
            'submission_date.date' => 'Ngày nộp phải là một ngày hợp lệ.',
            'submission_status.required' => 'Trạng thái đơn là bắt buộc.',
            'submission_status.string' => 'Trạng thái đơn phải là một chuỗi.',
            'publication_number.string' => 'Số công bố phải là một chuỗi.',
            'publication_number.max' => 'Số công bố không được vượt quá 20 ký tự.',
            'publication_date.date' => 'Ngày công bố phải là một ngày hợp lệ.',
            'out_of_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'image.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2048 KB.',
        ];
    }
    
}
