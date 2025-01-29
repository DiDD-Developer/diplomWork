@extends('welcome')
@section('title', 'Регистрация')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md">
                <form class="formForRegister" method="post">
                    @csrf
                    <h2 class="text-center mt-3">Регистрация</h2>
                    @include('components.form-field', [ 'id' => 'InputSurname', 'label' => 'Фамилия', 'type' => 'text', 'name' => 'surname', 'placeholder' => 'Пример: Иванов' ])

                    @include('components.form-field', [ 'id' => 'InputName', 'label' => 'Имя', 'type' => 'text', 'name' => 'name', 'placeholder' => 'Пример: Иван' ])

                    @include('components.form-field', [ 'id' => 'InputPatronymic', 'label' => 'Отчество (не обязательно)', 'type' => 'text', 'name' => 'patronymic', 'placeholder' => 'Пример: Иванович' ])

                    @include('components.form-field', [ 'id' => 'InputEmail', 'label' => 'Электронная почта', 'type' => 'email', 'name' => 'email', 'placeholder' => 'Пример: ivan345@gmail.com' ])

                    @include('components.form-field', [ 'id' => 'InputPhone', 'label' => 'Номер телефона',  'type' => 'tel', 'name' => 'phone', 'placeholder' => 'Пример: 88005553535' ])

                    @include('components.form-field', [ 'id' => 'InputLogin', 'label' => 'Логин', 'type' => 'text', 'name' => 'login', 'placeholder' => 'Англ. буквы и цифры только' ])

                    @include('components.form-field', [ 'id' => 'InputPassword', 'label' => 'Пароль', 'type' => 'password', 'name' => 'password' ])

                    @include('components.form-field', ['id' => 'InputSamePassword', 'label' => 'Подтвердите пароль', 'type' => 'password', 'name' => 'password_repeat' ])

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input @error('rules') is-invalid @enderror" id="rules" name="rules">
                        <label class="form-check-label" for="rules">Согласен <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#rulesRegisterModal">с правилами регистрации на сайте.</a></label>

                        <!-- Модальное окно для вывода правил регистрации для будущих пользователей -->
                        <div class="modal fade" id="rulesRegisterModal" tabindex="-1" aria-labelledby="rulesRegisterModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="rulesRegisterModalLabel">Правила регистрации на сайте:</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ol>
                                            <li>Имя, фамилия и отчество (если указано) должны содержать только кириллицу, пробелы и тире.</li>
                                            <li>Электронная почта должна быть указана в корректном формате (например, example@gmail.com) и не должна быть зарегистрирована ранее.</li>
                                            <li>Номер телефона должен состоять из 10-11 цифр, быть уникальным и не зарегистрированным ранее.</li>
                                            <li>Логин может содержать только латинские буквы, цифры и тире, и должен быть уникальным.</li>
                                            <li>Пароль не должен быть пустым и должен быть подтвержден вводом идентичного значения в поле "Подтвердите пароль".</li>
                                            <li>Вы обязаны согласиться с правилами регистрации, установив соответствующий флажок.</li>
                                            <li>Все указанные данные должны быть достоверными. В противном случае, регистрация может быть отклонена или аккаунт удалён.</li>
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('rules')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="d-grid mx-auto btn btn-primary">Зарегистрироваться</button>
                </form>
                <h6 class="text-center mt-3">Есть аккаунт? <a href="{{ route('auth') }}">Войти</a></h6>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
