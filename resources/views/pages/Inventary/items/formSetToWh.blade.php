<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Cantidad de elementos en el almacén</label>
            <input class="form-control @error('amount') is-invalid @enderror" type="number" name="amount" placeholder="{{isset($resource->amount)?$resource->amount:old('amount')}}">
            @error('amount')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Cantidad de elementos en uso</label>
            <input disabled class="form-control @error('amount') is-invalid @enderror" type="number" name="amountInUse" placeholder="{{isset($resource->amountInUse)?$resource->amountInUse:old('amountInUse')}}">
            @error('amountInUse')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div style="padding-top: 32px;" class="row justify-content-md-center" style="margin-top: 10px">
            <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
        </div>
    </div>
</div>