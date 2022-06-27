<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del almacén</label>
            <input class="form-control" type="text" name="name" value="{{isset($warehouse->name)?$warehouse->name:''}}" required="Este es un campo obligatorio.">
        </div>      
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Dirección del almacén</label>
            <input class="form-control" type="text" name="address" value="{{isset($warehouse->address)?$warehouse->address:''}}" required="Este es un campo obligatorio.">
        </div>      
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Descripción del almacén</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="description" value="{{isset($warehouse->description)?$warehouse->description:''}}" required="Este es un campo obligatorio."></textarea>
        </div>      
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>