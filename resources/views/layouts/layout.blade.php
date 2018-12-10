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
    <style>
        @keyframes open {
            from {height: 0;}
            to {height: 385px}
        }
        @keyframes close {
            from {height: 385px;}
            to {height: 0}
        }
        @media only screen and (max-width: 960px) {
            @keyframes open {
                from {height: 0;}
                to {height: 570px}
            }
            @keyframes close {
                from {height: 570px;}
                to {height: 0}
            }
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/webzey.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="position: fixed; width: 100%; z-index: 100">
        <div style="position: relative; width: 15%">
            <a style="color: #3d4852" href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <script>
                function myFunction() {
                    var x = document.getElementById("myLinks");
                    if (x.style.display === "block") {
                        x.style.animationName = "close";
                        setTimeout(
                            function() {
                                x.style.display = "none";
                            }, 2000);
                    } else {
                        x.style.display = "block";
                        x.style.animationName = "open";
                    }
                }
            </script>
        </div>
        <div style="width: 70%; text-align: center; position: relative; margin-right: 15%">
            <a class="center" href="{{ url('/') }}">
                <img style="width: 100px" src="{{ asset('img/logo.png') }}">
            </a>
        </div>
    </nav>

    <div style="animation-duration: 2s;z-index: 1000; opacity: 0.9;overflow: hidden;margin-top: 45px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: auto; width: 100%; background-color: white; position: fixed; z-index: 10; display: none" id="myLinks">
        <div class="webzey-menu-block">
            <a class="webzey-menu-block-title" href="#webzey-fake-link"><b>CONTACT</b></a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-ticket"></i> Tickets</a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-address-card"></i> Gegevens</a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-check-square-o"></i> Formulier</a><br>
        </div>
        <div class="webzey-menu-block">
            <a class="webzey-menu-block-title" href="#webzey-fake-link"><b>INFORMATIE</b></a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-home"></i> Homepagina</a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-coffee"></i> Over ons</a><br>
            <a class="webzey-menu-block-text" href="#webzey-fake-link"><i class="fa fa-picture-o"></i> Portofolio</a><br>
            <a class="webzey-menu-block-text" href="/"><i class="fa fa-comments"></i> Blog</a><br>
        </div>
        @if(Auth::user())
        <div class="webzey-menu-block">
            <a class="webzey-menu-block-title" href="#webzey-fake-link"><b>BEHEER</b></a><br>
            @guest
            <a><i class="fa fa-exclamation-triangle"></i> Geen toestemming</a>
            @else
            <a class="webzey-menu-block-text" href="/home"><i class="fa fa-user-o"></i> Account</a><br>
            @permission('toegang-administratie')
            <a class="webzey-menu-block-text" href="/user/settings"><i class="fa fa-tachometer"></i> Dashboard</a><br>
            @endpermission
            <a class="webzey-menu-block-text" href="/user/profile/{{ Auth::user()->id  }}/{{ Auth::user()->name }}"><i class="fa fa-sliders"></i> Instellingen</a><br>
            <a class="webzey-menu-block-text" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> {{ __('Uitloggen') }}
            </a>
            @endguest
        </div>
        @endif
        <div style="position: relative; width: 100%; float: left; text-align: center; margin-bottom: 30px;"><hr>
            @guest
                <div style="margin-top: 30px; margin-left: 30%; margin-right: 30%; padding: 10px; background-color: #3d4852; width: 40%; border-radius: 25px; color: white"><a style="color: #ffffff" href="{{ route('home') }}"><b>Inloggen </b><b style="color: #818181">|</b><b> Registeren</b></a></div>
            @else
                <div style="margin-top: 30px; margin-left: 30%; margin-right: 30%; padding: 10px; background-color: #3d4852; width: 40%; border-radius: 25px; color: white"><b> {{ Auth::user()->name }}</b></div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
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
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Paypal</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Ideal</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Credit Card</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">PaySafeCard</a> </p>
            </div><div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-tasks"></i> Producten</b><hr>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Websites</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Systemen</a></p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Templates</a> </p>
                <p style="line-height: 10px;"><a style="color: #636b6f;" href="">Web hosting</a> </p>
            </div><div class="webzey-dashboard-bottum-info-block">
                <b style="font-size: 20px; line-height: 10px;"><i class="fa fa-rss"></i> Ons laatste nieuws</b><hr>
                <p style=""><a style="color: #636b6f;" href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam placerat eros cursus ex ultrices, eget suscipit turpis tempor. Nullam vitae velit egestas nulla porttitor efficitur sed vitae risus. Morbi commodo nisl eu urna aliquam ultricies.</a></p>

            </div>
        </div>
        <div class="webzey-dashboard-bottum-bottum"><h6 style="margin-left: 25px">Webzey - Nederland   <b>|</b>    2016 - {{ date('Y') }}</h6></div>
    </main>
</div>
</body>
</html>
