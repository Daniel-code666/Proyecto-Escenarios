<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Cantidad de elementos en el almacén</label>
            <input disabled class="form-control @error('amount') is-invalid @enderror" type="text" name="amount" value="{{isset($resource->amount)?$resource->amount:old('amount')}}">
            @error('amount')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Última cantidad reabastecida</label>
            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="resupplyAmount" value="{{isset($resupply->resupplyAmount)?$resupply->resupplyAmount:old('resupplyAmount')}}">
            @error('amountInUse')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Fecha de la última cantidad reabastecida</label>
            <input class="form-control" disabled type="text" name="updated_at" value="{{isset($resupply->updated_at)?$resupply->updated_at:old('updated_at')}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4"></div>
    <div class="col-md-4">
        <div style="padding-top: 32px;" class="row justify-content-md-center" style="margin-top: 10px">
            <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
        </div>
    </div>
    <div class="col-4"></div>
</div>