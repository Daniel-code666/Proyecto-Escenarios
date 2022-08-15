<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Nombre del almacén</label>
            <input class="form-control @error('warehouseName') is-invalid @enderror" type="text" name="warehouseName" value="{{isset($warehouse->warehouseName)?$warehouse->warehouseName:old('warehouseName')}}">
            @error('warehouseName')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <label class="form-control-label">Escenario donde se ubica</label>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <input type="checkbox" class="cb" id="esc" name="locationCheck" value="1" onclick="toggleSelectMain()" onchange="cbChange(this)">
                    <label>¿Escenario principal?</label>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="cb" id="sub" name="locationCheck" value="0" onclick="toggleSelectSub()" onchange="cbChange(this)">
                    <label>¿Sub escenario?</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <select required class="form-control" name="warehouseLocation" id="selectEsc" disabled>
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
                <div class="col-md-4">
                    <select required class="form-control" name="warehouseLocation" id="selectSub" disabled>
                        @if (isset($warehouse->warehouseLocation)?$warehouse->warehouseLocation:'')
                        @foreach ($underStages as $underStage)
                        @if ($warehouse->warehouseLocation == $underStage->idUnderstage)
                        <option value="{{$underStage->idUnderstage}}" selected>{{$underStage->name_understg}}</option>
                        @else
                        <option value="{{$underStage->idUnderstage}}">{{$underStage->name_understg}}</option>
                        @endif
                        @endforeach
                        @else
                        @foreach ($underStages as $underStage)
                        <option value="{{$underStage->idUnderstage}}">{{$underStage->name_understg}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Descripción del almacén</label>
            <textarea class="form-control @error('warehouseDescription') is-invalid @enderror" id="exampleFormControlTextarea1" rows="2" name="warehouseDescription">{{isset($warehouse->warehouseDescription)?$warehouse->warehouseDescription:old('warehouseDescription')}}</textarea>
            @error('warehouseDescription')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
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