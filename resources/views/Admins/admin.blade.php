<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/HeaderFooter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Other.css') }}">
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
    <title>@yield('title', 'Панель администратора')</title>
</head>
<body>
@include('components.header')

@if(session('success'))
    <div class="alert alert-primary text-center">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-center">Панель администратора</h1>

<div class="container">
    <div class="row mt-lg-4">
        <div class="col text-center">
            <a href="{{ route('AdminUsersView') }}" class="btn btn-primary">Пользователи</a>
            <a href="{{ route('CategoryView') }}" class="btn btn-primary">Категории</a>
            <a href="{{ route('PlaceView') }}" class="btn btn-primary mt-2 mt-md-0">Тур. места</a>
        </div>
    </div>
</div>
@yield('content')

@include('components.footer')
</body>
</html>
