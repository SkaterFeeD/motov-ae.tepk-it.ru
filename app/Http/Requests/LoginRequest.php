<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login'   => 'required|string|min:5|max:32',
            'password' => 'required|string|min:8|max:32',
        ];
    }
    public function messages()
    {
        return [
            'login.required' => 'Поле "login" не может быть пустым.',
            'login.max' => 'Поле "login" не может содержать более :max символов.',
            'login.min' => 'Поле "login" должно содержать не менее :min символов.',

            'password.required' => 'Поле "Password" не может быть пустым.',
            'password.max' => 'Поле "Password" не может содержать более :max символов.',
            'password.min' => 'Поле "password" должен содержать не менее :min символов.',
        ];
    }
}
