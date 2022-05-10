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
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-control-label">Disciplina</label>
                        <select class="form-control" name="discipline">
                            <option selected>Seleccionar</option>
                            <option value="1">Natación</option>
                            <option value="2">Futbol</option>
                            <option value="3">Baloncesto</option>
                            
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción del escenario</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="descripcion"></textarea>
                          </div>
                    </div>
                </div>

                <!-- Segunda fila -->
    
                <div class="row">
    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Direccion</label>
                            <input class="form-control" type="text" name="address">
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
                        <select class="form-control" name="id_category">
                            <option selected>Seleccionar</option>
                            <option value="1">Malo</option>
                            <option value="2">Regular</option>
                            <option value="3">Bueno</option>
                        </select>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción del estado</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="message_state"></textarea>
                          </div>
                    </div>

                </div>

                <!-- Tercer fila -->
    
                <div class="row">
    
                    <div class="col-md-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img">
                            <label class="custom-file-label" for="customFileLang">Selecionar imagen</label>
                        </div>
                    </div>

                </div>   
                <div class="row justify-content-md-center" style="margin-top: 10px">
                    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
                </div>          
                
            </form>
        </div>
            </div>
        </div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush