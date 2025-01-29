@extends('welcome')
@section('title', 'Туристические места')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <h1 class="text-center">Туристические места в Челябинске</h1>
                <form method="get" class="d-flex flex-column flex-wrap gap-3 align-items-center mb-4">
                    <!-- Фильтр сортировки -->
                    <div class="w-75 m-auto w-md-auto mt-3">
                        <select class="form-select" name="sort">
                            <option value="">Сортировать по умолчанию</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>По имени (А-Я)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>По имени (Я-А)</option>
                            <option value="address_asc" {{ request('sort') == 'address_asc' ? 'selected' : '' }}>По адресу (А-Я)</option>
                            <option value="address_desc" {{ request('sort') == 'address_desc' ? 'selected' : '' }}>По адресу (Я-А)</option>
                        </select>
                    </div>

                    <!-- Фильтр по названию -->
                    <div class="w-75 m-auto w-md-auto">
                        <input type="text" class="form-control" name="filter_name" placeholder="Фильтр по названию" value="{{ request('filter_name') }}">
                    </div>

                    <!-- Фильтр по адресу -->
                    <div class="w-75 m-auto w-md-auto">
                        <input type="text" class="form-control" name="filter_address" placeholder="Фильтр по адресу" value="{{ request('filter_address') }}">
                    </div>

                    <!-- Фильтр по категории -->
                    <div class="w-75 m-auto w-md-auto">
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
                    <div class="w-75 m-auto w-md-auto">
                        <select class="form-select" name="filter_rating">
                            <option value="">Все рейтинги</option>
                            <option value="positive" {{ request('filter_rating') == 'positive' ? 'selected' : '' }}>Только положительные</option>
                            <option value="negative" {{ request('filter_rating') == 'negative' ? 'selected' : '' }}>Только отрицательные</option>
                            <option value="no_reviews" {{ request('filter_rating') == 'no_reviews' ? 'selected' : '' }}>Без отзывов</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2 m-auto flex-wrap">
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">Применить</button>
                        <a href="{{ route('TouristPlace') }}" class="btn btn-secondary w-100 w-md-auto">Сбросить</a>
                    </div>
                </form>

            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-12">
                <div class="row justify-content-center mt-3">
                    @foreach($places as $place)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card mt-3" style="width: 100%;">
                                <img src="{{ asset('storage/'.$place->image) }}" style="height: 240px; border-radius: 8px;" class="card-img-top" alt="Фото карточки {{ $place->name }}">

                                @auth
                                    @if($favorite = $favorites->firstWhere('place_id', $place->id))
                                        <!-- Если место уже в избранном, показываем кнопку для удаления -->
                                        <form method="POST" action="{{ route('favorites.remove', $favorite->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-favorite bg-white">
                                                <i class="fa fa-trash text-danger" style="padding-left: 1px; padding-top: 1px;"></i>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Если место не в избранном, показываем кнопку для добавления -->
                                        <form method="POST" action="{{ route('favorites.add', $place->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-favorite" style="background-color: rgba(255,255,255,0.3)">
                                                <i id="heart" class="far fa-heart text-danger" style="padding-left: 1px; padding-top: 1px;"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth

                                <div class="card-body">
                                    <h5 class="card-title">{{ $place->name }}</h5>
                                    <p class="card-text">{{ $place->short_description }}</p>
                                    <!-- Вывод среднего рейтинга -->
                                    @if($place->reviews_avg_rating)
                                        <p class="card-text">
                                            <strong>Рейтинг:</strong> ⭐{{ round($place->reviews_avg_rating, 1) }}
                                        </p>
                                    @else
                                        <p class="card-text"><strong>Рейтинг:</strong> Нет отзывов</p>
                                    @endif
                                    <p><strong>Адрес:</strong> {{ $place->address }}</p>
                                    <a href="{{ route('catalogPlacesView', $place) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Посмотреть подробнее о месте">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col"></div>
        </div>
    </div>

@endsection
