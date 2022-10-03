@extends('layouts.app', ['title' => __('Escenario'), $menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
    @include('users.partials.header', [
        'title' => $stage->name,
        'description' => __(''),
        'class' => 'col-lg-12'
    ])   
    <br>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">

                <div class="card-body" >
                    <p class="fw-bolder" style="font-size: 30px; text-align: center; color:#5603ad">
                        ABIERTO PERMANENTEMENTE EN BENEFICIO DEL FÚTBOL BOGOTANO
                    </p>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="">           
                        </div>
                        <div class="col">
                            <p>
                                Se ubica al nororiente del Estadio El Campín y es utilizado en los torneos de Liga Femenina, los clubes de la Liga de Fútbol de Bogotá y en los torneos de carácter aficionado así como a diferentes actores del fútbol, local, nacional e internacional.
                            </p>
                            <p>
                                Tras su remodelación se mejoraron los camerinos, zonas duras, señalización, cerramientos y el edificio de administración por parte del IDRD.
                            </p>
                            <p> 
                                En el escenario trabajan diversas Escuelas de formación deportiva que participan en torneos, entrenamientos de equipos profesionales locales y extranjeros, selecciones Colombia y Liga de Fútbol de Bogotá.
                            </p> 
                        </div>
                    </div>
                    <br>

                    <p>
                        Algunos de los usuarios más ilustres de El Campincito han sido la selección Bogotá paralímpica que participó en los Juegos Paranacionales de Cúcuta 2012, selecciones a Juegos Nacionales, selecciones Colombia en diferentes categorías, clubes profesionales de la ciudad y equipos internacionales como Boca Juniors y Estudiantes de la Plata de Argentina, entre otros. Asimismo, el escenario fue sede de partidos profesionales de la Categoría Primera B con los clubes Academia Bogotana y El Cóndor. 
                    </p>
                    <p>
                        En 2011 fue una de las sedes de entrenamiento alternas para la Copa Mundial de Fútbol Sub-20 de 2011.
                    </p>
                    
                    <hr>

                    <h2 class="h2">Ubicación:</h2>
                    <br>
                    <div class="row">
                        
                        <div class="form-group" hidden>
                            <input class="form-control @error('latitude') is-invalid @enderror" type="text" name="latitude" value="{{isset($stage->latitude)?$stage->latitude:old('latitude')}}" id="lat" readonly="true">
                        </div>
                    
                        <div class="form-group" hidden>
                            <input class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{isset($stage->longitude)?$stage->longitude:old('longitude')}}" id="lng" readonly="true">
                        </div>
                        <div class="col-7">
                            <div id="map-default" class="map-canvas"></div>
                        </div>
                        <div class="col-5">
                            <div>
                                @foreach ($localities as $locality)
                                    @if ($locality->localityId == $stage->localityid)
                                    <label for=""><strong>Localidad: </strong>{{$locality->localityName}}</label>
                                    @endif
                                @endforeach  
                                
                            </div>
                            <div>
                                @foreach ($neighbordhoods as $neighbordhood)
                                    @if ($neighbordhood->hoodId == $stage->neighborhoodid)
                                    <label for=""><strong>Barrio: </strong>{{$neighbordhood->hoodName}}</label>
                                    @endif
                                @endforeach     
                            </div>
                            <div>
                                <label for=""><strong>Dirección: </strong>{{$stage->address}}</label>
                            </div>
                            <br>
                            @if(!Auth::guest())
                                <hr>
                                @if (Session::has('mensaje'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-text">{{Session::get('mensaje')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="aling-center">
                                    <h3>Calificar Escenario</h3>
                                    <form action="{{ url('/score/'.$stage->id )}}" class="score-form">
                                        @csrf
        
                                        @if (!Session::has('mensaje'))
                                            <p class="clasificacion">
                                                <input id="radio1" type="radio" name="score" value="5">
                                                <label for="radio1">★</label>
                                                <input id="radio2" type="radio" name="score" value="4">
                                                <label for="radio2">★</label>
                                                <input id="radio3" type="radio" name="score" value="3">
                                                <label for="radio3">★</label>
                                                <input id="radio4" type="radio" name="score" value="2">
                                                <label for="radio4">★</label>
                                                <input id="radio5" type="radio" name="score" value="1">
                                                <label for="radio5">★</label>
                                            </p>   
                                            <button type="submit" class="btn btn-success" value="Guardar">Enviar</button>
                                        @else 
                                            <p class="clasificacion">
                                                <input id="radio1" type="radio" name="score" value="5" disabled>
                                                <label for="radio1">★</label>
                                                <input id="radio2" type="radio" name="score" value="4" disabled>
                                                <label for="radio2">★</label>
                                                <input id="radio3" type="radio" name="score" value="3" disabled>
                                                <label for="radio3">★</label>
                                                <input id="radio4" type="radio" name="score" value="2" disabled>
                                                <label for="radio4">★</label>
                                                <input id="radio5" type="radio" name="score" value="1" disabled>
                                                <label for="radio5">★</label>
                                            </p>   
                                            <button type="submit" class="btn btn-success" value="Guardar" disabled>Enviar</button>
                                        @endif
                                            
                                    </form>   
                                </div>
        
                                @if ($stage->underStagesQty > 0) 
                                <hr style="margin-top: 20%">                     
                                    <div class="row justify-content-center ml--5">
                                        <div class="col-md-3">
                                            <a href="{{route('listUnderSt')}}" type="button" class="btn btn-primary">Sub escenarios</a>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if ($stage->underStagesQty > 0) 
                                    <hr style="margin-top: 60%">                     
                                    <div class="row justify-content-center ml--5">
                                        <div class="col-md-3">
                                            <a href="{{route('listUnderSt', ['id'=>$stage->id])}}" type="button" class="btn btn-primary">Sub escenarios</a>
                                        </div>
                                    </div>
                                @endif
                            @endif
        
                        </div>
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

<style>
    .score-form {
    width: 250px;
    margin: 0 auto;
    height: 50px;
    }

    .aling-center {
    text-align: center;
    }

    .score-form label {
    font-size: 20px;
    }

    input[type="radio"] {
    display: none;
    }

    form p label {
    color: grey;
    }

    .clasificacion {
    direction: rtl;
    unicode-bidi: bidi-override;
    }

    form p label:hover,
    form p label:hover ~ form p label {
    color: orange;
    }

    input[type="radio"]:checked ~ label {
    color: orange;
    }

    img{
        object-fit: cover;
        width:100%;
        height:100%;
    }

    </style>

    @push('js')
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"></script>
    @endpush
