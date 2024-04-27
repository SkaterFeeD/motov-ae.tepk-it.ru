<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreCreateRequest extends ApiRequest
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
            'name' => 'required|string|min:2|max:32'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.max' => 'Поле "Название" должно содержать не более :max символов.',
            'name.min' => 'Поле "Название" должно содержать не менее :min символов.',
        ];
    }
}
