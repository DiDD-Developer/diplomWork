<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPlaceRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'required|file|mimes:png,jpg,jpeg,bmp|max:10240|image',
            'short_description' => 'required',
            'description' => 'required',
            'address' => 'required',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Возврат сообщений об ошибках, если они возникают во время валидации данных по правилам в функции rules.
     * @return array|string[]
     */
    public function messages()
    {
        // Получаем максимальный размер из правил валидации (в килобайтах)
        $maxSizeKb = 10240; // Максимальный размер фото (в KB)
        $maxSizeMb = round($maxSizeKb / 1024, 2); // Перевод в MB и округление

        return parent::messages() + [
                'required' => 'Это поле обязательно для заполнения!',
                'image.file' => 'Необходимо выбрать файл!',
                'image.mimes' => 'Поддерживаемые форматы: png,jpg,jpeg,bmp',
                'image.max' => "Максимальный размер фото: $maxSizeMb MB.",
                'image.image' => 'Файл должен быть изображением!',
            ];
    }
}
