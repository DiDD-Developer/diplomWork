<header class="mb-3">
    <nav class="container navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}"><img src="{{ asset('images/logo.png') }}" width="270px" alt="логотип сайта"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('about') }}">О сайте</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('TouristPlace') }}">Туристические места</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('TravelTips') }}">Советы путешественникам</a>
                    </li>
                </ul>

                @auth()
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin)
                        <a href="{{ route('admin') }}" class="btn btn-primary me-4 mb-1 mb-md-0">Панель администратора</a>
                    @endif
                        <div class="d-flex gap-1 mt-3 mt-md-0">
                            <a href="{{ route('PersonalAccount') }}" class="nav-link me-4"><img src="{{ asset('images/icon_auth.png') }}" alt="иконка личного кабинета" data-bs-toggle="tooltip" data-bs-placement="right" title="Перейти в личный кабинет"></a>
                            <a href="{{ route('logout') }}" class="nav-link"><img src="{{ asset('images/icon_logout.png') }}" width="40px" alt="иконка выхода" data-bs-toggle="tooltip" data-bs-placement="right" title="Выйти из аккаунта"></a>
                        </div>
                @endauth

                @guest()
                    <a href="{{ route('auth') }}" class="nav-link"><img src="{{ asset('images/icon_auth.png') }}" alt="иконка авторизации" data-bs-toggle="tooltip" data-bs-placement="right" title="Войти/Зарегистрироваться"></a>
                @endguest
            </div>
        </div>
    </nav>
</header>
