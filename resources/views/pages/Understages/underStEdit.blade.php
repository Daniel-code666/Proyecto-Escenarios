@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<div class="container">

  <div class="card" style="width: 100%;">
    <div class="card-body">
      <h2 class="card-title">Editar sub escenario</h2>
      <hr>

      <form action="{{ url('/understage/'.$underStage->idUnderstage) }} 
                " method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        @include('pages.Understages.underStagesForm')

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