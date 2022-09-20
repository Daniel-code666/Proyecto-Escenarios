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
  <input class="radio" id="one" name="group" type="radio" checked>
  <input class="radio" id="two" name="group" type="radio">
  <div class="tabs">
    <label class="tab" id="one-tab" for="one">Escenarios</label>
    <label class="tab" id="two-tab" for="two">Configuraciones</label>
  </div>
  <div class="panels">
    <!-- panel de escenarios -->
    <div class="panel" id="one-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Para crear un escenario es necesario establecer por lo menos una disciplina y un estado. Si ya cuenta
            con ambas puede crear un escenario, de lo contrario podrá establecerlas en la pestaña de las
            configuraciones.
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
              <th>Estado</th>
              <th>Localidad</th>
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
              <td>{{$stage->statesName}}</td>
              <td>{{$stage->localityName}}</td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('genpdf', ['id'=>$stage->id]) }}">PDF</a>
                    <a class="dropdown-item" href="{{ route('viewStageInfo', ['id'=>$stage->id]) }}">Ver</a>
                    <a class="dropdown-item" href="{{ url('/escenario/'.$stage->id.'/edit') }}">Editar</a>
                    <form action="{{ url('/escenario/'.$stage->id) }} " method="post" style="display: inline-block">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el escenario?')">Eliminar</button>
                    </form>
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
    <!-- panel de las configuraciones -->
    <div class="panel" id="two-panel">
      <!-- fila de las disciplinas -->
      <div class="row">
        <div class="col-md-8">
          <p>
            Desde aquí puede ver las disciplinas que ya hayan sido establecidas o sino puede crear una. Tenga en cuenta
            que que al crear, editar o eliminar una disciplina desde aquí se le redirigirá a la página "Disciplinas".
          </p>
          <div>
            <a type="button" class="btn btn-primary" href="{{ url('/discipline/create') }}">Crear disciplina</a>
          </div>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/disciplines.png" width="180" alt="...">
        </div>
      </div>
      <hr>
      <!-- tabla de las disciplinas -->
      <div class="row table-responsive m-2">
        @if(count($disciplines) == 0)
        <div style="text-align: center;">
          <h4><strong>No hay disciplinas para mostrar</strong></h4>
        </div>
        @else
        <table id="discipline_table" class="table align-items-center">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Id</th>
              <th scope="col" class="sort" data-sort="budget">Nombre de la disciplina</th>
              <th scope="col" class="sort" data-sort="budget">Descripción de la disciplina</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($disciplines as $disc)
            @foreach ($disc as $discipline)
            <tr>
              <td>{{$discipline->disciplineId}}</td>
              <td>{{$discipline->discipline_name}}</td>
              <td class="scroll">
                {{$discipline->discipline_description}}
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ url('/discipline/'.$discipline->disciplineId.'/edit') }}">Editar</a>
                    <form action="{{ url('/discipline/'.$discipline->disciplineId) }} " method="post" style="display: inline-block">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar la disciplina?')">Eliminar</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            @endforeach
          </tbody>
        </table>
        <script>
          $(document).ready(function() {
            $('#discipline_table').DataTable({
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
      <!-- fila de los estados del escenario -->
      <div class="row">
        <div class="col-md-8">
          <p>
            Desde aquí puede ver las parametrizaciones para los estados que ya hayan sido establecidas o
            sino puede crear una. Tenga en cuenta que que al crear, editar o eliminar una parametrización
            desde aquí se le redirigirá a la página "Estado Escenarios".
          </p>
          <div>
            <a type="button" class="btn btn-primary" href="{{ url('/states/create') }}">Crear estado</a>
          </div>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/states.png" width="180" alt="...">
        </div>
      </div>
      <hr>
      <!-- tabla de los estados -->
      @if(count($misclist) == 0)
      <div style="text-align: center;">
        <h4><strong>No hay estados de escenarios para mostrar</strong></h4>
      </div>
      @else
      <table id="states_table" class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="sort" data-sort="id">Id</th>
            <th scope="col" class="sort" data-sort="name">Nombre</th>
            <th scope="col" class="sort" data-sort="description">Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="list">
          @foreach ($misclist as $i)
          @foreach ($i as $item)
          <tr>
            <td>{{$item->statesId}}</td>
            <td>{{$item->statesName}}</td>
            <td>{{$item->statesDescription}}</td>
            <td class="text-center">
              <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a class="dropdown-item" href="{{ url('/states/'.$item->statesId.'/edit') }}">Editar</a>
                  {{--<a type="button" class="btn btn-info" href="{{ url('/states/'.$item->statesId) }}"></a>--}}
                  <form action="{{ url('/states/'.$item->statesId) }} " method="post" style="display: inline-block">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el estado?')">Eliminar</button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
      </table>
      <script>
        $(document).ready(function() {
          $('#states_table').DataTable({
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
      <br>
    </div>
  </div>

</div>
@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush