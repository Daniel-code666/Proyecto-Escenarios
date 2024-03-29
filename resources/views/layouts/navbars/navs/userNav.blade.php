<style>
    .ni {
        display: inline-block;
        font: normal normal normal 14px/1 NucleoIcons;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .ni.circle {
        padding: 0.33333333em;
        vertical-align: -16%;
        background-color: #542c86;
        border-radius: 50%;
    }
</style>

<nav class="navbar navbar-top-white navbar-horizontal navbar-expand-md navbar-dark">
    <div class="container px-4">
        <a class="navbar-brand" href="{{ route('main') }}">
            <img src="{{ asset('argon') }}/img/brand/LOGO-IDRD.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/idrd.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{route('listStages')}}">
                        <i class="ni ni-building circle"></i>
                        <span class="nav-link-inner--text">{{ __('Escenarios') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ url('/mapaescenarios') }}">
                        <i class="ni ni-square-pin circle"></i>
                        <span class="nav-link-inner--text">{{ __('Mapa') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('profile.edit') }}">
                        <i class="ni ni-single-02 circle"></i>
                        <span class="nav-link-inner--text">{{ __('Ver perfil') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('contactenos') }}">
                        <i class="ni ni-send circle"></i>
                        <span class="nav-link-inner--text">{{ __('Contactenos') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-key-25 circle"></i>
                        <span class="nav-link-inner--text">{{ __('Cerrar sesión') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>