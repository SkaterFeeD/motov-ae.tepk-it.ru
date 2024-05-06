<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends ApiRequest
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
            'seat_number' => 'required|integer',
            'user_id' => 'required|integer',
            'session_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'seat_number.integer' => 'Поле "seat_number" должно быть целым числом.',

            'user_id.required' => 'Поле "user_id" должно быть заполнено.',

            'session_id.required' => 'Поле "session_id" должно быть заполнено.',
        ];
    }
}
