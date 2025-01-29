@extends('Admins.admin')
@section('title', 'Работа с пользователями')
@section('content')
    <div class="container">
        <div class="row">
            @if(session()->has('edit_userSurname'))
                <div class="alert alert-primary text-center mt-2">
                   Вы успешно изменили данные пользователя {{ session()->get('edit_userSurname') }} {{ session()->get('edit_userName') }}
                </div>
            @endif
            @if(session()->has('delete_user'))
                <div class="alert alert-primary text-center mt-2">
                   Вы успешно удалили пользователя {{ session()->get('delete_user') }}
                </div>
            @endif

            <div class="col"></div>
            <div class="col-12 col-md-4">
                <form method="get" class="d-flex flex-wrap gap-3 mt-5 mb-3">
                    <input type="text" class="form-control w-75 m-auto w-sm-auto" name="login" placeholder="Логин" value="{{ request('login') }}">
                    <input type="text" class="form-control w-75 m-auto w-sm-auto" name="email" placeholder="Email" value="{{ request('email') }}">
                    <select class="form-select w-75 m-auto w-sm-auto" name="isAdmin">
                        <option value="">Все пользователи</option>
                        <option value="1" {{ request('isAdmin') == '1' ? 'selected' : '' }}>Администраторы</option>
                        <option value="0" {{ request('isAdmin') == '0' ? 'selected' : '' }}>Обычные пользователи</option>
                    </select>
                    <select class="form-select w-75 m-auto w-sm-auto" name="sort_column">
                        <option value="name" {{ request('sort_column') == 'name' ? 'selected' : '' }}>Имя</option>
                        <option value="surname" {{ request('sort_column') == 'surname' ? 'selected' : '' }}>Фамилия</option>
                        <option value="patronymic" {{ request('sort_column') == 'patronymic' ? 'selected' : '' }}>Отчество</option>
                        <option value="login" {{ request('sort_column') == 'login' ? 'selected' : '' }}>Логин</option>
                        <option value="email" {{ request('sort_column') == 'email' ? 'selected' : '' }}>Email</option>
                    </select>
                    <select class="form-select w-75 m-auto w-sm-auto" name="sort_order">
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>По Алфавиту (А-Я)</option>
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>По Алфавиту (Я-А)</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-75 m-auto w-sm-auto">Применить</button>
                    <a href="{{ route('AdminUsersView') }}" class="btn btn-secondary w-75 m-auto w-sm-auto">Сбросить</a>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-4">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Ошибки при обновлении данных пользователя:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Логин</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Админ</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->patronymic }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->isAdmin ? 'Да' : 'Нет' }}</td>
                            <td>
                                <!-- Кнопка для удаления пользователя из БД -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delUserModal{{ $user->id }}">
                                    Удалить
                                </button>

                                <!-- Модальное окно для кнопки удаления пользователя из БД -->
                                @include('components.delete-modal', ['modalId' => "delUserModal{$user->id}", 'title' => "Удаление пользователя {$user->name}", 'message' => "Вы уверены, что хотите удалить пользователя {$user->name}?", 'action' => route('RemoveUser', $user)])


                                <!-- Кнопка для изменения данных пользователя -->
                                <button type="button" class="btn btn-primary mt-1 mt-md-0" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                    Изменить
                                </button>

                                <!-- Модальное окно для кнопки изменения данных пользователя -->
                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editUserModalLabel">Изменение данных пользователя {{$user->name}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('UpdateUsersView', $user) }}">
                                                    @csrf
                                                    <h2 class="text-center mt-3">Изменение данных</h2>

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputSurname', 'label' => 'Фамилия', 'type' => 'text', 'name' => 'surname', 'value' => $user->surname])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputName', 'label' => 'Имя', 'type' => 'text', 'name' => 'name', 'value' => $user->name])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputPatronymic', 'label' => 'Отчество (не обязательно)', 'type' => 'text', 'name' => 'patronymic', 'value' => $user->patronymic])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputEmail', 'label' => 'Электронная почта', 'type' => 'email', 'name' => 'email', 'value' => $user->email])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputPhone', 'label' => 'Номер телефона', 'type' => 'tel', 'name' => 'phone', 'value' => $user->phone])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputLogin', 'label' => 'Логин', 'type' => 'text', 'name' => 'login', 'value' => $user->login])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputPassword', 'label' => 'Пароль', 'type' => 'password', 'name' => 'password', 'value' => ''])

                                                    @include('components.form-fieldAdminUsers', ['id' => 'InputIsAdmin', 'label' => 'Пользователь - админ?', 'type' => 'select', 'name' => 'isAdmin', 'options' => ['0' => 'Нет', '1' => 'Да'], 'valueSelected' => $user->isAdmin])

                                                    <button type="submit" class="d-grid mx-auto btn btn-primary">Сохранить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
