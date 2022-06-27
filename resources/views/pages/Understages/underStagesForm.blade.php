<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre de sub escenario</label>
            <input class="form-control" type="text" name="name_understg" value="{{isset($underStage->name_understg)?$underStage->name_understg:''}}" required="Este es un campo obligatorio.">
        </div>
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Disciplina</label>
        <select class="form-control" name="discipline_understg" value="{{isset($underStage->discipline_understg)?$underStage->discipline_understg:''}}">
            @foreach ($disciplines as $discipline)
            <option value="{{$discipline->disciplineId}}">{{$discipline->discipline_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Escenario principal</label>
        <select class="form-control" name="idStage" value="{{isset($underStage->idStage)?$underStage->idStage:''}}">
            @foreach ($stages as $stage)
            <option value="{{$stage->id}}">{{$stage->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Capacidad</label>
            <input class="form-control" type="number" name="capacity_understg" value="{{isset($underStage->capacity_understg)?$underStage->capacity_understg:''}}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Área m<sup>2</sup></label>
            <input class="form-control" type="number" name="area_understg" value="{{isset($underStage->area_understg)?$underStage->area_understg:''}}">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del escenario</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="description_understg">{{isset($underStage->description_understg)?$underStage->description_understg:''}}</textarea>
        </div>
    </div>
</div>

<!-- Tercer fila -->

<div class="row">

    <div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select required class="form-control" name="id_category_understg" value="{{isset($underStage->id_category_understg)?$underStage->id_category_understg:''}}">
            <option value="">Seleccionar</option>
            <option value="1">Malo</option>
            <option value="2">Regular</option>
            <option value="3">Bueno</option>
        </select>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="message_state_understg">{{isset($underStage->message_state_understg)?$underStage->message_state_understg:''}}</textarea>
        </div>
    </div>

</div>

<!-- Cuarta fila -->

<div class="col">
    <label for="example-text-input" class="form-control-label">Seleccionar Imagen</label>
    <br>
    <img src="{{isset($underStage->photo_understg)?asset('storage').'/'.$underStage->photo_understg:''}}" alt="" width="100">
    <div>
        <input type="file" name="photo_understg" id="photo" value="{{isset($underStage->photo_understg)?$underStage->photo_understg:''}}">
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
            <input class="form-control" type="text" name="address_understg" value="{{isset($underStage->address_understg)?$underStage->address_understg:''}}" id="address">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Latitud</label>
            <input class="form-control" type="text" name="latitude_understg" value="{{isset($underStage->latitude_understg)?$underStage->latitude_understg:''}}" id="lat" readonly="true">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Longitud</label>
            <input class="form-control" type="text" name="longitude_understg" value="{{isset($underStage->longitude_understg)?$underStage->longitude_understg:''}}" id="lng" readonly="true">
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