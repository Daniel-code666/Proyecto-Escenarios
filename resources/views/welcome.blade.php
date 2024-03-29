@extends('layouts.app', ['class' => 'bg-default', $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="text-center" style="color: #542c86; font-size: 20px">
                @if(session()->has('notification'))
                <div class="notification">
                    {{Session::get('notification')}}
                </div>
                @endif
            </div>

            @if(!session()->has('userEmail'))
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-violet">{{ __('Bienvenido al Sistema de Información de Escenarios del IDRD') }}</h1>
                    </div>
                </div>
            </div>
            @else
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-violet">Bienvenido <u>{{ auth()->user()->name }}</u> al Sistema de Información de Escenarios del IDRD'</h1>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 0 0" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
