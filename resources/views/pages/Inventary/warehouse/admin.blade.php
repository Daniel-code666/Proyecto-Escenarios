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

<h2 class="text-center fw-bold mt-2">Almacenes</h2>

<div class="warpper">
  <input class="radio" id="one" name="group" type="radio" checked>
  <input class="radio" id="two" name="group" type="radio">
  <input class="radio" id="three" name="group" type="radio">
  <div class="tabs">
    <label class="tab" id="one-tab" for="one">Almacenes en escenarios principales</label>
    <label class="tab" id="two-tab" for="two">Almacenes en sub escenarios</label>
    <label class="tab" id="three-tab" for="three">Escenarios</label>
  </div>
  <div class="panels">
    <!-- panel de almacenes en escenarios principales-->
    <div class="panel" id="one-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Los almacenes están para poder localizar los inventarios dentro de los escenarios, por lo tanto
            para crear un almacén es necesario tener al menos un escenario principal o un sub escenario
            con todas las configuraciones pertinentes. Desde de aquí puede crear, actualizar, ver o eliminar un almacén.
          </p>
          <a type="button" class="btn btn-primary" href="{{ url('/almacen/create') }}">Crear almacén</a>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/warehouse.png" width="180" alt="...">
        </div>
      </div>
      <hr>
      @if(count($warehouses) == 0)
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
            @foreach ($warehouses as $whSingle)
            @foreach ($whSingle as $warehouse)
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
                    <a class="dropdown-item" href="{{ url('viewresources/'.$warehouse->warehouseId) }}">Ver recursos</a>
                    <a class="dropdown-item" href="{{ url('/almacen/'.$warehouse->warehouseId.'/edit') }}">Editar</a>
                    <form action="{{ url('/almacen/'.$warehouse->warehouseId) }} " method="post" style="display: inline-block">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el almacén?')">Eliminar</button>
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
      <script>
        $(document).ready(function() {
          $('#warehouse_table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#warehouse_table thead');

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
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
              var api = this.api();

              // For each column
              api
                .columns()
                .eq(0)
                .each(function(colIdx) {
                  // Set the header cell to contain the input element
                  var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                  );
                  var title = $(cell).text();
                  $(cell).html('<input type="text" placeholder="' + title + '" />');

                  // On every keypress in this input
                  $(
                      'input',
                      $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                    .off('keyup change')
                    .on('change', function(e) {
                      // Get the search value
                      $(this).attr('title', $(this).val());
                      var regexr = '({search})'; //$(this).parents('th').find('select').val();

                      var cursorPosition = this.selectionStart;
                      // Search the column for that value
                      api
                        .column(colIdx)
                        .search(
                          this.value != '' ?
                          regexr.replace('{search}', '(((' + this.value + ')))') :
                          '',
                          this.value != '',
                          this.value == ''
                        )
                        .draw();
                    })
                    .on('keyup', function(e) {
                      e.stopPropagation();

                      $(this).trigger('change');
                      $(this)
                        .focus()[0]
                        .setSelectionRange(cursorPosition, cursorPosition);
                    });
                });
            },
          });
        });
      </script>
      @endif
    </div>
    <!-- panel de almacenes en sub escenarios -->
    <div class="panel" id="two-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Los almacenes están para poder localizar los inventarios dentro de los escenarios, por lo tanto
            para crear un almacén es necesario tener al menos un escenario principal o un sub escenario
            con todas las configuraciones pertinentes. Desde de aquí puede crear, actualizar, ver o eliminar un almacén.
          </p>
          <a type="button" class="btn btn-primary" href="{{ url('/almacen/create') }}">Crear almacén</a>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/warehouse.png" width="180" alt="...">
        </div>
      </div>
      <hr>
      @if(count($warehousesSub) == 0)
      <div style="text-align: center;">
        <h4><strong>No hay almacenenes para mostrar</strong></h4>
      </div>
      @else
      <div class="table-responsive m-2">
        <table id="warehouse_table_sub" class="table align-items-center table-flush">
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
            @foreach ($warehousesSub as $whSingle)
            @foreach ($whSingle as $warehouse)
            <tr>
              <td>{{$warehouse->warehouseId}}</td>
              <td>{{$warehouse->warehouseName}}</td>
              <td>{{$warehouse->warehouseDescription}}</td>
              <td>{{$warehouse->name_understg}}</td>
              <td class="text-center">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ url('viewresourcessub/'.$warehouse->warehouseId) }}">Ver recursos</a>
                    <a class="dropdown-item" href="{{ url('/almacen/'.$warehouse->warehouseId.'/edit') }}">Editar</a>
                    <form action="{{ url('/almacen/'.$warehouse->warehouseId) }} " method="post" style="display: inline-block">
                      @csrf
                      {{method_field('DELETE')}}
                      <button type="submit" class="dropdown-item btn-danger" onclick="return confirm('¿Quieres eliminar el almacén?')">Eliminar</button>
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
      <script>
        $(document).ready(function() {
          $('#warehouse_table_sub thead tr')
            .clone(true)
            .addClass('filters2')
            .appendTo('#warehouse_table_sub thead');

          $('#warehouse_table_sub').DataTable({
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
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
              var api = this.api();

              // For each column
              api
                .columns()
                .eq(0)
                .each(function(colIdx) {
                  // Set the header cell to contain the input element
                  var cell = $('.filters2 th').eq(
                    $(api.column(colIdx).header()).index()
                  );
                  var title = $(cell).text();
                  $(cell).html('<input type="text" placeholder="' + title + '" />');

                  // On every keypress in this input
                  $(
                      'input',
                      $('.filters2 th').eq($(api.column(colIdx).header()).index())
                    )
                    .off('keyup change')
                    .on('change', function(e) {
                      // Get the search value
                      $(this).attr('title', $(this).val());
                      var regexr = '({search})'; //$(this).parents('th').find('select').val();

                      var cursorPosition = this.selectionStart;
                      // Search the column for that value
                      api
                        .column(colIdx)
                        .search(
                          this.value != '' ?
                          regexr.replace('{search}', '(((' + this.value + ')))') :
                          '',
                          this.value != '',
                          this.value == ''
                        )
                        .draw();
                    })
                    .on('keyup', function(e) {
                      e.stopPropagation();

                      $(this).trigger('change');
                      $(this)
                        .focus()[0]
                        .setSelectionRange(cursorPosition, cursorPosition);
                    });
                });
            },
          });
        });
      </script>
      @endif
    </div>
    <!-- panel de escenarios principales-->
    <div class="panel" id="three-panel">
      <div class="row">
        <div class="col-md-8">
          <p>
            Aquí puede ver los escenarios principales que ya han sido establecidos, si aun no hay ningún escenario
            puede ir a establecerlos.
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
        @if(count($stages) == 0)
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
            @foreach ($stages as $st)
            @foreach ($st as $stage)
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
                    <a class="dropdown-item" href="{{ route('genpdf', ['id'=>$stage->id]) }}">PDF</a>
                    <a class="dropdown-item" href="{{ route('viewStageInfo', ['id'=>$stage->id]) }}">Ver</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
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
      <hr>
      <!-- fila de sub escenarios -->
      <div class="row">
        <div class="col-md-8">
          <p>
            Aquí puede ver los sub escenarios que ya han sido establecidos, si aun no hay ningún
            sub escenario puede ir a establecerlos.
          </p>
          <div>
            <a type="button" class="btn btn-primary" href="{{ url('/understage') }}">Ir a sub escenarios</a>
          </div>
        </div>
        <div class="col-sm-4">
          <img class="img-center" src="{{ asset('argon') }}/img/brand/add-escenario.png" width="180" alt="...">
        </div>
      </div>
      <hr>
      <div class="table-responsive m-2">
        @if(count($underStages) == 0)
        <div style="text-align: center;">
          <h4><strong>No hay escenarios para mostrar</strong></h4>
        </div>
        @else
        <table id="escenarios_table_sub" class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Id</th>
              <th scope="col" class="sort" data-sort="status">Foto</th>
              <th scope="col" class="sort" data-sort="budget">Nombre</th>
              <th scope="col" class="sort" data-sort="completion">Dirección</th>
              <th scope="col" class="sort" data-sort="completion">Disciplina</th>
              <th>Capacidad</th>
              <th>Escenario principal</th>
              <th scope="col" class="sort" data-sort="completion">Acciones</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($underStages as $st)
            @foreach ($st as $stage)
            <tr>
              <td>{{$stage->idUnderstage}}</td>
              <td><img src="{{asset('storage').'/'.$stage->photo_understg}}" alt="" width="100"></td>
              <td>{{$stage->name_understg}}</td>
              <td>{{$stage->address_understg}}</td>
              <td>{{$stage->discipline_name}}</td>
              <td>{{$stage->capacity_understg}}</td>
              <td>{{$stage->name}}</td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('genpdf', ['id'=>$stage->idUnderstage]) }}">PDF</a>
                    <a class="dropdown-item" href="{{ route('viewStageInfo', ['id'=>$stage->idUnderstage]) }}">Ver</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            @endforeach
          </tbody>
        </table>
        <!-- script de la tabla de escenarios -->
        <script>
          $(document).ready(function() {
            $('#escenarios_table_sub').DataTable({
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
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush