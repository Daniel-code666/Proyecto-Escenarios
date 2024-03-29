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
                            <img alt="Image placeholder" src="{{ asset('storage').'/'.session()->get('userPhoto') }}">
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

                @if ($menu != null && $submenu !=null)
                    @foreach ($menu as $item)
                        @if ($item->can == 1)
                            <li class="nav-item">
                                <a class="nav-link active" href="#navbar-examples-{{$item->menuid}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples-{{$item->menuid}}">
                                    <i class="{{$item->logo}} text-purple"></i>
                                    <span class="nav-link-text">{{$item->name}}</span>
                                </a>

                                <div class="collapse show" id="navbar-examples-{{$item->menuid}}">
                                    @foreach ($submenu as $item2)
                                        @if ($item2->menuid ==  $item->menuid)
                                            @if ($item2->can == "1")
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url($item2->route) }}">
                                                        <i class="{{$item2->logo}} text-purple"></i>{{$item2->name}}
                                                    </a>
                                                </li>
                                            </ul>
                                            @endif
                                        @endif
                                    @endforeach 
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif

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