<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="icon" href="https://www.drijfveer.nl/themes/drijfveer2015/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" href="https://www.drijfveer.nl/apple-touch-icon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <header>
            <div class="container">

                <div class="main-menu">
                    <!--            <a href="#" class="main-menu__item">-->
                    <!--                <i class="fas fa-tachometer-alt"></i>-->
                    <!--            </a>-->
                    <a href="{{ route('boten') }}" class="main-menu__item{{ (request()->is('boten') || request()->is('/')) ? ' active' : '' }}"  data-title="Boten">
                        <i class="fas fa-list"></i>
                    </a>
                    <a href="{{ route('jobs') }}" class="main-menu__item{{ (request()->is('jobs')) ? ' active' : '' }}" data-title="Klussen">
                        <i class="fas fa-wrench"></i>
                    </a>
                    <a href="{{ route('periodics') }}" class="main-menu__item{{ (request()->is('periodics')) ? ' active' : '' }}" data-title="Periodieke Taken">
                        <i class="fas fa-clock"></i>
                    </a>
                    <a href="#" class="main-menu__item{{ (request()->is('inventory')) ? ' active' : '' }}"  data-title="Voorraad">
                        <i class="fas fa-dolly-flatbed"></i>
                    </a>
                    <a href="#" class="main-menu__item{{ (request()->is('guides')) ? ' active' : '' }}"  data-title="Handleidingen">
                        <i class="fas fa-book"></i>
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="main-menu__item" data-title="Gebruiker">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="#" id="user" class="main-menu__item" data-title="Gebruiker">
                            <i class="fas fa-user"></i>
                        </a>
                    @endguest

                    <div id="user-menu">
                        <a href="#" id="close-user-menu"><i class="fas fa-times float-right text-orange"></i></a>
                        @guest
                            <a class="button button--large" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Inloggen</a>
                        @else
                            <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                            <a class="button button--large" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Uitloggen
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>


                </div>

            </div>
        </header>

        <div class="spacer">

        </div>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
