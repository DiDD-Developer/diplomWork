@extends('welcome')
@section('title', 'Авторизация')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md">
                <form class="formForAuthorization" method="post">
                    @csrf
                    <h2 class="text-center mt-3">Авторизация</h2>
                    @include('components.form-field', [ 'id' => 'InputLogin', 'label' => 'Логин','type' => 'text', 'name' => 'login'])

                    @include('components.form-field', [ 'id' => 'InputPassword', 'label' => 'Пароль', 'type' => 'password', 'name' => 'password'])
                    <button type="submit" class="d-grid mx-auto btn btn-primary">Авторизоваться</button>
                </form>
                <h6 class="text-center mt-3">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></h6>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
