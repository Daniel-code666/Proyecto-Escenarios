@extends('layouts.app')

@section('content')
    @include('layouts.headers.sharedmargin')

    <div class="container">

        <div class="card" style="width: 100%;">
            <div class="card-body">
              <h2 class="card-title">Crear escenario</h2>
              <hr>
             
              <form  action="{{ route('stage.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Nombre</label>
                            <input class="form-control" type="text" name="nombre">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-control-label">Disciplina</label>
                        <select class="form-control" name="discipline">
                            <option>Seleccione</option>
                        </select>
                    </div>
    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-number-input" class="form-control-label">Capacidad</label>
                            <input class="form-control" type="number" name="capacity">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-number-input" class="form-control-label">Área</label>
                            <input class="form-control" type="number" name="area">
                        </div>
                    </div>

                </div>

                <!-- Segunda fila -->
    
                <div class="row">
    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Direccion</label>
                            <input class="form-control" type="text" name="description">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Latitud</label>
                            <input class="form-control" type="text" name="latitude">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Longitud</label>
                            <input class="form-control" type="text" name="longitude">
                        </div>
                    </div>
                   
                </div>

                <!-- Tercer fila -->
    
                <div class="row">
    
                    <div class="col-md-3">
                        <label class="form-control-label">Estado</label>
                        <select class="form-control" name="state">
                            <option>Seleccione</option>
                        </select>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción del estado</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="message_state"></textarea>
                          </div>
                    </div>

                </div>

                <!-- Cuarta fila -->
    
                <div class="row">
    
                    <div class="col-md-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="img">
                            <label class="custom-file-label" for="customFileLang">Selecionar imagen</label>
                        </div>
                    </div>

                </div>

                <hr>
                <h2 class="card-title">Añadir ubicación del escenario</h2>
                <hr>
                
                <!--Quinta fila-->
                <div class="row">
                    <div class="col">
                        <div class="card border-0">
                          <div id="map-default" class="map-canvas" data-lat="4.60971" data-lng="-74.08175" style="height: 600px;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-md-center" style="margin-top: 10px">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>          
               
            </form>
        </div>
            </div>
        </div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLkTMsqM_wWsRik7JueLXvAmcy3WOofCg"
        async
></script>

@endpush