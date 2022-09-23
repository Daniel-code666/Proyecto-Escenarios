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

<h2 class="text-center fw-bold mt-2">Sub escenarios</h2>

<div class="warpper">
  <input class="radio" id="one" name="group" type="radio" checked>
  <input class="radio" id="two" name="group" type="radio">
  <div class="tabs">
    <label class="tab" id="one-tab" for="one">Sub escenarios</label>
    <label class="tab" id="two-tab" for="two">Escenarios principales</label>
  </div>
  <div class="panels">
    <!-- panel de sub escenarios -->
    <div class="panel" id="one-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Los sub escenarios son lugares que están dentro de los escenarios principales, pero que tengan
            condiciones diferentes a las del lugar principal. Para crear un sub escenario es necesario 
            tener al menos un escenario principal con las configuraciones pertinentes. Puede realizar las 
            operaciones de creación, actualización, vista y eliminación de los sub escenarios desde aquí.
          </p>
          <a type="button" class="btn btn-primary" href="{{ url('/understage/create') }}">Crear sub escenario</a>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/add-escenario.png" width="180" alt="...">
        </div>
      </div>

      <hr>

      @if($underStages->isEmpty())
      <div class="row offset-0">
        <h4><strong>Este escenario no tiene sub escenarios asociados</strong></h4>
      </div>
      @else
      <div class="card-body px-lg-3 py-lg-1">
        <div class="table-responsive m-2">
          <table id="stage_table" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Id</th>
                <th scope="col" class="sort" data-sort="status">Foto</th>
                <th scope="col" class="sort" data-sort="budget">Nombre</th>
                <th>Esc. principal</th>
                <th scope="col" class="sort" data-sort="completion">Dirección</th>
                <th scope="col" class="sort" data-sort="completion">Disciplina</th>
                <th>Estado</th>
                <th scope="col" class="sort" data-sort="completion">Acciones</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($underStages as $underStage)
              <tr>
                <td>{{$underStage->idUnderstage}}</td>
                <td><img src="{{asset('storage').'/'.$underStage->photo_understg}}" alt="" width="100"></td>
                <td>{{$underStage->name_understg}}</td>
                <td>{{$underStage->name}}</td>
                <td>{{$underStage->address_understg}}</td>
                <td>{{$underStage->discipline_name}}</td>
                <td>{{$underStage->statesName}}</td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="{{ route('showUnderSt', ['idUnderstage'=>$underStage->idUnderstage]) }}">Ver</a>
                      <a class="dropdown-item" href="{{ url('/understage/'.$underStage->idUnderstage.'/edit') }}">Editar</a>
                      <form action="{{ url('/understage/'.$underStage->idUnderstage) }} " method="post" style="display: inline-block">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el sub escenario?')">Eliminar</button>
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
      @endif
    </div>

    <!-- panel de escenarios principales-->
    <div class="panel" id="two-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Aquí puede ver los escenarios principales que ya han sido establecidos, si aun no hay ningún escenario
            puede ir establecerlos. Tenga en cuenta que editar o eliminar un escenario principal desde aquí 
            lo redigirá hacía la página de "Principales". 
          </p>
          <div>
            <a type="button" class="btn btn-primary" href="{{ url('/escenario') }}">Ir a escenarios principales</a>
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
              <th># sub esc.</th>
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
              <td>{{$stage->underStageQty}}</td>
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
  </div>
</div>
@include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush