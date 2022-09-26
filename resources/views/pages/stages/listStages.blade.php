
@extends('layouts.app', ['title' => __('User Profile'), $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Escenarios'),
        'description' => __('Estos son los escenarios administrador por el IDRD en Bogotá'),
        'class' => 'col-lg-12'
    ])   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">

                    <div class="card-body">
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
        </div>
        
        @auth()
            @if(auth()->user()->role_idrole == 1 || auth()->user()->role_idrole == 2)
                @include('layouts.footers.auth')
            @endif
        @endauth
    </div>
@endsection





























