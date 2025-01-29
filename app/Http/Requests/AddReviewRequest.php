<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => 'required',
            'rating' => 'required|min:1|max:5',
        ];
    }

    /**
     * Возврат сообщений об ошибках, если они возникают во время валидации данных по правилам в функции rules.
     * @return array
     */
    public function messages()
    {
        return parent::messages() + [
                'text.required' => 'Это поле обязательно для заполнения!',
                'rating.required' => 'Чтобы оставить отзыв, необходимо выбрать оценку от 1 до 5!',
                'rating.min' => 'Минимальная оценка - :min',
                'rating.max' => 'Максимальная оценка - :max',
            ];
    }
}
