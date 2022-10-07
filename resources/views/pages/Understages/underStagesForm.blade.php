<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre de sub escenario</label>
            <input  class="form-control @error('name_understg') is-invalid @enderror" type="text" name="name_understg" value="{{isset($underStage->name_understg)?$underStage->name_understg:old('name_understg')}}">
            @error('name_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <label class="form-control-label">Disciplina</label>
        <select class="form-control" name="discipline_understg" value="{{isset($underStage->discipline_understg)?$underStage->discipline_understg:''}}">
            @if (isset($underStage->discipline_understg))
                @foreach ($disciplines as $discipline)
                    @if ($underStage->discipline_understg == $discipline->disciplineId)
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

    <div class="col-md-3 col-sm-12">
        <label class="form-control-label">Escenario principal</label>
        <select class="form-control" name="idStage" value="{{isset($underStage->idStage)?$underStage->idStage:''}}">
            @if (isset($underStage->idStage))
                @foreach ($stages as $stage)
                    @if ($underStage->idStage == $stage->id)
                        <option value="{{$stage->id}}" selected>{{$stage->name}}</option>
                    @else
                        <option value="{{$stage->id}}">{{$stage->name}}</option>
                    @endif
                @endforeach
            @else
                @foreach ($stages as $stage)
                    <option value="{{$stage->id}}">{{$stage->name}}</option>
                @endforeach
            @endif
            
        </select>
    </div>

    <div class="form-group">
        <label for="example-text-input" class="form-control-label">Código</label>
        <input  class="form-control @error('understagecode') is-invalid @enderror" type="text" name="understagecode" value="{{isset($underStage->understagecode)?$underStage->understagecode:old('understagecode')}}">
        @error('understagecode') 
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

</div>

<div class="row">


     <div class="col-md-3 col-sm-12">
        <label class="form-control-label">Escala</label>
        <select class="form-control" name="understagescale">
            @if (isset($underStage->understagescale))

            @switch($underStage->understagescale)
                @case("Metropolitano")
                    <option value="Metropolitano" selected>Metropolitano</option>
                    <option value="Zonal">Zonal</option>
                    <option value="Regional">Regional</option>
                    <option value="Regional">Vecinal</option>
                    @break
                @case("Zonal")
                    <option value="Metropolitano">Metropolitano</option>
                    <option value="Zonal" selected>Zonal</option>
                    <option value="Regional">Regional</option>
                    <option value="Vecinal">Vecinal</option>
                    @break
                @case("Regional")
                    <option value="Metropolitano">Metropolitano</option>
                    <option value="Zonal">Zonal</option>
                    <option value="Regional" selected>Regional</option>
                    <option value="Vecinal">Vecinal</option>
                    @break
                @case("Vecinal")
                    <option value="Metropolitano">Metropolitano</option>
                    <option value="Zonal">Zonal</option>
                    <option value="Regional">Regional</option>
                    <option value="Vecinal" selected>Vecinal</option>
                    @break

                    
            @endswitch

            @else
                <option value="" selected>-- Seleccione --</option>
                <option value="Metropolitano">Metropolitano</option>
                <option value="Zonal">Zonal</option>
                <option value="Regional">Regional</option>
                <option value="Vecinal">Vecinal</option>
            @endif
        </select>

    </div> 

    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Capacidad</label>
            <input class="form-control @error('capacity_understg') is-invalid @enderror" type="number" name="capacity_understg" value="{{isset($underStage->capacity_understg)?$underStage->capacity_understg:old('capacity_understg')}}">
            @error('capacity_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Área m<sup>2</sup></label>
            <input class="form-control @error('area_understg') is-invalid @enderror" type="number" name="area_understg" value="{{isset($underStage->area_understg)?$underStage->area_understg:old('area_understg')}}">
            @error('area_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label for="example-number-input" class="form-control-label">Cantidad</label>
            <input class="form-control @error('understageqty') is-invalid @enderror" type="number" name="understageqty" value="{{isset($underStage->understageqty)?$underStage->area_understg:old('area_understg')}}">
            @error('understageqty') 
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
            <label for="exampleFormControlTextarea1">Descripción del sub escenario</label>
            <textarea class="form-control @error('description_understg') is-invalid @enderror" id="exampleFormControlTextarea1" rows="2" name="description_understg">{{isset($underStage->description_understg)?$underStage->description_understg:old('description_understg')}}</textarea>
            @error('description_understg') 
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
        <select required class="form-control" name="id_category_understg">
            @if (isset($underStage->id_category_understg))
            @foreach ($states as $state)
            @if ($state->statesId == $underStage->id_category_understg)
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
            <textarea class="form-control @error('message_state_understg') is-invalid @enderror" id="exampleFormControlTextarea1" rows="1" name="message_state_understg">{{isset($underStage->message_state_understg)?$underStage->message_state_understg:old('message_state_understg')}}</textarea>
            @error('message_state_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>
<!-- <div class="row">

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

</div> -->

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

<!-- Segunda fila -->

<div class="row">

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Direccion</label>
            <input class="form-control @error('address_understg') is-invalid @enderror" type="text" name="address_understg" value="{{isset($underStage->address_understg)?$underStage->address_understg:old('address_understg')}}" id="address">
            @error('address_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 col-sm-12">
        <label class="form-control-label">Localidad</label>
        <select class="form-control" name="localityid">
            @if (isset($underStage->localityid))
                @foreach ($localities as $locality)
                    @if ($locality->localityId == $underStage->localityid)
                        <option value="{{$locality->localityId}}" selected>{{$locality->localityName}}</option>
                    @else
                        <option value="{{$locality->localityId}}">{{$locality->localityName}}</option>
                    @endif
                @endforeach
            @else
                @foreach ($localities as $locality)
                    <option value="{{$locality->localityId}}">{{$locality->localityName}}</option>
                @endforeach
            @endif

        </select>
    </div>


    <div class="col-md-3 col-sm-12">
        <label class="form-control-label">Barrio</label>
        <select class="form-control" name="neighborhoodid">
            @if (isset($underStage->neighborhoodid))
                @foreach ($neighbordhoods as $neighbordhood)
                    @if ($neighbordhood->hoodId == $underStage->neighborhoodid)
                     <option value="{{$neighbordhood->hoodId}}" selected>{{$neighbordhood->hoodName}}</option>
                    @else
                     <option value="{{$neighbordhood->hoodId}}">{{$neighbordhood->hoodName}}</option>
                    @endif
                @endforeach
            @else
                @foreach ($neighbordhoods as $neighbordhood)
                 <option value="{{$neighbordhood->hoodId}}">{{$neighbordhood->hoodName}}</option>
                @endforeach
            @endif

        </select>
    </div>

</div>

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Latitud</label>
            <input class="form-control @error('latitude_understg') is-invalid @enderror" type="text" name="latitude_understg" value="{{isset($underStage->latitude_understg)?$underStage->latitude_understg:old('latitude_understg')}}" id="lat" readonly="true">
            @error('latitude_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Longitud</label>
            <input class="form-control @error('longitude_understg') is-invalid @enderror" type="text" name="longitude_understg" value="{{isset($underStage->longitude_understg)?$underStage->longitude_understg:old('longitude_understg')}}" id="lng" readonly="true">
            @error('longitude_understg') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

</div>

<!--Quinta fila-->
<div class="row">
    <div class="col">
        <div class="card border-0">
            <div id="map-default" class="map-canvas" style="max-height: 400px;"></div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 20px">
    <button type="submit" class="btn btn-success" value="Guardar" style="display: flex; width: 30%; justify-content: center">
        Guardar
    </button>
</div>