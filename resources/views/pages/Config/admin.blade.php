@extends('layouts.app')

@section('content')
    @include('layouts.headers.sharedmargin')

    <H2 class="text-center fw-bold mt-4" style="font-size: 30px">Configuraciones</H2>
    <br>
    <hr>
    <div class="row m-2">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title text-center" style="font-size: 20px">Parametrizaciones</h5>
                    <hr>
                  <ul>
                      <li><a href="#" class="">Disciplinas</a></li>
                      <li><a href="#" class="">Estado de los escearios</a></li>
                      <li><a href="#" class="">Estado de los inventarios</a></li>
                  </ul> 
                </div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title text-center" style="font-size: 20px">Otros</h5>
                    <hr>
                  <ul>
                      <li><a href="#" class="">Disciplinas</a></li>
                      <li><a href="#" class="">Estado de los escearios</a></li>
                      <li><a href="#" class="">Estado de los inventarios</a></li>
                  </ul> 
                </div>
              </div>
        </div>

    </div>

   
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush