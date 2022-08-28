@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">

    <div class="warpper">
        <input class="radio" id="one" name="group" type="radio" checked>
        <input class="radio" id="two" name="group" type="radio">
        <div class="tabs">
          <label class="tab" id="one-tab" for="one">Usuario</label>
          <label class="tab" id="two-tab" for="two">Permisos</label>
        </div>
        <div class="panels">
            <!-- panel de Usuarios -->
            <div class="panel" id="one-panel">
              @include('users.dataUser')
            </div>

            <!-- panel de permisos -->
            <div class="panel" id="two-panel">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                    <h2 class="card-title">Formularios</h2>
                    <hr>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}

                        @foreach ($menu as $itemMenu)
                            <div class="card m-2" style="width: 30%; border-width: 2px; display: inline-block; margin: 0px">
                                <div class="card-body">
                                    <h3 class="card-title" style="font-size: 20px; ">{{$itemMenu->name}}</h3>
                                    <hr style="margin: 10px;">
                                    @foreach ($submenu as $itemSubMenu)
                                        @if($itemSubMenu->menuId == $itemMenu->menuId)
                                            @if($itemSubMenu->can)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="{{$itemSubMenu->name}}" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">{{$itemSubMenu->name}}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" name="{{$itemSubMenu->name}}" id="flexCheckChecked">
                                                    <label class="form-check-label" for="flexCheckChecked">{{$itemSubMenu->name}}</label>
                                                </div>
                                            @endif                           
                                        @endif   
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

{{--                         @for ($i = 1; $i <=5; $i++)
                            <div class="card m-2" style="width: 30%; border-width: 2px; display: inline-block; margin: 0px">
                                <div class="card-body">
                                    <h3 class="card-title" style="font-size: 20px; ">Escenarios</h3>
                                    <hr style="margin: 10px;">
                                    @for ($j = 1; $j <=3; $j++)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label" for="flexCheckChecked">Principales</label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endfor
 --}}
                        

            
                       {{--  <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nombre del estado</label>
                                    <input class="form-control @error('statesName') is-invalid @enderror" type="text" name="statesName" value="">
                                    @error('statesName') 
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Descripción del estado</label>
                                    <textarea class="form-control @error('statesDescription') is-invalid @enderror" id="description" rows="2" name="statesDescription"></textarea>
                                    @error('statesDescription') 
                                    <div class="invalid-feedback">
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                        
                        <div class="row justify-content-md-center" style="margin-top: 10px">
                            <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
                        </div>
            
                    </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>

@endpush