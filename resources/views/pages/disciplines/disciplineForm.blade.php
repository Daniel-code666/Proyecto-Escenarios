<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre de la disciplina</label>
            <input class="form-control" type="text" name="discipline_name" value="{{isset($discipline->discipline_name)?$discipline->discipline_name:''}}" required="Este es un campo obligatorio.">
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción de la disciplina</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="discipline_description">{{isset($discipline->discipline_description)?$discipline->discipline_description:''}}</textarea>
          </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 10px">
    <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
</div>