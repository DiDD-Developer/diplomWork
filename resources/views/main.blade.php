@extends('welcome')
@section('title', 'Тур. места в Челябинске')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-10">
                <div id="carouselPagesAboutCity" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselPagesAboutCityIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselPagesAboutCityIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselPagesAboutCityIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="{{ route('DifferentSeasons') }}"><img src="{{ asset('images/MainSlider/photo1.png') }}" class="d-block w-100" style="border-radius: 30px;" alt="фото слайдера"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{ route('PanoramicViewOnCity') }}"><img src="{{ asset('images/MainSlider/photo2.png') }}" class="d-block w-100" style="border-radius: 30px;" alt="фото слайдера"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="{{ route('CultureOfTheCity') }}"><img src="{{ asset('images/MainSlider/photo3.png') }}" class="d-block w-100" style="border-radius: 30px;" alt="фото слайдера"></a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPagesAboutCity" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselPagesAboutCity" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Популярные места в Челябинске</h1>
                <a href="{{ route('TouristPlace') }}" class="text-decoration-none text-black">Страница с местами</a>
            </div>


            <div class="TouristPlaceCards d-flex flex-wrap justify-content-center mt-3" style="gap: 50px;">
                @foreach($topRatedPlaces as $place)
                    <div class="card" style="width: 18rem; position: relative;">
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
                @endforeach
            </div>
    </div>

@endsection
