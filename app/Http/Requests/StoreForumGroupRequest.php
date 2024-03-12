<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreForumGroupRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255|unique:forum_groups,name',
            'description' => 'bail|required|string|max:255',
            'icon_name' => 'bail|nullable|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.'
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Nhóm forum',
            'description' => 'Mô tả',
            'icon_name' => 'Tên icon'
        ];
    }
}
