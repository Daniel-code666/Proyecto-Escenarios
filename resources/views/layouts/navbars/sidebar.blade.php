<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/LOGO-IDRD.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenido') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mi Perfil') }}</span>
                    </a>
                    {{-- <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a> --}}
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/idrd.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                <i class="ni ni-tv-2 text-primary"></i> {{ __('Home') }}
                </a>
                </li> --}}

                @auth()
                @if(auth()->user()->role_idrole == 1)
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-settings text-purple"></i>
                        <span class="nav-link-text">{{ __('Administrador') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    <i class="ni ni-badge text-purple"></i>{{ __('Administrar usuarios') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-2" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples-2">
                        <i class="ni ni-building text-purple"></i> {{ __('Escenarios') }}
                    </a>
                    <div class="collapse show" id="navbar-examples-2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/escenario') }}">
                                    <i class="ni ni-building text-purple"></i> {{ __('Principales') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/understage') }}">
                                    <i class="ni ni-building text-purple"></i>{{ __('Sub escenarios') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!--Inventarios -->

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples-3">
                        <i class="ni ni-app text-purple"></i> {{ __('Inventarios') }}
                    </a>
                    <div class="collapse show" id="navbar-examples-3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/item') }}">
                                    <i class="ni ni-archive-2 text-purple"></i> {{ __('Items') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/almacen') }}">
                                    <i class="ni ni-shop text-purple"></i>{{ __('Almacenes') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!--Reportes -->

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-4" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples-4">
                        <i class="ni ni-chart-bar-32 text-purple"></i> {{ __('Reportes') }}
                    </a>
                    <div class="collapse show" id="navbar-examples-4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/item') }}">
                                    <i class="ni ni-building text-purple"></i> {{ __('Escenarios') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/almacen') }}">
                                    <i class="ni ni-app text-purple"></i>{{ __('Inventarios') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/almacen') }}">
                                    <i class="ni ni-single-copy-04 text-purple"></i>{{ __('Otros') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/discipline') }}">
                <i class="ni ni-user-run text-purple"></i> {{ __('Disciplinas') }}
                </a>
                </li> --}}

                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="ni ni-map-big text-purple"></i> {{ __('Mapa de escenarios') }}
                    </a>
                </li>


                <!--Configuraciones -->

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples-5" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples-5">
                        <i class="ni ni-settings-gear-65 text-purple"></i> {{ __('Configuraciones') }}
                    </a>
                    <div class="collapse show" id="navbar-examples-5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/discipline') }}">
                                    <i class="ni ni-user-run text-purple"></i> {{ __('Disciplinas') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/states') }}">
                                    <i class="ni ni-bullet-list-67 text-purple"></i>{{ __('Estado Escenarios') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/inventarystates') }}">
                                    <i class="ni ni-bullet-list-67 text-purple"></i>{{ __('Estado Inventarios') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('table') }}">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Tables</span>
                </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                </a>
                </li> --}}
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Soporte</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Manual del sitio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Documentación
                    </a>
                </li> --}}
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('map') }}">
                        <i class="ni ni-support-16 text-purple"></i> {{ __('Soporte') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>