<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del estado</label>
            <input class="form-control" type="text" name="name" value="{{isset($stateInventary->name)?$stateescenary->name:''}}" required="Este es un campo obligatorio.">
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control" id="description" rows="2" name="description">{{isset($stateInventary->description)?$stateescenary->description:''}}</textarea>
          </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>