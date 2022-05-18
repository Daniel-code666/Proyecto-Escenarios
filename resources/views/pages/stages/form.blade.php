<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre</label>
            <input class="form-control" type="text" name="name" value="{{isset($stage->name)?$stage->name:''}}">
        </div>
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Disciplina</label>
        <select class="form-control" name="discipline" value="{{isset($stage->discipline)?$stage->discipline:''}}">
            <option selected>Seleccionar</option>
            <option value="1">Natación</option>
            <option value="2">Futbol</option>
            <option value="3">Baloncesto</option>
            
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
            <label for="example-number-input" class="form-control-label">Área</label>
            <input class="form-control" type="number" name="area" value="{{isset($stage->area)?$stage->area:''}}">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del escenario</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="descripcion" value="{{isset($stage->descripcion)?$stage->descripcion:''}}"></textarea>
          </div>
    </div>
</div>

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
            <input class="form-control" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:''}}" id="lat">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Longitud</label>
            <input class="form-control" type="text" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:''}}"id="lng">
        </div>
    </div>
   
</div>

<!-- Tercer fila -->

<div class="row">

    <div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select class="form-control" name="id_category" value="{{isset($stage->id_category)?$stage->id_category:''}}">
            <option selected>Seleccionar</option>
            <option value="1">Malo</option>
            <option value="2">Regular</option>
            <option value="3">Bueno</option>
        </select>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="message_state" value="{{isset($stage->message_state)?$stage->message_state:''}}"></textarea>
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

<!--Quinta fila-->
<div class="row">
    <div class="col">
        <div class="card border-0">
          <div id="map-default" class="map-canvas" style="height: 600px;"></div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>