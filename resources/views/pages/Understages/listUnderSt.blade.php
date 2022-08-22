@extends('layouts.app', ['class' => 'bg-default', $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-violet">{{ __('Ver sub escenarios administrador por el IDRD') }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-secondary shadow">
            <div class="card-body px-lg-3 py-lg-3">
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
                            <a type="button" class="btn btn-info" href="{{ route('showUnderSt', ['idUnderstage'=>$underStage->idUnderstage]) }}">Ver</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 0 0" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div> --}}
    </div>

    {{-- <div class="container mt--10 pb-5"></div> --}}
    
@endsection