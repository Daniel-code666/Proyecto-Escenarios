<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre</label>
            <input class="form-control" type="text" name="resourceName" value="{{isset($resource->resourceName)?$resource->resourceName:''}}" required="Este es un campo obligatorio.">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Código</label>
            <input class="form-control" type="text" name="resourceCode" value="{{isset($resource->resourceCode)?$resource->resourceCode:''}}">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Cantidad</label>
            <input class="form-control" type="text" name="amount" value="{{isset($resource->amount)?$resource->amount:''}}" required="Este es un campo obligatorio.">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-control-label">Descripción del objeto</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="resourceDescription">{{isset($resource->resourceDescription)?$resource->resourceDescription:''}}</textarea>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <label class="form-control-label">Ubicación</label>
        <select class="form-control" name="resources_warehouseId">
            @if (isset($resource->resources_warehouseId))
                @foreach ($warehouses as $warehouse)
                    @if ($warehouse->warehouseId == $resource->resources_warehouseId)
                        <option value="{{$warehouse->warehouseId}}" selected>{{$warehouse->warehouseName}} - {{$warehouse->name}}</option>
                    @else
                        <option value="{{$warehouse->warehouseId}}">{{$warehouse->warehouseName}} - {{$warehouse->name}}</option>
                    @endif
                @endforeach
            @else
                @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->warehouseId}}">{{$warehouse->warehouseName}} - {{$warehouse->name}}</option>   
                @endforeach    
            @endif
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select required class="form-control" name="id_category" >
            @if (isset($resource->id_category))
                @foreach ($states as $state)
                    @if ($state->id == $resource->id_category)
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

    <div class="col-md-4">
        <label class="form-control-label">Descripción del estado</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="resourceMsgState">{{isset($resource->resourceMsgState)?$resource->resourceMsgState:''}}</textarea>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Imagen de referencia</label>
            <img src="{{isset($resource->resourcePhoto)?asset('storage').'/'.$resource->resourcePhoto:''}}" alt="" width="100">
            <div>
                <input type="file" name="resourcePhoto" id="resourcePhoto" value="{{isset($resource->resourcePhoto)?$resource->resourcePhoto:''}}">
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>