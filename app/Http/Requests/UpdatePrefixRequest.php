<?php

namespace App\Http\Requests;

use App\Models\Prefix;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrefixRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
                Rule::unique(Prefix::class, 'name')->ignore($this->route('prefix'))
            ],
            'description' => 'bail|required|string|max:255',
            'color' => 'bail|required|string|max:255'
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
            'name' => 'Tên prefix',
            'description' => 'Mô tả',
            'color' => 'Màu sắc'
        ];
    }
}
