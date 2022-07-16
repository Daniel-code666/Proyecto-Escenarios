@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span class="alert-text">{{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<h2 class="text-center fw-bold mt-2">Parametrización estado de los Inventarios</h2>
<div class="row">
  <div class="col-md-4 ml-2">
    <a type="button" class="btn btn-primary" href="{{ url('/inventarystates/create') }}">Crear estado</a>
  </div>
</div>
<hr>
<div class="table-responsive m-2">
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col" class="sort" data-sort="id">Id</th>
        <th scope="col" class="sort" data-sort="name">Nombre</th>
        <th scope="col" class="sort" data-sort="description">Descripción</th>
      </tr>
    </thead>
    <tbody class="list">
      @foreach ($misclist as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->description}}</td>
        <td>
          <a type="button" class="btn btn-default" href="{{ url('/inventarystates/'.$item->id.'/edit') }}"><i class="fas fa-edit"></i></a>
          {{--<a type="button" class="btn btn-info" href="{{ url('/states/'.$item->id) }}"><i class="fas fa-eye"></i></a>--}}
          <form action="{{ url('/inventarystates/'.$item->id) }} " method="post" style="display: inline-block">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar el estado?')"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush