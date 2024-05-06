<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionCreateRequest extends ApiRequest
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
            'time_start' => 'required|date',
            'time_end' => 'required|date',
            'session_status_id' => 'required|integer',
            'film_id' => 'required|integer',
            'hall_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'time_start.required' => 'Поле "Время начала" обязательно для заполнения.',
            'time_end.required' => 'Поле "Время окончания" обязательно для заполнения.',
            'session_status_id.required' => 'Поле "Статус сеанса" обязательно для заполнения.',
            'film_id.required' => 'Поле "Фильм" обязательно для заполнения.',
            'hall_id.required' => 'Поле "Зал" обязательно для заполнения.',
        ];
    }
}
