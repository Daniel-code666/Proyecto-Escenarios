@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">

    @if (Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-text">{{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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
                    <form action="{{ url('/user/'.$user->id.'/edit',$user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}
                        @foreach ($menu as $itemMenu)

                            <div class="card m-2" style="width: 30%; border-width: 2px; display: inline-block; margin: 0px">
                                <div class="card-body">
                                    <h3 class="card-title" style="font-size: 20px;">{{$itemMenu->name}}</h3>
                                    <hr style="margin: 10px;">
                                    @foreach ($submenu as $itemSubMenu)
                                        @if($itemSubMenu->menuid == $itemMenu->menuid)
                                            @if($itemSubMenu->can)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{$itemSubMenu->submenuid}}" id="flexCheckChecked" name="forms[]" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">{{$itemSubMenu->name}}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{$itemSubMenu->submenuid}}" name="forms[]" id="flexCheckChecked">
                                                    <label class="form-check-label" for="flexCheckChecked">{{$itemSubMenu->name}}</label>
                                                </div>
                                            @endif                           
                                        @endif   
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="row justify-content-md-center" style="margin-top: 10px">
                            <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
                        </div>
            
                    </form>
=======
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

                            <div class="row justify-content-md-center" style="margin-top: 10px">
                                <button type="submit" class="btn btn-success" value="Guardar">Guardar</button>
                            </div>
                        </form>
>>>>>>> 9666e0a3b856e95dd124decd1a6bdaafa12d50e7
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