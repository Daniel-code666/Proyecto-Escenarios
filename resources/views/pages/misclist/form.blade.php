<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del estado</label>
            <input class="form-control" type="text" name="statesName" value="{{isset($stateescenary->statesName)?$stateescenary->statesName:''}}" required="Este es un campo obligatorio.">
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control" id="description" rows="2" name="statesDescription">{{isset($stateescenary->statesDescription)?$stateescenary->statesDescription:''}}</textarea>
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>