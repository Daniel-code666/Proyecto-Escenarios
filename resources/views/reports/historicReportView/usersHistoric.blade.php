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
            <h3>Usuarios eliminados</h3>
        </div>
        <div class="row">
            @if(count($usersDel) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="del_users_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre obj</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Eliminado por</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($usersDel as $userDel)
                        <tr>
                            <td>{{$userDel->name}}</td>
                            <td>{{$userDel->email}}</td>
                            <td>{{$userDel->rol}}</td>
                            <td>{{$userDel->userEmail}}</td>
                            <td>{{$userDel->deleted_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#del_users_table').DataTable({
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
            <h3>Usuarios actualizados</h3>
        </div>
        <div class="row">
            @if(count($usersUpdt) == 0)
            <div style="text-align: center;">
                <h4><strong>No hay datos para mostrar</strong></h4>
            </div>
            @else
            <div class="table-responsive m-2">
                <table id="updt_users_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre obj</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Editado por</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($usersUpdt as $userUpdt)
                        <tr>
                            <td>{{$userUpdt->name}}</td>
                            <td>{{$userUpdt->email}}</td>
                            <td>{{$userUpdt->rol}}</td>
                            <td>{{$userUpdt->userEmail}}</td>
                            <td>{{$userUpdt->deleted_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function() {
                    $('#updt_users_table').DataTable({
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