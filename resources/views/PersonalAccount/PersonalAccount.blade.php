@extends('welcome')
@section('title', 'Личный кабинет')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">

                <h1 class="text-center">Личный кабинет</h1>
                <div class="BorderDataUser mt-3 rounded">
                    <div class="text-center mb-3">
                        <img
                            src="{{ $user->avatar === 'images/default-avatar.png' ? asset($user->avatar) : asset('storage/' . $user->avatar) }}"
                            alt="Аватар пользователя"
                            class="rounded-circle border border-light"
                            style="width: 120px; height: 120px;">
                    </div>
                    <div class="text-center">
                        <h4 class="mb-2">{{ $user->name }} {{ $user->surname }}</h4>
                        <p class="mb-1">Отчество: {{ $user->patronymic ?? 'Не указано' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-1"><strong>Телефон:</strong> {{ $user->phone }}</p>
                        <p class="mb-1"><strong>Логин:</strong> {{ $user->login }}</p>
                    </div>
                </div>


                <div class="d-flex flex-column">
                    <!-- Кнопка для вызова модального окна с формой для смены данных учётной записи -->
                    <a type="button" class="text-center text-decoration-none text-primary mt-3" data-bs-toggle="modal" data-bs-target="#editDataUserModal{{ $user->id }}">Изменить данные учётной записи</a>

                    <!-- Кнопка для вызова модального окна для удаления аккаунта из БД -->
                    <a type="button" class= "text-center text-decoration-none text-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">Удалить учётную запись</a>
                </div>

                <!-- Вывод ошибок во время попытки смены данных аккаунта (если таковые будут) -->
                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            <h5>Вы не можете поменять данные по следующим причинам:</h5>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <h5 class="mt-3">Чтобы стало понятней, нажмите ещё раз на кнопку "Изменить данные учётной записи"</h5>
                        </ul>
                    </div>
                @endif

                <h3 class="mt-5">Избранные места</h3>
                <div class="d-flex flex-wrap justify-content-center gap-lg-4">
                    @forelse($favorites as $favorite)
                        <div class="card mt-3 mt-md-0" style="width: 16rem; position: relative;">
                            <form method="POST" action="{{ route('favorites.remove', $favorite->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-favorite btn-sm bg-white"><i class="fa fa-trash text-danger" style="padding-left: 1px; padding-top: 1px;"></i></button>
                            </form>
                            <img src="{{ asset('storage/'.$favorite->place->image) }}" class="card-img-top" alt="Фото карточки {{ $favorite->place->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $favorite->place->name }}</h5>
                                <p class="card-text">{{ $favorite->place->short_description }}</p>
                                @if(!is_null($favorite->place->average_rating))
                                    <p class="card-text">
                                        <strong>Рейтинг:</strong> ⭐{{ round($favorite->place->average_rating, 1) }}
                                    </p>
                                @else
                                    <p class="card-text"><strong>Рейтинг:</strong> Нет отзывов</p>
                                @endif

                                <p><strong>Адрес:</strong> {{ $favorite->place->address }}</p>
                                <a href="{{ route('catalogPlacesView', $favorite->place) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Посмотреть подробнее о месте">Подробнее</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">У вас пока нет избранных мест. <a href="{{ route('TouristPlace') }}" class="text-decoration-none">Перейти на страницу с тур. местами.</a></p>
                    @endforelse
                </div>

                <!-- Модальное окно с формой для смены данных учётной записи -->
                <div class="modal fade" id="editDataUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editDataUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editDataUserModalLabel">Смена данных учётной записи</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('EditDataAccountPost', $user) }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Фамилия -->
                                    @include('components.form-field', ['label' => 'Фамилия', 'type' => 'text', 'id' => 'InputSurname', 'name' => 'surname', 'value' => $user->surname])

                                    <!-- Имя -->
                                    @include('components.form-field', ['label' => 'Имя', 'type' => 'text', 'id' => 'InputName', 'name' => 'name', 'value' => $user->name])

                                    <!-- Отчество -->
                                    @include('components.form-field', ['label' => 'Отчество (не обязательно)', 'type' => 'text', 'id' => 'InputPatronymic', 'name' => 'patronymic', 'value' => $user->patronymic])

                                    <!-- Аватар -->
                                    <div class="mb-3">
                                        <div>
                                            <h5 class="text-center">Текущий аватар</h5>
                                            <img src="{{ $user->avatar === 'images/default-avatar.png' ? asset($user->avatar) : asset('storage/' . $user->avatar) }}" alt="Аватар пользователя" class="rounded-circle d-grid mx-auto" style="width: 100px; height: 100px;">
                                        </div>
                                        <label for="InputAvatar" class="form-label">Аватар</label>
                                        <input type="file" name="avatar" id="InputAvatar" class="form-control @error('avatar') is-invalid @enderror">
                                        @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Электронная почта -->
                                    @include('components.form-field', ['label' => 'Электронная почта', 'type' => 'email', 'id' => 'InputEmail', 'name' => 'email', 'value' => $user->email])

                                    <!-- Номер телефона -->
                                    @include('components.form-field', ['label' => 'Номер телефона', 'type' => 'tel', 'id' => 'InputPhone', 'name' => 'phone', 'value' => $user->phone])

                                    <!-- Логин -->
                                    @include('components.form-field', ['label' => 'Логин', 'type' => 'text', 'id' => 'InputLogin', 'name' => 'login', 'value' => $user->login])

                                    <!-- Новый пароль -->
                                    @include('components.form-field', ['label' => 'Пароль (укажите новый)', 'type' => 'password', 'id' => 'InputPassword', 'name' => 'password'])

                                    <!-- Подтверждение пароля -->
                                    @include('components.form-field', ['label' => 'Подтверждение пароля', 'type' => 'password', 'id' => 'InputPasswordConfirmation', 'name' => 'password_confirmation'])

                                    <!-- Текущий пароль -->
                                    <div class="formForUpdateDataUser">
                                        <h6 class="text-center">Чтобы изменить свои данные, пожалуйста, введите свой <span class="text-primary">текущий пароль!</span></h6>
                                        @include('components.form-field', ['label' => 'Текущий пароль', 'type' => 'password', 'id' => 'InputCurrentPassword', 'name' => 'current_password'])
                                    </div>

                                    <button type="submit" class="d-grid mx-auto btn btn-primary mt-4">Сохранить</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для удаления аккаунта из БД -->
                @include('components.delete-modal', ['modalId' => 'deleteUserModal' . $user->id, 'title' => 'Удаление аккаунта ' . $user->login, 'message' => 'Вы уверены, что хотите удалить свой аккаунт?', 'warning' => 'После удаления его восстановить не получится!', 'action' => route('DeleteAccountPost', $user)])

            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
