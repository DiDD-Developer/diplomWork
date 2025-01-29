@extends('welcome')
@section('title', 'Часто задаваемые вопросы (FAQ)')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-12 col-md-8">
                <h1 class="text-center">Часто задаваемые вопросы (FAQ)</h1>
                <div style="text-align: justify;" class="accordion mt-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                В чем основная цель сайта-гид по туристическим местам Челябинска?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Наша цель — создать удобную и доступную платформу, которая поможет жителям и гостям города легко находить информацию о популярных и скрытых достопримечательностях Челябинска. Сайт служит информационным гидом по интересным местам и возможностям для отдыха и туризма в городе.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Какие категории туристических мест представлены на сайте?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>На сайте представлены различные категории туристических мест, включая музеи, парки, исторические здания, культурные центры, места для активного отдыха, а также интересные маршруты для самостоятельных прогулок по городу. Ознакомиться со всеми ними вы можете на
                                    <a class="text-decoration-none" href="{{ route('/') }}">главной странице</a> или на отдельных страницах с этими местами.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Какие уникальные особенности есть у данного сайта?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Наш сайт включает подборки лучших мест для туристов, связанные с культурным досугом жителей Челябинска, которые впечатляют как местных жителей, так и искателей приключений, которые могут помочь определиться куда сходить в городе первым делом.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Какие достопримечательности и туристические места можно найти на сайте?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Мы собрали информацию о ключевых достопримечательностях Челябинска, таких как исторические и культурные объекты, природные зоны, современные арт-пространства и тематические парки. Все места снабжены подробными описаниями и фотографиями.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Как часто обновляется информация о местах и событиях?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Мы регулярно обновляем информацию на сайте, добавляя новые события и новости о Челябинске, отбирая полезную информацию для туристов информацию из подлинных источников информации.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Можно ли предложить место для добавления на сайт?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Да, мы будем рады предложениям о новых туристических местах или уникальных локациях Челябинска. Для добавления места отправьте его описание и фотографии в одной из наших снизу соц. сетей и мы рассмотрим ваше предложение.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                Какая информация собирается о пользователях и для чего?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionForQuestion">
                            <div class="accordion-body">
                                <p>Мы собираем минимальный объем данных, необходимый для регистрации и обеспечения работы личного кабинета, сохранения предпочтений и отправки уведомлений. Подробная информация о сборе данных представлена в разделе
                                    <a class="text-decoration-none" href="{{ route('PrivacyPolicy') }}">«Политика конфиденциальности»</a> и <a class="text-decoration-none" href="{{ route('UserAgreement') }}">«Пользовательское соглашение»</a>.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
