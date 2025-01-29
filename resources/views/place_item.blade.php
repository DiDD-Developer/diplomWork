@extends('welcome')
@section('title', $placeOne->name)
@section('content')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=923d4771-168e-498b-aaa7-f8397276bed8&lang=ru_RU"></script>
    <div class="container my-5">
        @include('components.place-details', ['place' => $placeOne, 'averageRating' => $averageRating, 'favorites' => $favorites])

        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-12 col-md-6">
                <script defer>
                    ymaps.ready(function () {
                        let myMap = new ymaps.Map("map", {
                            center: [55.76, 37.64], // Координаты по умолчанию
                            zoom: 17
                        });

                        ymaps.geocode('{{ $placeOne->address }}').then(function (res) {
                            let firstGeoObject = res.geoObjects.get(0);
                            let coordinates = firstGeoObject.geometry.getCoordinates();

                            myMap.setCenter(coordinates);
                            myMap.geoObjects.add(new ymaps.Placemark(coordinates, {
                                balloonContent: `
                                    <div style="max-width: 200px;">
                                        <img src="{{ asset('storage/'.$placeOne->image) }}" class="card-img-top" alt="Фото карточки {{ $placeOne->name }}">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $placeOne->name }}</h5>
                                        </div>
                                    </div>
                                    `
                            }));
                        });
                    });
                </script>

                    <h5 class="text-center">Отображение тур. места на карте</h5>
                    <div id="map" class="mb-5" style="width: 100%; height: 400px;"></div>

                <form class="formForTourPlace" method="POST" action="{{ route('CreateReviewPost', $placeOne->id) }}">
                    @csrf
                    <h3 class="text-center mb-3">Вы можете оставить свой отзыв об этом месте!</h3>
                    <div class="mb-3">
                        <label for="review_text" class="form-label">Ваш отзыв</label>
                        <textarea name="text" id="review_text" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Оценка</label>
                        <select name="rating" id="rating" class="form-select">
                            <option value="5" selected>⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                    </div>
                    <button type="submit" class="d-grid mx-auto btn btn-primary">Отправить отзыв</button>
                </form>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mt-5">
            <h3 class="text-center mb-3">Фильтры</h3>
            <form method="get" class="d-flex flex-wrap gap-3 align-items-center mb-4 w-75 mx-auto">
                <!-- Фильтры -->
                <select class="form-select" name="rating_filter">
                    <option value="">Оценка отзывов</option>
                    <option value="positive" {{ request('rating_filter') == 'positive' ? 'selected' : '' }}>Только положительные (оценка >= 4)</option>
                    <option value="negative" {{ request('rating_filter') == 'negative' ? 'selected' : '' }}>Только отрицательные (оценка <= 2)</option>
                </select>

                <select class="form-select" name="sort">
                    <option value="">Сортировать по умолчанию</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Сначала новые</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Сначала старые</option>
                </select>

                @auth()
                <select class="form-select" name="filter_user">
                    <option value="">Все отзывы</option>
                    <option value="1" {{ request('filter_user') == '1' ? 'selected' : '' }}>Только мои отзывы</option>
                </select>
                @endauth

                <button type="submit" class="btn btn-primary">Применить</button>
                <a href="{{ route('catalogPlacesView', $placeOne->id) }}" class="btn btn-secondary">Сбросить</a>
            </form>

            <h3 class="text-center mb-4">
                Отзывы о месте
                @if($reviewsCount > 0)
                    ({{ $reviewsCount }})
                @else
                    (нет отзывов)
                @endif
            </h3>

            @if(session()->has('nameReview'))
                <div class="alert alert-primary text-center">
                    Вы успешно изменили свой отзыв про {{ session()->get('nameReview') }}
                </div>
            @endif

            @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                    @include('components.review', ['review' => $review])
                @endforeach
            @else
                <p class="text-center">Отзывы о данном месте пока отсутствуют или они не найдены по вашим фильтрам.</p>
            @endif
        </div>

    </div>
@endsection
