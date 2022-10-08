
@extends('layouts.app', ['title' => __('User Profile'), $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Mapa de escenarios administrados por el IDRD'),
        'description' => __(''),
        'class' => 'col-lg-12'
    ])   
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">

                    <div class="card-body">
                        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1xaqToYQBZnTfIQtKMkbK9II7UMobi9E&ehbc=2E312F" width="100%" height="500px"></iframe>
                        
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
