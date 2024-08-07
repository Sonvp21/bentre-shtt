<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GeographicalIndicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules()
    {
        return [
            'district_id' => 'nullable|exists:districts,id',
            'commune_id' => 'nullable|exists:communes,id',
            'name' => 'required|string|max:255',
            'management_unit' => 'required|string|max:255',
            'application_number' => 'required|string|max:255',
            'certificate_number' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'content' => 'required|string',
            'authorized_unit' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document.*' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'district_id.exists' => 'Không tồn tại giá trị này trong danh sách',
            'commune_id.exists' => 'Không tồn tại giá trị này trong danh sách',
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'management_unit.required' => 'Đơn vị quản lý là bắt buộc.',
            'management_unit.string' => 'Đơn vị quản lý phải là chuỗi ký tự.',
            'management_unit.max' => 'Đơn vị quản lý không được vượt quá 255 ký tự.',
            'application_number.required' => 'Số đơn là bắt buộc.',
            'application_number.string' => 'Số đơn phải là chuỗi ký tự.',
            'application_number.max' => 'Số đơn không được vượt quá 255 ký tự.',
            'certificate_number.required' => 'Số văn bằng là bắt buộc.',
            'certificate_number.string' => 'Số văn bằng phải là chuỗi ký tự.',
            'certificate_number.max' => 'Số văn bằng không được vượt quá 255 ký tự.',
            'issue_date.required' => 'Ngày cấp là bắt buộc.',
            'issue_date.date' => 'Ngày cấp phải là một ngày hợp lệ.',
            'content.required' => 'Nội dung là bắt buộc.',
            'content.string' => 'Nội dung phải là chuỗi ký tự.',
            'authorized_unit.required' => 'Đơn vị được quyền sử dụng là bắt buộc.',
            'authorized_unit.string' => 'Đơn vị được quyền sử dụng phải là chuỗi ký tự.',
            'authorized_unit.max' => 'Đơn vị được quyền sử dụng không được vượt quá 255 ký tự.',
            'status.string' => 'Ghi chú phải là chuỗi ký tự.',
            'status.max' => 'Ghi chú không được vượt quá 255 ký tự.',
            'image.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2048 KB.',
            'document.*.mimes' => 'Tài liệu phải có định dạng: pdf, doc, docx.',
            'document.*.max' => 'Tài liệu không được vượt quá 2048 KB.',
        ];
    }
    
}
