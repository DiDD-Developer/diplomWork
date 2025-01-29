@extends('Admins.admin')
@section('title', 'Тур. места')
@section('content')
    <div class="container">
        <div class="row">
            @if(session()->has('add_place'))
                <div class="alert alert-primary text-center mt-2">
                    Вы успешно добавили тур. место - {{ session()->get('add_place') }}
                </div>
            @endif
            @if(session()->has('edit_place'))
                <div class="alert alert-primary text-center mt-2">
                    Вы успешно изменили тур. место {{ session()->get('old_edit_place') }}
                </div>
            @endif
            @if(session()->has('delete_place'))
                <div class="alert alert-primary text-center mt-2">
                    Вы успешно удалили тур. место {{ session()->get('delete_place') }}
                </div>
            @endif
            <div class="col"></div>
            <div class="col-12 col-md-4">
                <form class="formForAdminForms mt-5" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center mt-3">Добавить тур. место</h3>
                    @include('components.form-field', [ 'type' => 'text', 'id' => 'InputNamePlace', 'name' => 'name', 'label' => 'Название' ])

                    @include('components.form-field', [ 'type' => 'file', 'id' => 'InputImagePlace', 'name' => 'image', 'label' => 'Изображение' ])

                    <div class="mb-3">
                        <label for="InputShortDescriptionPlace" class="form-label">Краткое описание для карточки тур. места</label>
                        <textarea
                            class="form-control @error('short_description') is-invalid @enderror"
                            style="resize: vertical;"
                            id="InputShortDescriptionPlace"
                            name="short_description"
                            rows="3"></textarea>
                        @error("short_description")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="InputDescriptionPlace" class="form-label">Описание тур. места</label>
                        <textarea
                            class="form-control @error('description') is-invalid @enderror"
                            style="resize: vertical;"
                            id="InputDescriptionPlace"
                            name="description"
                            rows="3"></textarea>
                        @error("description")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    @include('components.form-field', [ 'type' => 'text', 'id' => 'InputAddressPlace', 'name' => 'address', 'label' => 'Адрес тур. места'])

                    <div class="mb-3">
                        <label for="SelectCategoryPlace" class="form-label">Категория</label>
                        <select
                            class="form-select @error('category_id') is-invalid @enderror"
                            id="SelectCategoryPlace"
                            name="category_id">
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="d-grid mx-auto btn btn-primary">Добавить</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <h3 class="text-center">Тур. места</h3>
            <form method="get" class="row gy-3 align-items-center mb-4">
                <!-- Сортировка -->
                <div class="col-12 col-md-6">
                    <select class="form-select" name="sort">
                        <option value="">Сортировать по умолчанию</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>По имени (А-Я)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>По имени (Я-А)</option>
                        <option value="address_asc" {{ request('sort') == 'address_asc' ? 'selected' : '' }}>По адресу (А-Я)</option>
                        <option value="address_desc" {{ request('sort') == 'address_desc' ? 'selected' : '' }}>По адресу (Я-А)</option>
                        <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Сначала старые</option>
                        <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Сначала новые</option>
                    </select>
                </div>

                <!-- Фильтр по названию -->
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" name="filter_name" placeholder="Фильтр по названию" value="{{ request('filter_name') }}">
                </div>

                <!-- Фильтр по адресу -->
                <div class="col-12 col-md-6">
                    <input type="text" class="form-control" name="filter_address" placeholder="Фильтр по адресу" value="{{ request('filter_address') }}">
                </div>

                <!-- Фильтр по категории -->
                <div class="col-12 col-md-6">
                    <select class="form-select" name="filter_category">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('filter_category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Фильтр по рейтингу -->
                <div class="col-12 col-md-6">
                    <select class="form-select" name="filter_rating">
                        <option value="">Все рейтинги</option>
                        <option value="positive" {{ request('filter_rating') == 'positive' ? 'selected' : '' }}>Только положительные</option>
                        <option value="negative" {{ request('filter_rating') == 'negative' ? 'selected' : '' }}>Только отрицательные</option>
                        <option value="no_reviews" {{ request('filter_rating') == 'no_reviews' ? 'selected' : '' }}>Без отзывов</option>
                    </select>
                </div>

                <!-- Кнопки -->
                <div class="col-12 col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Применить</button>
                    <a href="{{ route('PlaceView') }}" class="btn btn-secondary w-100">Сбросить</a>
                </div>
            </form>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Ошибки при обновлении данных тур. мест:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table">
                <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Название</th>
                    <th class="text-center" scope="col">Изображение</th>
                    <th class="text-center" scope="col">Рейтинг</th>
                    <th class="text-center" scope="col">Краткое описание</th>
                    <th class="text-center" scope="col">Описание</th>
                    <th class="text-center" scope="col">Адрес</th>
                    <th class="text-center" scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @forelse($places as $place)
                       <td>{{ $place->id }}</td>
                       <td>{{ $place->name }}</td>
                       <td><img src="{{ asset('storage/'.$place->image ) }}" style="width: 200px;" alt="фото тур. места"></td>
                       <td>
                           <!-- Вывод среднего рейтинга -->
                           @if($place->reviews_avg_rating)
                               <p class="card-text">
                                   <strong>Рейтинг:</strong> ⭐{{ round($place->reviews_avg_rating, 1) }}
                               </p>
                           @else
                               <p class="card-text"><strong>Рейтинг:</strong> Нет отзывов</p>
                           @endif
                       </td>
                       <td>{{ $place->short_description }}</td>
                       <td style="min-width: 300px;">{{ $place->description }}</td>
                       <td>{{ $place->address }}</td>
                        <td>
                            <!-- Кнопка для удаления тур. места из БД -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delPlaceModal{{ $place->id }}">
                                Удалить
                            </button>

                            <!-- Модальное окно для кнопки удаления тур. места из БД -->
                            @include('components.delete-modal', [ 'modalId' => "delPlaceModal{$place->id}", 'title' => "Удаление тур. места ({$place->name})", 'message' => "Вы уверены, что хотите удалить тур. место {$place->name}? После его удаления оно пропадет у пользователей из личного кабинета, которые добавили его в Избранное.", 'action' => route('RemovePlace', $place) ])

                            <!-- Кнопка для изменения данных тур. места -->
                            <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#editPlaceModal{{ $place->id }}">
                                Изменить
                            </button>

                            <!-- Модальное окно для кнопки изменения данных тур. места -->
                            <div class="modal fade" id="editPlaceModal{{ $place->id }}" tabindex="-1" aria-labelledby="editPlaceModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editPlaceModalLabel">Изменение данных тур. места ({{$place->name}})</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('UpdatePlacePost', $place) }}" enctype="multipart/form-data">
                                                @csrf
                                                <h2 class="text-center mt-3">Изменение данных</h2>
                                                @include('components.form-field', ['id' => 'InputNamePlace', 'label' => 'Название', 'type' => 'text', 'name' => 'name', 'value' => $place->name])
                                                @include('components.form-field', ['id' => 'InputImagePlace', 'label' => 'Текущее изображение', 'type' => 'file', 'name' => 'image', 'value' => '', 'placeholder' => 'Выберите изображение'])
                                                <img src="{{ asset('storage/' . $place->image) }}" style="max-width: 360px; height: 300px;" class="d-grid mx-auto" alt="текущее фото тур. места">
                                                <div class="mb-3">
                                                    <label for="InputShortDescriptionPlace" class="form-label">Краткое описание для карточки тур. места</label>
                                                    <textarea class="form-control @error('short_description') is-invalid @enderror" style="resize: vertical;" id="InputShortDescriptionPlace" name="short_description" rows="3">{{ $place->short_description }}</textarea>
                                                    @error("short_description")
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputDescriptionPlace" class="form-label">Описание тур. места</label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror" style="resize: vertical;" id="InputDescriptionPlace" name="description" rows="3">{{ $place->description }}</textarea>
                                                    @error("description")
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                @include('components.form-field', ['id' => 'InputAddressPlace', 'label' => 'Адрес тур. места', 'type' => 'text', 'name' => 'address', 'value' => $place->address])
                                                <div class="mb-3">
                                                    <label for="SelectCategoryPlace{{ $place->id }}" class="form-label">Категория</label>
                                                    <select class="form-select @error('category_id') is-invalid @enderror" id="SelectCategoryPlace{{ $place->id }}" name="category_id">
                                                        <option value="">Выберите категорию</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $place->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="d-grid mx-auto btn btn-primary">Сохранить</button>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Тур. места не найдены</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
