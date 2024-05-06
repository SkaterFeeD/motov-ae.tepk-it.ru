<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role->code === 'manager';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mass' => 'integer',
            'name' => 'min:1|max:32',
            'price' => ['numeric', 'min:0', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'photo' => 'file|mimes:jpg,png,webp,jpeg,svg',
        ];
    }
    public function messages()
    {
        return [
            'mass.integer' => 'Поле "mass" должно быть целым числом.',

            'name.min' => 'Поле "name" должно содержать как минимум :min символов.',
            'name.max' => 'Поле "name" не может содержать более :max символов.',

            'price.numeric' => 'Поле "price" должно быть числом.',
            'price.min' => 'Поле "price" должно быть больше или равно :min.',
            'price.regex' => 'Поле "price" должно быть числом с двумя цифрами после точки, если есть.',
        ];
    }
}
