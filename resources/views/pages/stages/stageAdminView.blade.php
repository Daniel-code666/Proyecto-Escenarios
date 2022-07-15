@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

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

                    <img class="img-center" src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="{{$stage->name}}" width="550">
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
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#warehouse-section" aria-controls="" data-toggle="tab" role="tab">
                                <h3 style="padding-right: 10px"><strong>Almacenes</strong></h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#inventory-section" aria-controls="" data-toggle="tab" role="tab">
                                <h3 style="padding-right: 10px"><strong>Inventarios</strong></h3>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#understages-section" aria-controls="" data-toggle="tab" role="tab">
                                <h3 style="padding-right: 10px"><strong>Sub escenarios</strong></h3>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="warehouse-section">
                            @if($stageWarehouse->isEmpty())
                            <div class="row offset-0">
                                <h4><strong>Este escenario no tiene almacenes</strong></h4>
                            </div>
                            @else
                            <div class="row offset-0">
                                <h4>Almacenes asociados</h4>
                            </div>
                            <div class="card-body px-lg-3 py-lg-1">
                                <div class="table-responsive m-2">
                                    <table id="warehouse_table" class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort">Id</th>
                                                <th scope="col" class="sort">Nombre</th>
                                                <th scope="col" class="sort">Descripción</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($stageWarehouse as $stWarehouse)
                                            <tr>
                                                <td>{{ $stWarehouse->warehouseId }}</td>
                                                <td>{{ $stWarehouse->warehouseName }}</td>
                                                <td>{{ $stWarehouse->warehouseDescription }}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ url('/almacen/'.$stWarehouse->warehouseId.'/edit') }}">Editar</a>
                                                            <form action="{{ url('/almacen/'.$stWarehouse->warehouseId) }} " method="post" style="display: inline-block">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                                <a type="submit" class="dropdown-item" onclick="return confirm('¿Quieres eliminar el almacén?')">Eliminar</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#warehouse_table').DataTable();
                                });
                            </script>
                            @endif
                        </div>

                        <div role="tabpanel" class="tab-pane" id="inventory-section">
                            @if(count($arrStages) == 0)
                            <div class="row offset-0">
                                <h4><strong>Este escenario no tiene inventarios</strong></h4>
                            </div>
                            @else
                            <div class="row offset-0">
                                <h4>Inventarios</h4>
                            </div>
                            <div class="card-body px-lg-3 py-lg-3">
                                <div class="table-responsive m-2">
                                    <table id="inventory_table" class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort">Id</th>
                                                <th scope="col" class="sort">Nombre</th>
                                                <th scope="col" class="sort">Cantidad</th>
                                                <th scope="col" class="sort">Almacén</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($arrStages as $arrstg)
                                            @foreach($arrstg as $arrSt)
                                            <tr>
                                                <td>{{ $arrSt->idResource }}</td>
                                                <td>{{ $arrSt->resourceName }}</td>
                                                <td>{{ $arrSt->amount }}</td>
                                                <td>{{ $arrSt->warehouseName }} </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ url('/item/'.$arrSt->idResource.'/edit') }}">Editar</a>
                                                            <form action="{{ url('/item/'.$arrSt->idResource) }} " method="post" style="display: inline-block">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                                <a type="submit" class="dropdown-item" onclick="return confirm('¿Quieres eliminar el recurso?')">Eliminar</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#inventory_table').DataTable();
                                });
                            </script>
                            @endif
                        </div>

                        <div role="tabpanel" class="tab-pane" id="understages-section">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row offset-0">
                <h4>Ubicación en el mapa</h4>
                <input hidden class="form-control" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:''}}" id="lat">
                <input hidden class="form-control" type="text" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:''}}" id="lng">
                <div id="map-default" class="map-canvas-2"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>
@endsection