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
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute field must be a string.',
            'max' => 'The :attribute field must be less than :max characters.',
            'min' => 'The :attribute field must be at least :min characters.',
            'unique' => 'The :attribute field is already exists.',
            'email' => 'The :attribute field must be a valid email address.'
        ];
    }
    //return error for api request
    public function attributes(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }
}
