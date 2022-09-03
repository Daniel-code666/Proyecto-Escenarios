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

<h2 class="text-center fw-bold mt-2">Escenarios principales</h2>

<div class="warpper">
    <div class="panels">
        <div class="row">
            <div class="col-md-8">
                <p>
                    Desde aquí puede ver toda la información relacionada por cada escenario que haya creado.
                </p>
                <div>
                    <a type="button" class="btn btn-primary" href="{{ url('/escenario/create') }}">Crear escenario</a>
                </div>
            </div>
            <div class="col-sm-4">
                <img class="img-center" src="{{ asset('argon') }}/img/brand/add-escenario.png" width="180" alt="...">
            </div>
        </div>
        <hr>
        <div class="table-responsive m-2">
            @if($stages->isEmpty())
            <div style="text-align: center;">
                <h4><strong>No hay escenarios para mostrar</strong></h4>
            </div>
            @else
            <table id="escenarios_table" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Id</th>
                        <th scope="col" class="sort" data-sort="status">Foto</th>
                        <th scope="col" class="sort" data-sort="budget">Nombre</th>
                        <th scope="col" class="sort" data-sort="completion">Dirección</th>
                        <th scope="col" class="sort" data-sort="completion">Disciplina</th>
                        <th>Capacidad</th>
                        <th>Superficie</th>
                        <th scope="col" class="sort" data-sort="completion">Acciones</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($stages as $stage)
                    <tr>
                        <td>{{$stage->id}}</td>
                        <td><img src="{{asset('storage').'/'.$stage->photo}}" alt="" width="100"></td>
                        <td>{{$stage->name}}</td>
                        <td>{{$stage->address}}</td>
                        <td>{{$stage->discipline_name}}</td>
                        <td>{{$stage->capacity}}</td>
                        <td>{{$stage->area}}m<sup>2</sup></td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" target="_blank" href="{{ route('viewreport', ['id'=>$stage->id]) }}">
                                        Ver reporte
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- script de la tabla de escenarios -->
            <script>
                $(document).ready(function() {
                    $('#escenarios_table').DataTable({
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