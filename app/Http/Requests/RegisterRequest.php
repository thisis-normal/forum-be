<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public string $username;
    public string $email;
    public string $password;

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
            'username' => 'bail|required|string|max:255|unique:users,username',
            'email' => 'bail|required|email|unique:users,email',
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
            'unique' => ':attribute đã tồn tại.',
            'email' => ':attribute không đúng định dạng.'
        ];
    }
    //return error for api request
    public function attributes(): array
    {
        return [
            'username' => 'Tài khoản',
            'email' => 'Email',
            'password' => 'Mật khẩu'
        ];
    }
}
