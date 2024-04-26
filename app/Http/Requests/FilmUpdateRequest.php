<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmUpdateRequest extends ApiRequest
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
            'name' => 'string',
            'duration' => 'string',
            'description' => 'string',
            'year' => 'integer',
            'country' => 'string',
            'director' => 'string',
            'photo' => 'file|mimes:jpg,png,webp,jpeg,svg',
        ];
    }
}
