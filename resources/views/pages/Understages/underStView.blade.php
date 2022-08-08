@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/fonts/Roboto.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
</head>

<div class="header bg-gradient-primary py-6-fixed">
    <div class="card bg-secondary shadow">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <h1 class="text-violet">{{ __('Información del sub escenario') }}</h1>
            </div>
        </div>

        <div class="card-body px-lg-3 py-lg-3">
            <div class="row">
                <div class="col-md-7">
                    <div class="offset-0">
                        <h4>Foto del escenario</h4>
                    </div>
                    <img class="offset-0" src="{{isset($stage->photo_understg)?asset('storage').'/'.$stage->photo_understg:''}}" alt="Estadio Nemecio Camacho El Campín" width="550">
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <h4>Nombre del escenario</h4>
                        <div class="offset-1">
                            <h2>{{ $stage->name_understg }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <h4>Dirección</h4>
                            <div class="offset-1">
                                <h3>{{ $stage->address_understg }}</h3>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4>Tamaño</h4>
                            <div class="offset-1-fixed">
                                <h3>{{ $stage->area_understg }}m<sup>2</sup></h3>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h4>Capacidad</h4>
                            <div class="offset-1-fixed">
                                <h3>{{ $stage->capacity_understg }} personas</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Disciplina</h4>
                            <div class="offset-1-fixed">
                                <h3>{{$stage->discipline_name}}</h3>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h4>Escenario principal</h4>
                            <div class="offset-1-fixed">
                                <h3>{{ $stage->name }}</h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4>Descripción del sub escenario</h4>
                            <div class="offset-1-fixed">
                                <h3>{{ $stage->description_understg }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="warpper">
                <input class="radio" id="one" name="group" type="radio" checked>
                <input class="radio" id="two" name="group" type="radio">
                <input class="radio" id="three" name="group" type="radio">
                <input class="radio" id="four" name="group" type="radio">
                <div class="tabs">
                    <label class="tab" id="one-tab" for="one">Almacenes</label>
                    <label class="tab" id="two-tab" for="two">Inventarios</label>
                    <label class="tab" id="three-tab" for="three">Escenario principal</label>
                    <label class="tab" id="four-tab" for="four">Ubicación</label>
                </div>
                <div class="panels">
                    <!-- Panel de almacenes -->
                    <div class="panel" id="one-panel">
                        <div class="panel-title">Almacenes asociados</div>
                        @if($stageWarehouse->isEmpty())
                        <div class="row offset-0">
                            <h4><strong>Este escenario no tiene almacenes</strong></h4>
                        </div>
                        @else
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
                                                        <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el almacén?')">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- script de la tabla de almacenes -->
                        <script>
                            $(document).ready(function() {
                                $('#warehouse_table').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                                    language: {
                                        lengthMenu: 'Mostrando _MENU_ registros por página',
                                        zeroRecords: 'No hay registros para mostrar',
                                        info: 'Mostrando página _PAGE_ de _PAGES_',
                                        infoEmpty: 'No hay registros disponibles',
                                        infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                        sSearch: 'Buscar',
                                        'paginate': {
                                            'previous': '<i class="fas fa-light fa-arrow-left"></i>',
                                            'next': '<i class="fas fa-light fa-arrow-right"></i>'
                                        },
                                        buttons: {
                                            pageLength: 'Mostrando %d filas'
                                        },
                                    },
                                });
                            });
                        </script>
                        @endif
                    </div>
                    <!-- panel de inventarios -->
                    <div class="panel" id="two-panel">
                        <div class="panel-title">Inventarios asociados</div>
                        @if(count($arrStages) == 0)
                        <div class="row offset-0">
                            <h4><strong>Este escenario no tiene inventarios</strong></h4>
                        </div>
                        @else
                        <div class="card-body py-lg-1">
                            <div class="table-responsive-lg m-2">
                                <table id="inventory_table" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">Id</th>
                                            <th scope="col" class="sort">Nombre</th>
                                            <th>Código</th>
                                            <th>Estado</th>
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
                                            <td>{{ $arrSt->resourceCode }} </td>
                                            <td>{{ $arrSt->statesName }}</td>
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
                                                            <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el recurso?')">Eliminar</button>
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
                        <!-- script de la tabla de inventarios -->
                        <script>
                            $(document).ready(function() {
                                $('#inventory_table').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                                    language: {
                                        lengthMenu: 'Mostrando _MENU_ registros por página',
                                        zeroRecords: 'No hay registros para mostrar',
                                        info: 'Mostrando página _PAGE_ de _PAGES_',
                                        infoEmpty: 'No hay registros disponibles',
                                        infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                        sSearch: 'Buscar',
                                        'paginate': {
                                            'previous': '<i class="fas fa-light fa-arrow-left"></i>',
                                            'next': '<i class="fas fa-light fa-arrow-right"></i>'
                                        },
                                        buttons: {
                                            pageLength: 'Mostrando %d filas'
                                        },
                                    },
                                });
                            });
                        </script>
                        @endif
                    </div>
                    <!-- panel de escenario principal -->
                    <div class="panel" id="three-panel">
                        <div class="panel-title">Sub escenarios asociados</div>
                        <div class="card-body px-lg-3 py-lg-1">
                            <div class="table-responsive m-2">
                                <table id="stage_table" class="table align-items-center table-flush">
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
                                        <tr>
                                            <td>{{$stageMain->id}}</td>
                                            <td><img src="{{asset('storage').'/'.$stageMain->photo}}" alt="" width="100"></td>
                                            <td>{{$stageMain->name}}</td>
                                            <td>{{$stageMain->address}}</td>
                                            <td>{{$stageMain->discipline_name}}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('viewStageInfo', ['id'=>$stageMain->id]) }}">Ver</a>
                                                        <a class="dropdown-item" href="{{ url('/escenario/'.$stageMain->id.'/edit') }}">Editar</a>
                                                        <form action="{{ url('/escenario/'.$stageMain->id) }} " method="post" style="display: inline-block">
                                                            @csrf
                                                            {{method_field('DELETE')}}
                                                            <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el sub escenario?')">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- script de la tabla de sub escenarios -->
                        <script>
                            $(document).ready(function() {
                                $('#stage_table').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: ['pageLength', 'excelHtml5', 'pdfHtml5'],
                                    language: {
                                        lengthMenu: 'Mostrando _MENU_ registros por página',
                                        zeroRecords: 'No hay registros para mostrar',
                                        info: 'Mostrando página _PAGE_ de _PAGES_',
                                        infoEmpty: 'No hay registros disponibles',
                                        infoFiltered: '(filtrando de _MAX_ registros disponibles)',
                                        sSearch: 'Buscar',
                                        'paginate': {
                                            'previous': '<i class="fas fa-light fa-arrow-left"></i>',
                                            'next': '<i class="fas fa-light fa-arrow-right"></i>'
                                        },
                                        buttons: {
                                            pageLength: 'Mostrando %d filas'
                                        },
                                    },
                                });
                            });
                        </script>
                    </div>
                    <!-- panel de la ubicación del subescenario -->
                    <div class="panel" id="four-panel">
                        <div class="panel-title">Ubicación del sub escenario</div>
                        <input hidden class="form-control" type="text" name="latitude" value="{{isset($stage->latitude_understg)?$stage->latitude_understg:''}}" id="lat">
                        <input hidden class="form-control" type="text" name="longitude" value="{{isset($stage->longitude_understg)?$stage->longitude_understg:''}}" id="lng">
                        <div id="map-default" class="map-canvas-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>
@endsection