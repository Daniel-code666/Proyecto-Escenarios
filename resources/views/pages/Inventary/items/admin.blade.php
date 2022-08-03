@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

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

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-text">{{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif

<h2 class="text-center fw-bold mt-2">Recursos</h2>

<div class="warpper">
    <input class="radio" id="one" name="group" type="radio" checked>
    <input class="radio" id="two" name="group" type="radio">
    <div class="tabs">
        <label class="tab" id="one-tab" for="one">Recursos</label>
        <label class="tab" id="two-tab" for="two">Almacenes</label>
    </div>
    <div class="panels">
        <!-- panel de recursos -->
        <div class="panel" id="one-panel">
            <div class="row">
                <div class="col-md-8">
                    <p>
                        Los recursos son los objetos físicos con los que cuenta cada escenario para la práctica
                        de las disciplinas o actividades llevadas a cabo en cada lugar. Para crear un recurso es 
                        necesario tener al menos un almacén establecido. Desde aquí puede realizar las operaciones 
                        de creación, actualización, vista y eliminación de los recursos.
                    </p>
                    <a type="button" class="btn btn-primary" href="{{ url('/item/create') }}">Crear recurso de inventario</a>
                </div>
                <div class="col-sm-4">
                    <img class="img-center" src="{{ asset('argon') }}/img/brand/inventarios.png" width="180" alt="...">
                </div>
            </div>
            <hr>
            @if($resources->isEmpty())
            <div style="text-align: center;">
                <h4><strong>No hay recursos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="inventory_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Id</th>
                            <th scope="col" class="sort">Imagen</th>
                            <th scope="col" class="sort">Nombre</th>
                            <th scope="col" class="sort">Cantidad</th>
                            <th scope="col" class="sort">Almacén</th>
                            <th scope="col" class="sort">Escenario</th>
                            <th scope="col" class="sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($resources as $resource)
                        <tr>
                            <td>{{$resource->idResource}}</td>
                            <td><img src="{{asset('storage').'/'.$resource->resourcePhoto}}" alt="" width="100"></td>
                            <td>{{$resource->resourceName}}</td>
                            <td>{{$resource->amount}}</td>
                            <td>{{$resource->warehouseName}}</td>
                            <td>{{$resource->name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ url('/item/'.$resource->idResource.'/edit') }}">Editar</a>
                                        <form action="{{ url('/item/'.$resource->idResource) }} " method="post" style="display: inline-block">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <a type="submit" class="dropdown-item" onclick="return confirm('¿Quieres eliminar el recurso?')">Eliminar</a>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
        <!-- panel de almacenes -->
        <div class="panel" id="two-panel">
            <div class="row">
                <div class="col-md-8">
                    <p>
                        Aquí puede revisar los almacenes ya establecidos, tenga en cuenta que realizar las operaciones
                        para editar o eliminar lo redirigirá a la página "Almacenes".
                    </p>
                    <a type="button" class="btn btn-primary" href="{{ url('/almacen') }}">Ver almacenes</a>
                </div>
                <div class="col-sm-4">
                    <img class="img-center" src="{{ asset('argon') }}/img/brand/warehouse.png" width="180" alt="...">
                </div>
            </div>
            <hr>
            @if($warehouses->isEmpty())
            <div style="text-align: center;">
                <h4><strong>No hay almacenenes para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="warehouse_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="warehouseId">Id</th>
                            <th scope="col" class="sort" data-sort="warehouseName">Nombre</th>
                            <th scope="col" class="sort" data-sort="warehouseDescription">Descripción</th>
                            <th scope="col" class="sort" data-sort="warehouseLocation">Escenario donde se ubica</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{$warehouse->warehouseId}}</td>
                            <td>{{$warehouse->warehouseName}}</td>
                            <td>{{$warehouse->warehouseDescription}}</td>
                            <td>{{$warehouse->name}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ url('/almacen/'.$warehouse->warehouseId.'/edit') }}">Editar</a>
                                        <form action="{{ url('/almacen/'.$warehouse->warehouseId) }} " method="post" style="display: inline-block">
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
    </div>
    <hr>
</div>
@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush