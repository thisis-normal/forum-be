<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'forum_id' => ['required', 'integer', 'exists:forums,id'],
            'prefix_id' => ['nullable', 'integer', 'exists:prefixes,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255'],
            'image.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được quá :max ký tự/byte.',
            'integer' => ':attribute phải là số nguyên.',
            'exists' => ':attribute không tồn tại.',
            'image' => ':attribute phải là ảnh.',
            'mimes' => ':attribute phải có định dạng jpeg, png, jpg, gif, svg.',
        ];
    }
    public function attributes(): array
    {
        return [
            'user_id' => 'Người dùng',
            'forum_id' => 'Forum',
            'prefix_id' => 'Prefix',
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'slug' => 'Slug',
            'image' => 'Ảnh',
        ];
    }
}
