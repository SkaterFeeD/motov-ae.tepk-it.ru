<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends ApiRequest
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
            'mass' => 'required|integer',
            'name' => 'required|min:1|max:32',
            'price' => ['required', 'numeric', 'min:0', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'photo' => 'file|mimes:jpg,png,webp,jpeg,svg',
        ];
    }
    public function messages()
    {
        return [
            'mass.required' => 'Поле "mass" не может быть пустым.',
            'mass.integer' => 'Поле "mass" должно быть целым числом.',

            'name.required' => 'Поле "name" не может быть пустым.',
            'name.min' => 'Поле "name" должно содержать как минимум :min символов.',
            'name.max' => 'Поле "name" не может содержать более :max символов.',

            'price.required' => 'Поле "price" не может быть пустым.',
            'price.numeric' => 'Поле "price" должно быть числом.',
            'price.min' => 'Поле "price" должно быть больше или равно :min.',
            'price.regex' => 'Поле "price" должно быть числом с двумя цифрами после точки, если есть.',
        ];
    }
}
