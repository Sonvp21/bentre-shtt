<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PatentRequest extends FormRequest
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
            'code' => 'required|string|max:20',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'legal_representative' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document' => 'nullable|file|mimes:pdf,xlsx,docx|max:2048',
            'application_number' => 'required|string|max:20',
            'submission_date' => 'nullable|date',
            'submission_status' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'number_patent' => 'nullable|string|max:20',
            'patent_date' => 'nullable|date',
            'patent_out_of_date' => 'nullable|date',
            'patent_status' => 'nullable|string',
            
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.exists' => 'Không tồn tại giá trị này trong danh sách',
            'commune_id.exists' => 'Không tồn tại giá trị này trong danh sách',
            'user_id.exists' => 'Không tồn tại giá trị này trong danh sách',
            'code.required' => 'Trường Mã số không được bỏ trống',
            'code.max' => 'Trường Mã số không được vượt quá :max ký tự',
            'name.required' => 'Trường Tên không được bỏ trống',
            'slug.required' => 'Trường Slug không được bỏ trống',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác',
            'description.required' => 'Trường Tóm tắt nội dung không được bỏ trống',
            'legal_representative.required' => 'Trường Đại diện pháp luật không được bỏ trống',
            'application_number.required' => 'Trường Số đơn không được bỏ trống',
            'application_number.max' => 'Trường Số đơn không được vượt quá :max ký tự',
            'submission_date.date' => 'Trường Ngày nộp không hợp lệ',
            'publication_date.date' => 'Trường Ngày công bố không hợp lệ',
            'number_patent.max' => 'Trường Số bằng không được vượt quá :max ký tự',
            'patent_date.date' => 'Trường Ngày cấp không hợp lệ',
            'patent_out_of_date.date' => 'Trường Ngày hết hạn không hợp lệ',
            'image.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2048 KB.',
        ];
    }
    
}
