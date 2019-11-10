<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:200,200i,300,300i,400,400i,500,500i,600,600i,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700&display=swap&subset=latin-ext,vietnamese" rel="stylesheet">

    <!-- Leaflet Js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
            integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
            crossorigin=""></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/map-setup.js')}}"></script>
    <script src="{{asset('js/L.Icon.Pulse.js')}}"></script>
    {{--<script src="{{asset('js/map-setup.js')}}"></script>--}}

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logos/company-logo') }}" alt="Logo" width="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                {{--@guest--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                    {{--</li>--}}
                    {{--@if (Route::has('register'))--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--@else--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
                           {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                            {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
                            {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                               {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                {{--{{ __('Logout') }}--}}
                            {{--</a>--}}

                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                {{--@csrf--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                {{--@endguest--}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Mergim
                        <img src="" alt="">
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <main id="app">
        @yield('content')
    </main>
</body>
</html>
