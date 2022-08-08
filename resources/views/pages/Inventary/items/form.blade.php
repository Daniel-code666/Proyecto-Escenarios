<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre</label>
            <input class="form-control @error('resourceName') is-invalid @enderror" type="text" name="resourceName" value="{{isset($resource->resourceName)?$resource->resourceName:old('resourceName')}}">
            @error('resourceName')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Código</label>
            <input class="form-control @error('resourceCode') is-invalid @enderror" type="text" name="resourceCode" value="{{isset($resource->resourceCode)?$resource->resourceCode:old('resourceCode')}}">
            @error('resourceCode')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Cantidad</label>
            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" value="{{isset($resource->amount)?$resource->amount:old('amount')}}">
            @error('amount')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label class="form-control-label">Descripción del objeto</label>
        <textarea class="form-control @error('resourceDescription') is-invalid @enderror" id="exampleFormControlTextarea1" rows="1" name="resourceDescription">{{isset($resource->resourceDescription)?$resource->resourceDescription:old('resourceDescription')}}</textarea>
        @error('resourceDescription')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <label class="form-control-label">Ubicación</label>
        <div class="row">
            <div class="col-md-5">
                <input type="checkbox" class="cb" id="esc" onclick="toggleSelectMain()" onchange="cbChange(this)">
                <label>¿Escenario principal?</label>
            </div>
            <div class="col-md-5">
                <input type="checkbox" class="cb" id="sub" onclick="toggleSelectSub()" onchange="cbChange(this)">
                <label>¿Sub escenario?</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <select class="form-control" name="resources_warehouseId" id="selectEsc" disabled>
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
            <div class="col-md-5">
                <select class="form-control" name="resources_warehouseId" id="selectSub" disabled>
                    @if (isset($resource->resources_warehouseId))
                    @foreach ($warehousesSub as $warehouse)
                    @if ($warehouse->warehouseId == $resource->resources_warehouseId)
                    <option value="{{$warehouse->warehouseId}}" selected>{{$warehouse->warehouseName}} - {{$warehouse->name_understg}}</option>
                    @else
                    <option value="{{$warehouse->warehouseId}}">{{$warehouse->warehouseName}} - {{$warehouse->name_understg}}</option>
                    @endif
                    @endforeach
                    @else
                    @foreach ($warehousesSub as $warehouse)
                    <option value="{{$warehouse->warehouseId}}">{{$warehouse->warehouseName}} - {{$warehouse->name_understg}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-3">
        <label class="form-control-label">Estado</label>
        <select required class="form-control" name="id_category">
            @if (isset($resource->id_category))
            @foreach ($states as $state)
            @if ($state->id == $resource->id_category)
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

    <div class="col-md-4">
        <label class="form-control-label">Descripción del estado</label>
        <textarea class="form-control @error('resourceMsgState') is-invalid @enderror" id="exampleFormControlTextarea1" rows="1" name="resourceMsgState">{{isset($resource->resourceMsgState)?$resource->resourceMsgState:old('resourceMsgState')}}</textarea>
        @error('resourceMsgState')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Imagen de referencia</label>
            <img src="{{isset($resource->resourcePhoto)?asset('storage').'/'.$resource->resourcePhoto:''}}" alt="" width="100">
            <div>
                <input type="file" name="resourcePhoto" value="{{isset($resource->resourcePhoto)?$resource->resourcePhoto:''}}">
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>

<script>
    function toggleSelectMain() {
        var isChecked = document.getElementById("esc").checked;

        if (isChecked) {
            document.getElementById("selectSub").disabled = true;
            document.getElementById("selectEsc").disabled = false;
        } else {
            document.getElementById("selectEsc").disabled = true;
        }
    }

    function toggleSelectSub() {
        var isChecked = document.getElementById("sub").checked;

        if (isChecked) {
            document.getElementById("selectEsc").disabled = true;
            document.getElementById("selectSub").disabled = false;
        } else {
            document.getElementById("selectSub").disabled = true;
        }
    }

    function cbChange(obj) {
        var cbs = document.getElementsByClassName("cb");
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        obj.checked = true;
    }
</script>