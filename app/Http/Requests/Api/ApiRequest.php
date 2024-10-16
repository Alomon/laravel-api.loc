<?php

namespace App\Http\Requests\Api;

use App\Exceptions\Api\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    // Вызов исключения при провале валидации данных
    public function failedValidation(Validator $validator)
    {
        throw new ApiException('Ошибка валидации данных',422, $validator->errors());
    }
    // Вызов исключения при провале авторизации пользователя
    public function failedAuthorization()
    {
        throw new ApiException('Ошибка авторизации пользователя',401);
    }
}
