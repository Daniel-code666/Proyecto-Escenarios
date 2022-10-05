<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del estado</label>
            <input class="form-control @error('statesName') is-invalid @enderror" type="text" name="statesName" value="{{isset($stateInventary->statesName)?$stateInventary->statesName:old('statesName')}}">
            @error('statesName') 
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
            <label for="exampleFormControlTextarea1">Descripción del estado</label>
            <textarea class="form-control @error('statesDescription') is-invalid @enderror" id="description" rows="2" name="statesDescription">{{isset($stateInventary->statesDescription)?$stateInventary->statesDescription:old('statesDescription')}}</textarea>
            @error('statesDescription') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

<div class="row justify-content-md-center" style="margin-top: 20px">
    <button type="submit" class="btn btn-success" value="Guardar" style="display: flex; width: 30%; justify-content: center">
        Guardar
    </button>
</div>