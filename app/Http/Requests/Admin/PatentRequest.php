<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PatentRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'type_id' => 'nullable|exists:patent_types,id',

            'title' => 'required|string|max:255',
            'ipc_classes' => 'nullable|string',
            'applicant' => 'required|string',
            'applicant_address' => 'nullable|string',
            'inventor' => 'nullable|string',
            'inventor_address' => 'nullable|string',
            'other_inventor' => 'nullable|string',
            'abstract' => 'nullable|string',

            'application_type' => 'nullable|string|max:255',
            'filing_number' => 'required|string|max:255',
            'filing_date' => 'nullable|date',
            'publication_number' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'registration_number' => 'nullable|string|max:255',
            'registration_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'representative_name' => 'nullable|string',
            'representative_address' => 'nullable|string',
            'status' => 'nullable|string|max:255',

            'documents.*' => 'file|mimes:pdf,doc,docx|max:10240', // Giới hạn kích thước tệp đính kèm là 10MB
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.exists' => 'Huyện không tồn tại trong cơ sở dữ liệu.',
            'commune_id.exists' => 'Xã không tồn tại trong cơ sở dữ liệu.',
            'user_id.exists' => 'Người dùng không tồn tại trong cơ sở dữ liệu.',
            'type_id.exists' => 'Loại sáng chế không tồn tại trong cơ sở dữ liệu.',
            'title.required' => 'Tên sáng chế là bắt buộc.',
            'title.max' => 'Tên sáng chế không được vượt quá 255 ký tự.',
            'applicant.required' => 'Chủ đơn là bắt buộc.',
            'filing_number.required' => 'Số đơn là bắt buộc.',
            'filing_number.max' => 'Số đơn không được vượt quá 255 ký tự.',
            'filing_date.date' => 'Ngày nộp đơn phải là một ngày hợp lệ.',
            'publication_date.date' => 'Ngày công bố phải là một ngày hợp lệ.',
            'registration_date.date' => 'Ngày cấp bằng phải là một ngày hợp lệ.',
            'expiration_date.date' => 'Ngày hết hạn phải là một ngày hợp lệ.',
            'status.max' => 'Trạng thái không được vượt quá 255 ký tự.',

            'documents.*.file' => 'Tài liệu phải là một tệp tin.',
            'documents.*.mimes' => 'Tài liệu phải có định dạng pdf, doc, hoặc docx.',
            'documents.*.max' => 'Tài liệu không được vượt quá 10MB.',
            'images.*.image' => 'Ảnh phải là một hình ảnh.',
            'images.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'images.*.max' => 'Ảnh không được vượt quá 10MB.',
        ];
    }
}
