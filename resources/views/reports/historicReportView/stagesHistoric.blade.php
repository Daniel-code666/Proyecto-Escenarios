@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

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

<div class="warpper">
    <div class="panels">
        <div class="row">
            <h3>Escenarios principales eliminados</h3>
        </div>
        <div class="row">
            @if(count($mainStagesDel) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="del_stages_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Nombre</th>
                            <th scope="col" class="sort">Area</th>
                            <th scope="col" class="sort">Capacidad</th>
                            <th>Dirección</th>
                            <th># de sub esc.</th>
                            <th scope="col" class="sort">Código</th>
                            <th scope="col" class="sort">Localidad</th>
                            <th scope="col" class="sort">Barrio</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($mainStagesDel as $stageDel)
                        <tr>
                            <td>{{$stageDel->name}}</td>
                            <td>{{$stageDel->area}}</td>
                            <td>{{$stageDel->capacity}}</td>
                            <td>{{$stageDel->address}}</td>
                            <td>{{$stageDel->underStageQty}}</td>
                            <td>{{$stageDel->stegeCode}}</td>
                            <td>{{$stageDel->localityName}}</td>
                            <td>{{$stageDel->hoodName}}</td>
                            <td>{{$stageDel->deleted_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#del_stages_table').DataTable({
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
        <hr>
        <div class="row">
            <h3>Escenarios principales editados</h3>
        </div>
        <div class="row">
            @if(count($mainStagesUpdt) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="updt_stages_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Nombre</th>
                            <th scope="col" class="sort">Area</th>
                            <th scope="col" class="sort">Capacidad</th>
                            <th>Dirección</th>
                            <th># de sub esc.</th>
                            <th scope="col" class="sort">Código</th>
                            <th scope="col" class="sort">Localidad</th>
                            <th scope="col" class="sort">Barrio</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($mainStagesUpdt as $stageUpdt)
                        <tr>
                            <td>{{$stageUpdt->name}}</td>
                            <td>{{$stageUpdt->area}}</td>
                            <td>{{$stageUpdt->capacity}}</td>
                            <td>{{$stageUpdt->address}}</td>
                            <td>{{$stageUpdt->underStageQty}}</td>
                            <td>{{$stageUpdt->stegeCode}}</td>
                            <td>{{$stageUpdt->localityName}}</td>
                            <td>{{$stageUpdt->hoodName}}</td>
                            <td>{{$stageUpdt->updt_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#updt_stages_table').DataTable({
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
        <hr>
        <div class="row">
            <h3>Sub escenarios eliminados</h3>
        </div>
        <div class="row">
            @if(count($subStagesDel) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="del_substages_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Nombre</th>
                            <th scope="col" class="sort">Area</th>
                            <th scope="col" class="sort">Capacidad</th>
                            <th>Dirección</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($subStagesDel as $subStagesDel)
                        <tr>
                            <td>{{$subStagesDel->name_understg}}</td>
                            <td>{{$subStagesDel->area_understg}}</td>
                            <td>{{$subStagesDel->capacity_understg}}</td>
                            <td>{{$subStagesDel->address_understg}}</td>
                            <td>{{$subStagesDel->deleted_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#del_substages_table').DataTable({
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
        <hr>
        <div class="row">
            <h3>Sub escenarios actualizados</h3>
        </div>
        <div class="row">
            @if(count($subStagesUpdt) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="updt_substages_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">Nombre</th>
                            <th scope="col" class="sort">Area</th>
                            <th scope="col" class="sort">Capacidad</th>
                            <th>Dirección</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($subStagesUpdt as $subStagesUpdt)
                        <tr>
                            <td>{{$subStagesUpdt->name_understg}}</td>
                            <td>{{$subStagesUpdt->area_understg}}</td>
                            <td>{{$subStagesUpdt->capacity_understg}}</td>
                            <td>{{$subStagesUpdt->address_understg}}</td>
                            <td>{{$subStagesUpdt->deleted_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#updt_substages_table').DataTable({
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
</div>

@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush