<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/logo.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link href="/assets-old/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/1d6cbfb61c.js" crossorigin="anonymous"></script>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            @if(auth()->user()->role_idrole == 3)
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @elseif(auth()->user()->role_idrole == 1 || auth()->user()->role_idrole == 2)
                @auth()
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @include('layouts.navbars.sidebar')
                @endauth
            @endif
        @endauth

        {{-- @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth --}}
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>
        

        @guest()
            @include('layouts.footers.guest')
        @endguest

        @auth()
            @if(auth()->user()->role_idrole == 3)
                @include('layouts.footers.guest')
            @endif
        @endauth


        
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js"></script>
        <script src="{{ asset('argon') }}/js/map.js"></script>

        
        
    </body>
</html>