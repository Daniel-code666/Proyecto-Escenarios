@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/fonts/Roboto.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
</head>

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-text">{{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif

<h2 class="text-center fw-bold mt-2">Informe de cambios a las tablas</h2>

<div class="warpper">
    <input class="radio" id="one" name="group" type="radio" checked>
    <input class="radio" id="two" name="group" type="radio">
    <input class="radio" id="three" name="group" type="radio">
    <div class="tabs">
        <label class="tab" id="one-tab" for="one">Historico sobre escenarios</label>
        <label class="tab" id="two-tab" for="two">Historico sobre inventarios</label>
        <label class="tab" id="three-tab" for="three">Historico sobre usuarios</label>
    </div>

    <div class="panels">
        <div class="panel" id="one-panel">
            <div class="row">
                <div class="col-8">
                    <p>
                        Desde aquí podrá ver toda la información que haya sido modificada o eliminada de las tablas
                        de escenarios y sub escenarios.
                    </p>
                    <a type="button" class="btn btn-primary" href="">Ver informe</a>
                </div>
                <div class="col-sm-4">
                    <img class="img-center" src="{{ asset('argon') }}/img/brand/add-escenario.png" width="180" alt="...">
                </div>
            </div>
        </div>
        <div class="panel" id="two-panel">
            <div class="row">
                <div class="col-8">
                    <p>
                        Desde aquí podrá ver toda la información que haya sido modificada o eliminada de
                        todas las tablas relacionadas con los inventarios.
                    </p>
                    <a type="button" class="btn btn-primary" href="">Ver informe</a>
                </div>
                <div class="col-sm-4">
                    <img class="img-center" src="{{ asset('argon') }}/img/brand/elements.jpg" width="180" alt="...">
                </div>
            </div>
        </div>
        <div class="panel" id="three-panel">
            <div class="row">
                <div class="col-8">
                    <p>
                        Desde aquí podrá ver toda la información que haya sido modificada o eliminada de todas las
                        tablas relacionadas con los usuarios.
                    </p>
                    <a type="button" class="btn btn-primary" href="">Ver informe</a>
                </div>
                <div class="col-sm-4">
                    <img class="img-center" src="{{ asset('argon') }}/img/brand/user.png" width="180" alt="...">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush