<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateForumGroupRequest extends FormRequest
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
        //get id from url
        $id = intval($this->route('forumGroup'));
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                Rule::unique('forum_groups', 'name')->ignore($id)
            ],
            'description' => 'bail|required|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'exists' => ':attribute không tồn tại.'
        ];
    }
    public function attributes(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Nhóm forum',
            'description' => 'Mô tả'
        ];
    }
}
