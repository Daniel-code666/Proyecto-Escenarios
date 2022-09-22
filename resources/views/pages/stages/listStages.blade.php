@extends('layouts.app', ['class' => 'bg-default', $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')

<div class="header bg-gradient-primary p-8">
    <div class="container">
        <div class="header-body text-center mb--6 mt-1">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-violet">{{ __('Escenarios administrador por el IDRD') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card bg-secondary shadow">
        <div class="card-body px-lg-3 py-lg-3">
            <div class="table-responsive m-2">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Id</th>
                            <th scope="col" class="sort" data-sort="status">Foto</th>
                            <th scope="col" class="sort" data-sort="budget">Nombre</th>
                            <th scope="col" class="sort" data-sort="completion">Dirección</th>
                            <th scope="col" class="sort" data-sort="completion">Disciplina</th>
                            <th scope="col" class="sort" data-sort="completion">Calificación</th>
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
                            <td>{{$stage->score}}</td>
                            <td>
                                <a type="button" class="btn btn-info" href="{{ route('show', ['id'=>$stage->id]) }}">Detalle</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>

@endsection