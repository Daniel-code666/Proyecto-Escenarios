@extends('layouts.app')

@section('content')
    @include('layouts.headers.sharedmargin')
    <h2 class="text-center fw-bold mt-2">Escenarios</h2>
    <div class="row">
        <div class="col-md-4 ml-2">
            <a type="button" class="btn btn-primary" href="{{ url('/escenario/create') }}">Crear escenario</a>
        </div>
    </div>
    <hr>
    <div class="table-responsive m-2">
      <table class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="sort" data-sort="name">Id</th>
            <th scope="col" class="sort" data-sort="status">Foto</th>
            <th scope="col" class="sort" data-sort="budget">Nombre</th>
            <th scope="col" class="sort" data-sort="completion">Dirección</th>
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
            <td>
              <a type="button" class="btn btn-default" href="{{ url('/escenario/'.$stage->id.'/edit') }}">Editar</a>
              <a type="button" class="btn btn-info" href="{{ url('/escenario/'.$stage->id) }}">Ver</a>
              <form action="{{ url('/escenario/'.$stage->id) }} "method="post" style="display: inline-block">
                @csrf
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar el escenario?')">Eliminar</button>
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