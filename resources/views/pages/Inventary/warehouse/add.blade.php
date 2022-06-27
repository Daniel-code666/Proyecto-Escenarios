@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

<div class="container">

  <div class="card" style="width: 100%;">
    <div class="card-body">
      <h2 class="card-title">Crear Almacén</h2>
      <hr>

      <form action="{{ url('/almacen') }} " method="post" enctype="multipart/form-data">
        @csrf
        @include('pages.inventary.warehouse.form')

      </form>
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLkTMsqM_wWsRik7JueLXvAmcy3WOofCg"></script>

@endpush