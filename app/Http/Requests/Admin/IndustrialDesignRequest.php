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
            'lat' => 'nullable|string',
            'lon' => 'nullable|string',
            'color' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'nullable|file|mimes:pdf,xlsx,docx|max:2048',
            'type_id' => 'required|exists:design_types,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'owner' => 'required|string',
            'address' => 'nullable|string',
            
            'application_number' => 'required|string|max:20',
            'submission_date' => 'nullable|date',
            'submission_status' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'publication_number' => 'nullable|string|max:20',
            'design_date' => 'nullable|date',
            'design_out_of_date' => 'nullable|date',
            'design_status' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.exists' => 'District ID không tồn tại.',
            'commune_id.exists' => 'Commune ID không tồn tại.',
            'user_id.exists' => 'User ID không tồn tại.',
            'lat.string' => 'Latitude phải là một chuỗi.',
            'lon.string' => 'Longitude phải là một chuỗi.',
            'color.string' => 'Color phải là một chuỗi.',
            'type_id.required' => 'Chọn nhóm ngành.',
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.string' => 'Slug phải là một chuỗi.',
            'slug.unique' => 'Slug đã tồn tại.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'owner.required' => 'Chủ sở hữu là bắt buộc.',
            'owner.string' => 'Chủ sở hữu phải là một chuỗi.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'document.file' => 'Tài liệu phải là một tệp tin.',
            'document.mimes' => 'Tài liệu phải có định dạng pdf, xlsx, hoặc docx.',
            'document.max' => 'Tài liệu không được vượt quá 2048 KB.',
            'image.image' => 'Ảnh phải là một hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'image.max' => 'Ảnh không được vượt quá 2048 KB.',
            'application_number.required' => 'Số đơn là bắt buộc.',
            'application_number.string' => 'Số đơn phải là một chuỗi.',
            'application_number.max' => 'Số đơn không được vượt quá 20 ký tự.',
            'submission_date.required' => 'Ngày nộp là bắt buộc.',
            'submission_date.date' => 'Ngày nộp phải là một ngày hợp lệ.',
            'submission_status.required' => 'Trạng thái đơn là bắt buộc.',
            'submission_status.string' => 'Trạng thái đơn phải là một chuỗi.',
            'publication_date.date' => 'Ngày công bố phải là một ngày hợp lệ.',
            'publication_number.string' => 'Số công bố phải là một chuỗi.',
            'publication_number.max' => 'Số công bố không được vượt quá 20 ký tự.',
            'design_date.date' => 'Ngày cấp phải là một ngày hợp lệ.',
            'design_out_of_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'design_status.string' => 'Trạng thái phải là một chuỗi.',
        ];
    }
    
}
