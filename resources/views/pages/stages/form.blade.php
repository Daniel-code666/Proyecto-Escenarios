<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{isset($stage->name)?$stage->name:old('name')}}">
            @error('name') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror

        </div>
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Disciplina</label>
        <select class="form-control" name="discipline">
            @if (isset($stage->discipline))
            @foreach ($disciplines as $discipline)
            @if ($discipline->disciplineId == $stage->discipline)
            <option value="{{$discipline->disciplineId}}" selected>{{$discipline->discipline_name}}</option>
            @else
            <option value="{{$discipline->disciplineId}}">{{$discipline->discipline_name}}</option>
            @endif
            @endforeach
            @else
            @foreach ($disciplines as $discipline)
            <option value="{{$discipline->disciplineId}}">{{$discipline->discipline_name}}</option>
            @endforeach
            @endif

        </select>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Capacidad</label>
            <input class="form-control @error('capacity') is-invalid @enderror" type="number" name="capacity" value="{{isset($stage->capacity)?$stage->capacity:old('capacity')}}">
            @error('capacity') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Área m<sup>2</sup></label>
            <input class="form-control @error('area') is-invalid @enderror" type="number" name="area" value="{{isset($stage->area)?$stage->area:old('area')}}">
            @error('area') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del escenario</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="exampleFormControlTextarea1" rows="2" name="descripcion">{{isset($stage->descripcion)?$stage->descripcion:old('descripcion')}}</textarea>
            @error('descripcion') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>



<!-- Tercer fila -->
<div class="row">
    <div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select required class="form-control" name="id_category">
            @if (isset($stage->id_category))
            @foreach ($states as $state)
            @if ($state->statesId == $stage->id_category)
            <option value="{{$state->statesId}}" selected>{{$state->statesName}}</option>
            @else
            <option value="{{$state->statesId}}">{{$state->statesName}}</option>
            @endif
            @endforeach
            @else
            @foreach ($states as $state)
            <option value="{{$state->statesId}}">{{$state->statesName}}</option>
            @endforeach
            @endif
        </select>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control @error('message_state') is-invalid @enderror" id="exampleFormControlTextarea1" rows="1" name="message_state">{{isset($stage->message_state)?$stage->message_state:old('message_state')}}</textarea>
            @error('message_state') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<!-- Cuarta fila -->

<div class="col">
    <label for="example-text-input" class="form-control-label">Seleccionar Imagen</label>
    <br>
    <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="" width="100">
    <div>
        <input type="file" name="photo" id="photo" value="{{isset($stage->photo)?$stage->photo:''}}">
    </div>
</div>

<hr>
<h2 class="card-title">Añadir ubicación del escenario</h2>
<hr>

<!-- Quinta fila -->

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Direccion</label>
            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{isset($stage->address)?$stage->address:old('address')}}" id="address">
            @error('address') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Latitud</label>
            <input class="form-control @error('latitude') is-invalid @enderror" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:old('latitude')}}" id="lat" readonly="true">
            @error('latitude') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Longitud</label>
            <input class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:old('longitude')}}" id="lng" readonly="true">
            @error('longitude') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<!--Sexta fila-->
<div class="row">
    <div class="col">
        <div class="card border-0">
            <div id="map-default" class="map-canvas" style="height: 500px;"></div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>
