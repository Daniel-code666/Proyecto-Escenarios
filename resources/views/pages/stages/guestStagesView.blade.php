@extends('layouts.app', ['class' => 'bg-default', $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')

<div class="header bg-gradient-primary p-8">
    <div class="container">
        <div class="header-body text-center mb--6 mt-1">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-violet">{{ $stage->name}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card bg-secondary shadow">
        <div class="card-body px-lg-3 py-lg-3">
            <div class="row align-items-center">
                <div class="col-6">
                    <p>
                        {{$stage->descripcion}}
                    </p>
                </div>
                <div class="col-6">
                    <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="" width="100%" class="rounded-circle">           
                </div>
            </div>
            <hr>
            <h2>Descripción:</h2>
            <br>
            <div class="row">
                <div class="col-4">
                    <label for=""><strong>Capacidad: </strong>{{$stage->capacity}}</label>
                </div>
                <div class="col-4">
                    <label for=""><strong>Area m<sup>2</sup>: </strong>{{$stage->area}}</label>
                </div>
                <div class="col-4">
                    @foreach ($disciplines as $discipline)
                        @if ($discipline->disciplineId == $stage->discipline)
                          <label for=""><strong>Disciplina: </strong>{{$discipline->discipline_name}}</label>
                        @endif
                    @endforeach       
                </div>
            </div>
            <br>
            <h3>Ubicación:</h3>
            <br>
            <div class="row">
                
                <div class="form-group" hidden>
                    <input class="form-control @error('latitude') is-invalid @enderror" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:old('latitude')}}" id="lat" readonly="true">
                </div>
            
                <div class="form-group" hidden>
                    <input class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:old('longitude')}}" id="lng" readonly="true">
                </div>
                <div class="col-7">
                    <div id="map-default" class="map-canvas"></div>
                </div>
                <div class="col-5">
                    <div>
                        @foreach ($localities as $locality)
                            @if ($locality->id == $stage->localityid)
                              <label for=""><strong>Barrio: </strong>{{$locality->name}}</label>
                            @endif
                        @endforeach  
                        
                    </div>
                    <div>
                        @foreach ($neighbordhoods as $neighbordhood)
                            @if ($neighbordhood->id == $stage->neighborhoodsid)
                             <label for=""><strong>Disciplina: </strong>{{$neighbordhood->name}}</label>
                            @endif
                        @endforeach     
                    </div>
                    <div>
                        <label for=""><strong>Dirección: </strong>{{$stage->address}}</label>
                    </div>
                    @if ($stage->underStagesQty > 0) 
                    <hr style="margin-top: 60%">                     
                        <div class="row justify-content-center ml--5">
                            <div class="col-md-3">
                                <a href="{{route('listUnderSt')}}" type="button" class="btn btn-primary">Sub escenarios</a>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
           
        </div>
    </div> 
</div>

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>

@endpush

@endsection