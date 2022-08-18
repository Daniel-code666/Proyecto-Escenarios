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

<h2 class="text-center fw-bold mt-2">Administrar Usuarios</h2>

<div class="warpper">
    <div class="panels">
        <div class="row">
            <div class="col-md-8">
                <p>
                    Desde aquí puede administrar a los usuarios para conceder permisos a la plataforma.
                </p>
            </div>
            <div class="col-sm-4">
                <img class="img-center" src="{{ asset('argon') }}/img/brand/user.png" width="180" alt="...">
            </div>
        </div>
        <hr>
        @if($users == null)
        <div style="text-align: center;">
            <h4><strong>No hay usuarios para mostrar</strong></h4>
        </div>
        @else
        <div class="table-responsive m-2">
            <table id="users_table" class="table align-items-center">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        @if($user->photo == null)
                            <td>Sin foto</td>
                        @else
                            <td><img src="{{asset('storage').'/'.$user->photo}}" alt="" width="100"></td>
                        @endif
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#users_table').DataTable({
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

@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush