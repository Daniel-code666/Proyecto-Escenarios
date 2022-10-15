@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">

  <div class="card" style="width: 100%;">
    <div class="card-body">
      <h2 class="card-title">Editar Estado</h2>
      <hr>

      <form action="{{ url('/states/'.$stateescenary->id) }} " method="put" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        @include('pages.misclist.form')

      </form>
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>

@endpush