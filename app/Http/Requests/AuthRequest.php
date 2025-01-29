<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Проверка на авторизованность пользователя перед тем как выполнить запрос.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Валидация данных по правилам в возвращаемом массиве.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * Возврат сообщений об ошибках, если они возникают во время валидации данных по правилам в функции rules.
     * @return array|string[]
     */
    public function messages()
    {
        return parent::messages() + [
            'required' => 'Это поле обязательно для заполнения!'
            ];
    }
}
