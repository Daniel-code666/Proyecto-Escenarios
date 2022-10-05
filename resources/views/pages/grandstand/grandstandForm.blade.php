<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre de la disciplina</label>
            <input class="form-control @error('grandstandname') is-invalid @enderror" type="text" name="grandstandname" value="{{isset($grandstand->grandstandname)?$grandstand->grandstandname:old('grandstandname')}}">
            @error('grandstandname') 
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
            <label for="exampleFormControlTextarea1">Descripción de la disciplina</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="2" name="description">{{isset($grandstand->description)?$grandstand->description:old('description')}}</textarea>
            @error('description') 
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