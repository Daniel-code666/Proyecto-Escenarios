<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del almacén</label>
            <input class="form-control" type="text" name="warehouseName" value="{{isset($warehouse->warehouseName)?$warehouse->warehouseName:''}}" required="Este es un campo obligatorio.">
        </div>      
    </div>

    <div class="col-md-3">
        <label class="form-control-label">Escenario donde se ubica</label>

        <select required class="form-control" name="warehouseLocation" >
            @if (isset($warehouse->warehouseLocation)?$warehouse->warehouseLocation:'')
                @foreach ($stages as $stage)
                    @if ($warehouse->warehouseLocation == $stage->id)
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
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Descripción del almacén</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="warehouseDescription" required="Este es un campo obligatorio.">{{isset($warehouse->warehouseDescription)?$warehouse->warehouseDescription:''}}</textarea>
        </div>      
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>