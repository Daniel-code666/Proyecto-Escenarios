@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('layouts.headers.sharedmargin')

    <div class="container">

        <div class="card" style="width: 100%;">
            <div class="card-body">
              <h2 class="card-title">Crear estado de un escenario</h2>
              <h3>Parametrice una escala que le permita categorizar sus escenarios acorde a su criterio en una escala.</h3>
              <hr>
             
              <form  action="{{ url('/states') }} "method="post" enctype="multipart/form-data">
                @csrf
                @include('pages.misclist.form')          
               
              </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLkTMsqM_wWsRik7JueLXvAmcy3WOofCg"
></script>

@endpush