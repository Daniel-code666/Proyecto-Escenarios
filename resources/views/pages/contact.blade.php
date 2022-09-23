
@extends('layouts.app', ['title' => __('User Profile'), $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hola') . ' '. auth()->user()->name,
        'description' => __('Puedes enviarnos tus peticiones quejas o reclamos desde aquí'),
        'class' => 'col-lg-12'
    ])   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="text-center">
                            <h3 class="h2">{{ __('Contactenos') }}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <form target="_blank" action="https://formsubmit.co/danielmora_99@hotmail.com" method="POST" class="main_form">
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col">
                                  <input type="text" name="name" class="form-control" placeholder="Nombre Completo" required>
                                </div>
                                <div class="col">
                                  <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <textarea placeholder="Mensaje..." class="form-control" name="Mensaje" rows="8" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Enviar</button>
                          </form>
                        
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
