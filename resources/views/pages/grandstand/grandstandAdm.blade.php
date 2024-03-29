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

<h2 class="text-center fw-bold mt-2">Administrar graderías</h2>

<div class="warpper">
  <div class="panels">
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <p>
          En esta sección puede parametrizar las graderías, esto con el fin de sectorizar con mayor precisión algunos de sus inventarios como es el caso de las sillas de los estadios.
        </p>
        <a type="button" class="btn btn-primary" href="{{ url('/grandstand/create') }}">Crear Gradería</a>
      </div>
      <div class="col-md-4 col-sm-12">
        <img class="img-center" src="{{ asset('argon') }}/img/brand/gradas.png" width="200" alt="..." style="border-radius: 10px">
      </div>
    </div>
    <hr>
    @if($grandstands->isEmpty())
    <div style="text-align: center;">
      <h4><strong>No hay graderías para mostrar</strong></h4>
    </div>
    @else
    <div class="table-responsive m-2">
      <table id="grandstand_table" class="table align-items-center">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="sort" data-sort="name">Id</th>
            <th scope="col" class="sort" data-sort="budget">Nombre de la gradería</th>
            <th scope="col" class="sort" data-sort="budget">Descripción de la gradería</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="list">
          @foreach ($grandstands as $grandstand)
          <tr>
            <td>{{$grandstand->grandstandid}}</td>
            <td>{{$grandstand->grandstandname}}</td>
            <td class="scroll">
              {{$grandstand->description}}
            </td>
            <td class="text-center">
              <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a class="dropdown-item" href="{{ url('/grandstand/'.$grandstand->grandstandid.'/edit') }}">Editar</a>
                  <form action="{{ url('/grandstand/'.$grandstand->grandstandid) }} " method="post" style="display: inline-block">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar la disciplina?')">Eliminar</button>
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
        $('#grandstand_table').DataTable({
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