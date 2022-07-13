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

<h2 class="text-center fw-bold mt-2">Recursos</h2>
<div class="row">
    <div class="col-md-4 ml-2">
        <a type="button" class="btn btn-primary" href="{{ url('/item/create') }}">Crear recurso de inventario</a>
    </div>
</div>
<hr>

@if($resources->isEmpty())
<div style="text-align: center;">
    <h4><strong>No hay recursos para mostrar</strong></h4>
</div>
@else
<div class="table-responsive m-2">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="sort">Id</th>
                <th scope="col" class="sort">Imagen</th>
                <th scope="col" class="sort">Nombre</th>
                <th scope="col" class="sort">Cantidad</th>
                <th scope="col" class="sort">Almacén</th>
                <th scope="col" class="sort">Escenario</th> 
                <th scope="col" class="sort">Acciones</th>
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($resources as $resource)
            <tr>
                <td>{{$resource->idResource}}</td>
                <td><img src="{{asset('storage').'/'.$resource->resourcePhoto}}" alt="" width="100"></td>
                <td>{{$resource->resourceName}}</td>
                <td>{{$resource->amount}}</td>
                <td>{{$resource->warehouseName}}</td>
                <td>{{$resource->name}}</td>
                <td>
                    <a type="button" class="btn btn-default" href="{{ url('/item/'.$resource->idResource.'/edit') }}"><i class="fas fa-edit"></i></a>
                    <form action="{{ url('/item/'.$resource->idResource) }} " method="post" style="display: inline-block">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar ese recurso?')"><i class="fas fa-trash"></i></button>
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