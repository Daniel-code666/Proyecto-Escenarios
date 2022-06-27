@extends('layouts.appMaps')

@section('content')
    @include('layouts.headers.sharedmargin')

    <h2 class="text-center fw-bold mt-2">Ubicación de escenarios</h2>

    <div class="card border-0">
        <div id="map-default" class="map-canvas" style="height: 420px;"></div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLkTMsqM_wWsRik7JueLXvAmcy3WOofCg"
></script>
@endsection

<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>