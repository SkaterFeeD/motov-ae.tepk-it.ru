<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionUpdateRequest extends ApiRequest
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
            'time_start' => 'date',
            'time_end' => 'date',
            'session_status_id' => 'integer',
            'film_id' => 'integer',
            'hall_id' => 'integer',
        ];
    }
}
