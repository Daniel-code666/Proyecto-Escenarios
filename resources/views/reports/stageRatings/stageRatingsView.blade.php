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

<h2 class="text-center fw-bold mt-2">Calificaciones</h2>

<div class="warpper">
    <div class="panels">
        <table id="stageratings">
            <thead class="thead-light">
                <tr>
                    <th>Escenario</th>
                    <th>Fecha de promedio</th>
                    <th>Calificación anterior</th>
                    <th>Calificacion</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach ($stagesWhRatings as $stageWhRatings)

                <tr>
                    <td>{{$stageWhRatings['0']}}</td>
                    <td>{{$stageWhRatings['1']}}</td>
                    <td>{{$stageWhRatings['2']}}</td>
                    <td>{{$stageWhRatings['3']}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <hr>
        <div style="text-align:right">
            <a  type="button" class="btn btn-primary" href="{{ url('setratings') }}">Establecer calificaciones</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#stageratings').DataTable({
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

@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush