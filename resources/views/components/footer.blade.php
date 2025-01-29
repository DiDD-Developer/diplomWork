<footer class="mt-5">
    <nav class="container navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}"><img src="{{ asset('images/logo.png') }}" width="240px" alt="логотип сайта"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="d-flex flex-column navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('PrivacyPolicy') }}">Политика конфиденциальности</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('UserAgreement') }}">Пользовательское соглашение</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ asset('faq') }}">Часто задаваемые вопросы (FAQ)</a>
                    </li>
                </ul>
                <ul class="d-flex flex-column navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('OurPartners') }}">Партнеры</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Контактная информация:
                        </a>
                        <ul class="dropdown-menu">
                            <div class="d-flex gap-3">
                                <li><a href="#"><img src="{{ asset('images/SocNetwork/Telegram.png') }}" alt="Иконка мессенджера - Telegram"></a></li>
                                <li><a href="#"><img src="{{ asset('images/SocNetwork/vk.png') }}" alt="Иконка соц. сети - VK"></a></li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <p class="text-center mt-3">“Туристические места в Челябинске” 2024-2025, Все права защищены.</p>
</footer>
