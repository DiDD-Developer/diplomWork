@extends('Admins.admin')
@section('title', 'Категории')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-8 mt-5">
                <h1 class="text-center mb-4">Управление категориями</h1>

                @if(session()->has('categoryName'))
                    <div class="alert alert-primary">
                        Вы успешно создали категорию {{ session()->get('categoryName') }}
                    </div>
                @endif

                @if(session()->has('OldCategoryName'))
                    <div class="alert alert-primary">
                        Вы успешно сменили категорию {{ session()->get('OldCategoryName') }} на {{ session()->get('validatedName') }}
                    </div>
                @endif

                @if(session()->has('DeleteCategoryName'))
                    <div class="alert alert-primary">
                        Вы успешно удалили категорию {{ session()->get('DeleteCategoryName') }}
                    </div>
                @endif

                <!-- Форма добавления категории -->
                <div>
                    <form class="formForAdminForms mt-5 w-75 mx-auto mb-4" method="post" action="{{ route('AddCategoryPost') }}">
                        @csrf
                        <h3 class="text-center mb-4">Добавить категорию</h3>
                        @include('components.form-field', [ 'type' => 'text', 'id' => 'InputNameCategory', 'name' => 'name', 'label' => 'Название категории', 'placeholder' => 'Название категории' ])

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
                <!-- Таблица с категориями -->
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>

                                <!-- Кнопка для изменения названия категории -->
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}">Изменить</a>

                                <!-- Кнопка для удаления категории -->
                                <a type="button" class="btn btn-danger mt-3 mt-md-0" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{$category->id}}">Удалить</a>

                                <!-- Модальное окно для кнопки изменения названия категории -->
                                <div class="modal fade" id="editCategoryModal{{$category->id}}" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editCategoryModalLabel">Изменение категории - {{ $category->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('UpdateCategoryPost', $category) }}" class="w-75 m-auto mb-4">
                                                    @csrf
                                                    @include('components.form-field', [ 'type' => 'text', 'id' => 'InputNameCategory', 'name' => 'name', 'label' => 'Название категории', 'placeholder' => 'Название категории', 'value' => $category->name ])

                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Модальное окно для кнопки удаления категории -->
                                @include('components.delete-modal', [ 'modalId' => "deleteCategoryModal{$category->id}", 'title' => "Удаление категории - {$category->name}", 'message' => "Вы уверены, что хотите удалить категорию {$category->name}?", 'warning' => "Её удаление приведёт к удалению всех связанных с ней тур. мест из каталога!", 'action' => route('DeleteCategoryPost', $category) ])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Категорий пока нет.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
