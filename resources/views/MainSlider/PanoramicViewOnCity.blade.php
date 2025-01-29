@extends('welcome')
@section('title', 'Панорамный вид на Челябинск')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-md-10 m-auto">
                <img src="{{ asset('images/MainSlider/photo2.png') }}" class="d-block w-100" style="border-radius: 30px;" alt="Превью статьи">
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-10 col-md-8">
                <h1 class="text-center">Панорамный вид на Челябинск</h1>
                <p class="mt-3" style="text-align: justify;">Думаю, вы уже не раз убеждаетесь, насколько Челябинск сам по себе прекрасен: архитектурные достопримечательности, музеи, театры, озера и все остальное делает его незабываемым как для туристов, так и для жителей других городов и стран.</p>
                <p style="text-align: justify;">В этой статье мы решили показать наиболее красивые места, сделанные беспилотником над городом, уверены, снимки вам понравятся и оставят у вас только положительные впечатления.</p>
                <p style="text-align: justify;"><strong>Внимание:</strong> Акрофобам и тем кто боится высоты не рекомендуется смотреть эту статью! Берегите себя и своих близких!</p>
            </div>
            <div class="col"></div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-10">
               <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                   <img src="{{ asset('images/PanoramicViewOnCity/photo1.png') }}" alt="Челябинский Государственный академический театр оперы и балета имени М. И. Глинки">
                   <p class="text-center">Челябинский Государственный академический театр оперы и балета имени М. И. Глинки</p>
               </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo2.png') }}" alt="Офисный центр «Челябинск-Сити»">
                    <p class="text-center">Офисный центр «Челябинск-Сити». Это самое высокое здание Челябинска. Высота со шпилем составляет 111 метров</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo3.png') }}" alt="«Кировка» - Челябинский Арбат">
                    <p class="text-center">«Кировка» - Челябинский Арбат</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo4.png') }}" alt="Сквер между театральной площадью и площадью Революции">
                    <p class="text-center">Сквер между театральной площадью и площадью Революции</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo5.png') }}" alt="Жилой дом облисполкома">
                    <p class="text-center">«Жилой дом облисполкома» (1938 года постройки). В данный момент на реконструкции.</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo6.png') }}" alt="Алое поле">
                    <p class="text-center">Алое поле</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo7.png') }}" alt="Озеро Тургояк">
                    <p class="text-center">Озеро Тургояк</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo8.png') }}" alt="ЮУрГУ">
                    <p class="text-center">Южно-Уральский государственный университет (ЮУрГУ)</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo9.png') }}" alt="Челябинский железнодорожный вокзал">
                    <p class="text-center">Челябинский железнодорожный вокзал</p>
                </div>

                <div class="d-flex flex-column mt-2" style="max-width: 1200px;">
                    <img src="{{ asset('images/PanoramicViewOnCity/photo10.png') }}" alt="Челябинская телебашня">
                    <p class="text-center">Челябинская телебашня</p>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
