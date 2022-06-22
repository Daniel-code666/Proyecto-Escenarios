<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre</label>
            <input class="form-control" type="text" name="name" value="{{isset($stage->name)?$stage->name:''}}" required="Este es un campo obligatorio.">
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
            <input class="form-control" type="number" name="capacity" value="{{isset($stage->capacity)?$stage->capacity:''}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Área m<sup>2</sup></label>
            <input class="form-control" type="number" name="area" value="{{isset($stage->area)?$stage->area:''}}">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del escenario</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="descripcion">{{isset($stage->descripcion)?$stage->descripcion:''}}</textarea>
          </div>
    </div>
</div>



<!-- Tercer fila -->

<div class="row">

    <div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select required class="form-control" name="id_category" >
           @if (isset($stage->id_category))
             @foreach ($states as $state)
                @if ($state->id == $stage->id_category)
                    <option value="{{$state->id}}" selected>{{$state->name}}</option>
                @else
                    <option value="{{$state->id}}">{{$state->name}}</option>
                @endif
             @endforeach
           @else
             @foreach ($states as $state)
               <option value="{{$state->id}}">{{$state->name}}</option>
             @endforeach
           @endif
            
        </select>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="message_state">{{isset($stage->message_state)?$stage->message_state:''}}</textarea>
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

<!-- Segunda fila -->

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Direccion</label>
            <input class="form-control" type="text" name="address" value="{{isset($stage->address)?$stage->address:''}}"  id="address">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Latitud</label>
            <input class="form-control" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:''}}" id="lat" readonly="true">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Longitud</label>
            <input class="form-control" type="text" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:''}}"id="lng" readonly="true">
        </div>
    </div>
   
</div>

<!--Quinta fila-->
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