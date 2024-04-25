<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'photo' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'mass'
        ];
    }
}
