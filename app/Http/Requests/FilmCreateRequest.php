<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmCreateRequest extends ApiRequest
{

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
            'name' => 'required|string',
            'duration' => 'required|string',
            'description' => 'required|string',
            'year' => 'required|integer',
            'country' => 'required|string',
            'director' => 'required|string',
            'photo' => 'file|mimes:jpg,png',
        ];
    }
}
