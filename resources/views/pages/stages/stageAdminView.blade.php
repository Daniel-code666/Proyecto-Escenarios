@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-violet">{{ __('Información del escenario') }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-secondary shadow">
            <div class="card-body px-lg-3 py-lg-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="offset-0">
                            <h4>Foto del escenario</h4>
                        </div>

                        <img class="img-center" src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" 
                        alt="{{$stage->name}}" width="550">
                    </div>
                </div>

                <div class="row offset-0">
                    <h4>Nombre del escenario</h4>
                </div>
                <div class="row offset-1">
                    <h2>{{ $stage->name }}</h2>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="offset-0-fixed">
                            <h4>Dirección</h4>
                        </div>
                        
                        <div class="offset-1-fixed">
                            <h3>{{$stage->address}}</h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="offset-0-fixed">
                            <h4>Tamaño</h4>
                        </div>
                        <div class="offset-1-fixed">
                            <h3>{{$stage->area}} m<sup>2</sup></h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="offset-0-fixed">
                            <h4>Capacidad</h4>
                        </div>
                        <div class="offset-1-fixed">
                            <h3>{{$stage->capacity}} personas</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="offset-0-fixed">
                            <h4>Disciplina</h4>
                        </div>
                        <div class="offset-1-fixed">
                            <h3>{{$stage->discipline_name}}</h3>
                        </div>
                    </div>
                </div>

                <div class="row offset-0">
                    <h4>Descripción</h4>
                </div>
                <div class="row offset-0-fixed">
                    <h3>{{$stage->descripcion}}</h3>
                </div>

                <div class="row offset-0">
                    <h4>Almacenes asociados</h4>
                </div>
                <div class="card-body px-lg-3 py-lg-3">
                    <div class="table-responsive m-2">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">Id</th>
                                    <th scope="col" class="sort">Nombre</th>
                                    <th scope="col" class="sort">Escenario</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($arrStages as $arrstg)
                                    <!-- @for($i = 0; $i < count($arrstg); $i++)
                                        <td>{{$arrstg[$i]->warehouseId}}</td>
                                        <td>{{$arrstg[$i]->warehouseName}}</td>
                                        <td>{{$arrstg[$i]->name}}</td>
                                        <td>{{$arrstg[$i]->resourceName}}</td>
                                    @endfor -->
                                    @foreach($arrstg as $arrSt)
                                        <tr>
                                            <td>{{ $arrSt->warehouseId }}</td>
                                            <td>{{ $arrSt->warehouseName }}</td>
                                            <td>{{ $arrSt->name }} </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row offset-0">
                    <h4>Inventarios</h4>
                </div>
                <div class="card-body px-lg-3 py-lg-3">
                    <div class="table-responsive m-2">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">Id</th>
                                    <th scope="col" class="sort">Nombre</th>
                                    <th scope="col" class="sort">Almacén</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($arrStages as $arrstg)
                                    @foreach($arrstg as $arrSt)
                                        <tr>
                                            <td>{{ $arrSt->idResource }}</td>
                                            <td>{{ $arrSt->resourceName }}</td>
                                            <td>{{ $arrSt->warehouseName }} </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($understages->isEmpty())
                    <div class="row offset-0">
                        <h4><strong>Este escenario no tiene sub escenarios asociados</strong></h4>
                    </div>
                @else
                    <div class="row offset-0">
                        <h4>Sub escenarios asociados</h4>
                    </div>
                    <div class="card-body px-lg-3 py-lg-3">
                        <div class="table-responsive m-2">
                            <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Id</th>
                                    <th scope="col" class="sort" data-sort="status">Foto</th>
                                    <th scope="col" class="sort" data-sort="budget">Nombre</th>
                                    <th scope="col" class="sort" data-sort="completion">Dirección</th>
                                    <th scope="col" class="sort" data-sort="completion">Disciplina</th>
                                    <th scope="col" class="sort" data-sort="completion">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($understages as $understage)
                                    <tr>
                                        <td>{{$understage->idUnderstage}}</td>
                                        <td><img src="{{asset('storage').'/'.$understage->photo_understg}}" alt="" width="100"></td>
                                        <td>{{$understage->name_understg}}</td>
                                        <td>{{$understage->address_understg}}</td>
                                        <td>{{$understage->discipline_name}}</td>
                                        <td>
                                            <a type="button" class="btn btn-info" href="{{ route('showUnderSt', ['idUnderstage'=>$understage->idUnderstage]) }}">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="row offset-0">
                    <h4>Ubicación en el mapa</h4>
                    <input hidden class="form-control" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:''}}" id="lat">
                    <input hidden class="form-control" type="text" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:''}}"id="lng">
                    <div id="map-default" class="map-canvas-2"></div>
                </div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"
></script>
@endsection