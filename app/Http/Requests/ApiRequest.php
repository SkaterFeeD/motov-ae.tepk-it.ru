<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    function failedAuthorization()
    {
        throw new ApiException(401,'Доступ закрыт');
    }
    function failedValidation(Validator $validator)
    {
        throw new ApiException(422,'Ошибка валидации', $validator->errors());
    }
}
