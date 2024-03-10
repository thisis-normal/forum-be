<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ForumRequest extends FormRequest
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
            'forum_group_id' => ['required', 'integer','exists:forum_groups,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id']
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được quá :max ký tự.',
            'integer' => ':attribute phải là số nguyên.',
            'exists' => ':attribute không tồn tại.'
        ];
    }
    public function attributes(): array
    {
        return [
            'forum_group_id' => 'Nhóm forum',
            'name' => 'Tên forum',
            'description' => 'Mô tả',
            'slug' => 'Slug',
            'user_id' => 'Người dùng'
        ];
    }
}
