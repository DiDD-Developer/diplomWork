@extends('welcome')
@section('title', 'О сайте')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-10 col-md-8">
                <h1 class="text-center">О сайте</h1>
                <p class="w-100" style="text-align: justify;">Сайт-гид по туристическим местам Челябинска создан, чтобы объединить информацию о культурных и природных достопримечательностях города в одном месте, облегчая жителям и гостям города поиск интересных локаций и маршрутов.</p>
                <p class="w-100" style="text-align: justify;"><strong>Наша цель</strong> — помочь вам узнать больше о Челябинске, находить новые места для отдыха, культурного досуга и планировать собственные маршруты.</p>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-1">
            <div class="col"></div>
            <div class="col-12 col-md-8">
                <h3 class="text-center">Одни из самых красивых мест в Челябинске</h3>

                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/about/photo1.png') }}" class="d-block w-100" alt="Фото красивого места">
                            <div style="background-color: rgba(0, 0, 0, 0.3); border-radius: 30px;" class="carousel-caption d-none d-md-block">
                                <h5>Фонтан на площади Революции (Кировке)</h5>
                                <p>В ночное время особенно красив</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/about/photo2.png') }}" class="d-block w-100" alt="Фото красивого места">
                            <div style="background-color: rgba(0, 0, 0, 0.3); border-radius: 30px;" class="carousel-caption d-none d-md-block">
                                <h5>Фонтан на реке Миасс</h5>
                                <p>С апреля по октябрь транслируется светомузыкальное шоу с 20:00 до 21:30.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/about/photo3.png') }}" class="d-block w-100" alt="Фото красивого места">
                            <div style="background-color: rgba(0, 0, 0, 0.3); border-radius: 30px;" class="carousel-caption d-none d-md-block">
                                <h5>Торговый центр</h5>
                                <p>Сооружение на набережной реки Миасс. Купол центра является одним из узнаваемых символов города.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-3">
            <div class="col"></div>
            <div class="col-10 col-md-8">
                <h3>Целевая аудитория</h3>
                <p style="text-align: justify;">Сайт ориентирован на всех, кто интересуется культурой и историей Челябинска, будь то туристы, планирующие поездку, или местные жители, ищущие новые места в городе.</p>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mt-3">
            <div class="col"></div>
            <div class="col-10 col-md-8">
                <h3>Основные функции сайта</h3>
                <p style="text-align: justify;">Сайт предоставляет пользователям информацию о популярных и уникальных туристических местах, а также рекомендации по маршрутам для самостоятельных прогулок. Ключевые функции включают:</p>
                <ul>
                    <li><strong>Каталог мест:</strong> раздел с подробными описаниями и фотографиями достопримечательностей, который можно фильтровать по названию и адресу.</li>
                    <li><strong>Избранные места:</strong> зарегистрированные пользователи могут сохранять понравившиеся места для последующего посещения.</li>
                    <li><strong>Советы путешественникам:</strong> страница с общими рекомендациями, чтобы не совершать частых ошибок и узнать, какие места лучше посетить в первую очередь.</li>
                </ul>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mt-3">
            <div class="col"></div>
            <div class="col-10 col-md-8">
                <h3>Рекомендации по использованию сайта</h3>
                <ul>
                    <li><strong>Поиск и просмотр туристических мест:</strong> изучайте <a class="text-decoration-none" href="#">места в Челябинске</a> и добавляйте их в избранное, чтобы не потерять и впоследствии посетить их.</li>
                    <li><strong>Не нашли туристического места на сайте? Расскажите нам:</strong> свяжитесь с нами в одной из соц. сетей через ссылки внизу страницы и предложите добавить новое туристическое место. Укажите его название, одну или больше фотографий и адрес. Если место пройдет нашу проверку, мы добавим его на сайт.</li>
                </ul>
            </div>
            <div class="col"></div>
        </div>

    </div>
@endsection
