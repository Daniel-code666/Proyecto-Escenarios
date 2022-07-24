@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mt-7 mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-violet">{{ __('Ver escenarios administrador por el IDRD') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card bg-secondary shadow">
        <div class="card-body px-lg-3 py-lg-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="offset-0">
                        <h4>Foto del escenario</h4>
                    </div>

                    <img class="img-center" src="{{isset($stage->photo_understg)?asset('storage').'/'.$stage->photo_understg:''}}" alt="Estadio Nemecio Camacho El Campín" width="550">
                </div>
            </div>

            <div class="row offset-0">
                <h4>Nombre del escenario</h4>
            </div>
            <div class="row offset-1">
                <h2>{{ $stage->name_understg }}</h2>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="offset-0-fixed">
                        <h4>Dirección</h4>
                    </div>

                    <div class="offset-1-fixed">
                        <h3>{{$stage->address_understg}}</h3>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="offset-0-fixed">
                        <h4>Tamaño</h4>
                    </div>
                    <div class="offset-1-fixed">
                        <h3>{{$stage->area_understg}} m<sup>2</sup></h3>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="offset-0-fixed">
                        <h4>Capacidad</h4>
                    </div>
                    <div class="offset-1-fixed">
                        <h3>{{$stage->capacity_understg}} personas</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="offset-0-fixed">
                        <h4>Disciplina</h4>
                    </div>
                    <div class="offset-1-fixed">
                        <h3>{{$stage->discipline_name}}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="offset-0-fixed">
                        <h4>Escenario principal</h4>
                    </div>
                    <div class="offset-1-fixed">
                        <h3>{{$stage->name}}</h3>
                    </div>
                </div>
            </div>

            <div class="row offset-0">
                <h4>Descripción</h4>
            </div>
            <div class="row offset-0-fixed">
                <h3>{{$stage->description_understg}}</h3>
            </div>

            <div class="row offset-0">
                <h4>Ubicación en el mapa</h4>
                <input hidden class="form-control" type="text" name="latitude" value="{{isset($stage->latitude_understg)?$stage->latitude_understg:''}}" id="lat">
                <input hidden class="form-control" type="text" name="longitude" value="{{isset($stage->longitude_understg)?$stage->longitude_understg:''}}" id="lng">
                <div id="map-default" class="map-canvas-2"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>
@endsection