@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span class="alert-text">{{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h2 class="text-center fw-bold mt-2">Almacenes</h2>
<div class="row">
  <div class="col-md-4 ml-2">
    <a type="button" class="btn btn-primary" href="{{ url('/almacen/create') }}">Crear Almacén</a>
  </div>
</div>
<hr>

@if($warehouses->isEmpty())
  <div style="text-align: center;">
    <h4><strong>No hay almacenenes para mostrar</strong></h4>
  </div>
@else
  <div class="table-responsive m-2">
    <table class="table align-items-center table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col" class="sort" data-sort="warehouseId">Id</th>
          <th scope="col" class="sort" data-sort="warehouseName">Nombre</th>
          <th scope="col" class="sort" data-sort="warehouseDescription">Descripción</th>
          <th scope="col" class="sort" data-sort="warehouseLocation">Escenario donde se ubica</th>
        </tr>
      </thead>
      <tbody class="list">
        @foreach ($warehouses as $warehouse)
        <tr>
          <td>{{$warehouse->warehouseId}}</td>
          <td>{{$warehouse->warehouseName}}</td>
          <td>{{$warehouse->warehouseDescription}}</td>
          <td>{{$warehouse->name}}</td>
          <td>
            <a type="button" class="btn btn-default" href="{{ url('/almacen/'.$warehouse->warehouseId.'/edit') }}"><i class="fas fa-edit"></i></a>
            <form action="{{ url('/almacen/'.$warehouse->warehouseId) }} " method="post" style="display: inline-block">
              @csrf
              {{method_field('DELETE')}}
              <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar el almacén?')"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endif

@include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush