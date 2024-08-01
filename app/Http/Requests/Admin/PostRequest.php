<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'content' => 'required',
            'title_en' => 'nullable',
            'content_en' => 'nullable',
            'published_at' => 'required|date', // Ensure this is a valid date
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => trans('admin.field.required'),
            'category_id.exists' => trans('admin.field.invalid_category'), // Custom message for non-existing category
            'title.unique' => trans('admin.field.unique.title'),
            'title.required' => trans('admin.field.required.title'),
            'content.required' => trans('admin.field.required.content'),
            'published_at.required' => trans('admin.field.required.published_at'),
            'published_at.date' => trans('admin.field.invalid_date'), // Custom message for invalid date
        ];
    }
}
