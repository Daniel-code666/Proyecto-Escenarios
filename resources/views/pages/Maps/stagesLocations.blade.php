@extends('layouts.appMaps',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<h2 class="text-center fw-bold mt-2">Ubicación de escenarios</h2>

<div style="padding: 0px 5px">
    <div class="card border-1 " style="padding: 10px">
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1xaqToYQBZnTfIQtKMkbK9II7UMobi9E&ehbc=2E312F" width="100%" height="420px"></iframe>
    </div>
</div>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLkTMsqM_wWsRik7JueLXvAmcy3WOofCg"></script>
@endsection

<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>