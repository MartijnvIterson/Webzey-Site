<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Webzey')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="text-align: center; position: fixed; width: 100%; z-index: 100">
        <div class="container">
            <a class="center" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}"; height="50px">
            </a>
            <button class="webzey-login-button" style="background-color: white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>



                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a style="color: #3d4852" class="nav-link" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a style="color: #3d4852" class="nav-link" href="{{ route('register') }}">{{ __('Registreren') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Uitloggen') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Settings</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
        <div style="margin-top: 250px" class="webzey-dashboard-bottum-balk">
            <a class="webzey-dashboard-bottum-balk-block-1">Webzey</a>
            <a href="#" class="fa fa-facebook webzey-dashboard-bar"></a>
            <a href="#" class="fa fa-twitter webzey-dashboard-bar"></a>
            <a href="#" class="fa fa-google webzey-dashboard-bar"></a>
            <a href="#" class="fa fa-instagram webzey-dashboard-bar"></a>
            <a href="#" class="fa fa-snapchat-ghost webzey-dashboard-bar"></a>
            <a href="#" class="fa fa-reddit webzey-dashboard-bar"></a>
        </div>
        <div class="webzey-dashboard-bottum-info">
            <div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-info-circle "></i> Algemeen</b><hr>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Kennisbank</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Contact</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Privacy Policy</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Algemene voorwaarde</a> </p>
            </div><div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-shopping-cart"></i> Betaalmogelijkheden</b><hr>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Kennisbank</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Contact</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Privacy Policy</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Algemene voorwaarde</a> </p>
            </div><div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-tasks"></i> Diensten</b><hr>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Kennisbank</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Contact</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Privacy Policy</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Algemene voorwaarde</a> </p>
            </div><div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-rss"></i> Ons laatste nieuws</b><hr>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Kennisbank</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Contact</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Privacy Policy</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Algemene voorwaarde</a> </p>
            </div>
        </div>
        <div class="webzey-dashboard-bottum-bottum"><h6 style="margin-left: 25px">Webzey - Nederland   <b>|</b>    2016 - {{ date('Y') }}</h6></div>
    </main>
</div>
</body>
</html>
