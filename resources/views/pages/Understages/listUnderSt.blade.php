@extends('layouts.app', ['title' => __('Escenario'), $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('users.partials.header', [
        'title' => 'Sub escenarios del '.$stages->name,
        'description' => __(''),
        'class' => 'col-lg-12'
    ])   
    <br>
    <div class="container-fluid mt--7">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">

                <div class="card-body">

                  @if ($underStage->count() > 1)
                      hola
                  @else
                      feo
                  @endif
                  
                     {{--  <div class="warpper">
                         @foreach ($underStage as $unders)   
                          @if ($loop->first)
                            <input class="radio" id="war-{{$unders->name_understg}}" name="group" type="radio" checked>
                          @else
                            <input class="radio" id="war{{$unders->name_understg}}" name="group" type="radio">
                          @endif
                        @endforeach     

                        <div class="tabs">
                          @foreach ($underStage as $unders) 
                            <label class="tab" id="{{$unders->name_understg}}-tab" for="war-{{$unders->name_understg}}">{{$unders->name_understg}}</label>
                          @endforeach       
                      </div>  --}}



                        {{--                         <div class="panels" style="max-width:100%">
                          @foreach ($underStage as $unders)
                            <div class="panel" id="{{$unders->name_understg}}-panel">
                              {{$unders->name_understg}}
                            </div>
                          @endforeach
                        </div> --}}
{{-- 

                        <input class="radio" id="one" name="group" type="radio" checked>
                        <input class="radio" id="two" name="group" type="radio"> 
                        <div class="tabs">
                          <label class="tab" id="one-tab" for="one">Escenarios</label>
                          <label class="tab" id="two-tab" for="two">Configuraciones</label>
                        </div>

                        <div class="panels" style="max-width:100%">
                            <div class="panel" id="one-panel">
                              1
                            </div>
                            <div class="panel" id="two-panel">
                              2
                            </div>
                        </div> --}}

                      
                    </div>
                </div>
            </div>
        </div>
    
    @auth()
        @if(auth()->user()->role_idrole == 1 || auth()->user()->role_idrole == 2)
            @include('layouts.footers.auth')
        @endif
    @endauth
@endsection

    @push('js')
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>
    @endpush
