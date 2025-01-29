@extends('welcome')
@section('title', 'Наши партнеры')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-8">
                <h1 class="text-center">Наши партнеры</h1>

                <!-- Первая строка партнёров -->
                <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 g-4 mt-5 justify-content-center">
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://31tv.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/31channel.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">31 канал</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://1hleb.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/hlebokombinat.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">Хлебокомбинат</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://www.cmz.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/chmz.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">ЧМЗ</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://1obl.tv/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/otv.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">ОТВ</h4>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Вторая строка партнёров -->
                <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 g-4 mt-5 justify-content-center">
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://kamerata.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/camera_theater.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">Камерный театр</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://www.chelopera.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/opera_theater.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">Оперный театр</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://spp.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/soiuzpisheprom.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">Союзпищепром</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cardPartner">
                            <a href="https://www.chemk.ru/" class="text-decoration-none text-black">
                                <img class="d-grid mx-auto" src="{{ asset('images/OurPartners/chemk.png') }}" width="150px" alt="Изображение лого партнёра">
                                <h4 class="text-center">ЧЭМК</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col"></div>
        </div>
    </div>
@endsection
