<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public string $password;
    public string $username;

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
            'username' => 'bail|required|string|max:255|exists:users,username',
            'password' => 'bail|required|string|max:255|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được quá :max ký tự.',
            'min' => ':attribute không được ít hơn :min ký tự.',
            'exists' => ':attribute không tồn tại.'
        ];
    }
    public function attributes(): array
    {
        return [
            'username' => 'Tài khoản',
            'password' => 'Mật khẩu'
        ];
    }
}
