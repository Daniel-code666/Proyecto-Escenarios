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

    <h2 class="text-center fw-bold mt-2">Sub escenarios</h2>
    <div class="row">
        <div class="col-md-4 ml-2">
            <a type="button" class="btn btn-primary" href="{{ url('/understage/create') }}">Crear subescenario</a>
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
              <th scope="col" class="sort" data-sort="budget">Escenario principal</th>
              <th scope="col" class="sort" data-sort="completion">Dirección</th>
              <th scope="col" class="sort" data-sort="completion">Disciplina</th>
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
              <td>
                <a type="button" style="background:#542c86" class="btn btn-default" href="{{ route('genunderstpdf', ['idUnderstage'=>$underStage->idUnderstage]) }}"><i class="fas fa-file-export"></i></a>
                <a type="button" class="btn btn-default" href="{{ url('/understage/'.$underStage->idUnderstage.'/edit') }}"><i class="fas fa-edit"></i></a>
                <a type="button" class="btn btn-info" href="{{ url('/understage/'.$underStage->idUnderstage) }}"><i class="fas fa-eye"></i></a>
                <form action="{{ url('/understage/'.$underStage->idUnderstage) }} "method="post" style="display: inline-block">
                  @csrf
                  {{method_field('DELETE')}}
                  <button type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres eliminar el escenario?')"><i class="fas fa-trash"></i></button>
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