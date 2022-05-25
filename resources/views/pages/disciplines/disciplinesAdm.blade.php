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

    <h2 class="text-center fw-bold mt-2">Administrar disciplinas</h2>
    
    <div class="row">
        <div class="col-md-4 ml-2">
            <a type="button" class="btn btn-primary" href="{{ url('/discipline/create') }}">Crear disciplina</a>
        </div>
    </div>
    <hr>
    <div class="table-responsive m-2">
        <table class="table align-items-center">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="name">Id</th>
              <th scope="col" class="sort" data-sort="budget">Nombre de la disciplina</th>
              <th scope="col" class="sort" data-sort="budget">Descripción de la disciplina</th>
            </tr>
          </thead>
          <tbody class="list">
            @foreach ($disciplines as $discipline)
            <tr>
              <td>{{$discipline->disciplineId}}</td>
              <td>{{$discipline->discipline_name}}</td>
              <td class="scroll">
                {{-- texto muy largo --}}
                {{$discipline->discipline_description}}

              </td>
              <td>
                <a type="button" class="btn btn-default" href="{{ url('/discipline/'.$discipline->disciplineId.'/edit') }}"><i class="fas fa-edit"></i></a>
                <form action="{{ url('/discipline/'.$discipline->disciplineId) }} "method="post" style="display: inline-block">
                  @csrf
                  {{method_field('DELETE')}}
                  <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar la disciplina?')"><i class="fas fa-trash"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @include('layouts.footers.auth')
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush