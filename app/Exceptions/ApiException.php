<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiException extends HttpResponseException
{
    public function __construct($code, $message, $errors = [])
    {
        // Формируем переменную с ответом при вызове исключений
        $data = [
            'code' => $code,
            'message' => $message
        ];
        // Проверяем, есть ли данные в $errors
        if(count($errors)) {
            $data['errors'] = $errors;
        }
        parent::__construct( response()->json($data)->setStatusCode($code, $message));
    }
}
