<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDataAccountRequest extends FormRequest
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
            'name' => 'required|regex:/^[А-Яа-яЁё\s-]+$/u',
            'surname' => 'required|regex:/^[А-Яа-яЁё\s-]+$/u',
            'patronymic' => 'nullable|regex:/^[А-Яа-яЁё\s-]+$/u',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg|max:10240',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,11',
            'login' => 'required|regex:/^[A-Za-z0-9-]+$/u',
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    /**
     * Возврат сообщений об ошибках, если они возникают во время валидации данных по правилам в функции rules.
     * @return array|string[]
     */
    public function messages()
    {
        return parent::messages() + [
                'required' => 'Это поле обязательно для заполнения!',
                'rules.required' => 'Нажмите на флажок, чтобы зарегистрироваться!',
                'name.regex' => 'В поле для имени можно указать только следующие символы: кириллицу, пробел и тире!',
                'surname.regex' => 'В поле для фамилии можно указать только следующие символы: кириллицу, пробел и тире!',
                'patronymic.regex' => 'В поле для отчества можно указать только следующие символы: кириллицу, пробел и тире!',
                'avatar.mimes' => 'Поддерживаемые форматы: png, jpg, jpeg, bmp, gif, svg',
                'avatar.size' => 'Максимальный размер аватара: 10MB',
                'email.email' => 'Введите эл. почту в формате example@gmail.com!',
                'phone.digits_between' => 'Номер телефона должен содержать от 10 до 11 цифр и не включать буквы или специальные символы.',
                'login.regex' => 'В поле для логина можно указать только следующие символы: латиницу, цифры и тире!',
                'current_password.required' => 'Вы должны указать текущий пароль.',
                'password.min' => 'Минимальное количество символов в новом пароле: 8.',
                'password.confirmed' => 'Новый пароль и подтверждение не совпадают.',
            ];
    }
}
