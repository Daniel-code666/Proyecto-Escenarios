@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('layouts.headers.sharedmargin')

    <div class="container">

        <div class="card" style="width: 100%;">
            <div class="card-body">
              <h2 class="card-title">Editar disciplina</h2>
              <hr>
              <form  action="{{ url('/discipline/'.$discipline->disciplineId) }} "method="post">
                @csrf
                {{method_field('PUT')}}
                @include('pages.disciplines.disciplineForm')
              </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush