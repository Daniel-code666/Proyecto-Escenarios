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

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="">           
                        </div>
                        <div class="col">
                            <p>
                                El emblemático escenario capitalino, tiene abiertas sus puertas a las personas y la comunidad en general, para que conozcan sus instalaciones, su historia, su museo y todas las anécdotas que encierra este majestuoso escenario deportivo.
                            </p>
                            <p>
                                Se trata de un recorrido guiado en el interior del Estadio, con un tiempo de duración máximo de una hora, por grupo.
                            </p>
                            <p> 
                                Los trayectos se programarán a través del correo estadioelcampin@idrd.gov.co, con apoyo de funcionarios del Distrito, quienes explicarán los pormenores del recinto deportivo, desde su construcción y mejoras hasta sus últimas adecuaciones. 
                            </p> 
                        </div>
                    </div>
                    <br>

                    <p>
                        Los recorridos varían en la semana de acuerdo a la programación deportiva y cultural del escenario y están dirigidos para toda la comunidad sin restricción de edad y lo mejor de todo, sin costo alguno. Las personas que ingresen al escenario deportivo deben acatar todas las medidas de bioseguridad establecidas por el Ministerio de Salud (distanciamiento físico y uso de tapabocas, entre otras, así como las indicaciones de los guías). 
                    </p>
                    <p>
                        Es importante tener en cuenta que si se encuentran niñas y niños menores de 10 años entre los grupos de visitantes, estos deben estar acompañados de un adulto por cada 10 niños.
                    </p>
                    <p>
                        En el Museo, los visitantes encontrarán artículos alusivos al mundo del fútbol, camisetas y una completa galería de fotos con énfasis en la era de El Dorado con formaciones antiguas de Santa Fe, Millonarios y grandes ídolos del balompié bogotano.
                    </p>

                    <h2 class="h2">Historia</h2>
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            <p>
                                Fue Jorge Eliécer Gaitán, alcalde de Bogotá en 1934, quien promovió la construcción del recinto deportivo en terrenos donados por la familia Camacho, una de las más prestantes de la capital en esa época. Con un aforo inicial para 23.500 espectadores, El Campín jalonó el desarrollo de la capital hacia el noroccidente de la sabana, en un sector que en el momento era de potreros, colindante con una línea del ferrocarril y vecino del hipódromo de Bogotá.
                            </p>
                            <p>
                                Pero el gran impulso del estadio capitalino se dio con el inicio del torneo profesional de fútbol en 1948 y el casi inmediato surgimiento de la época de El Dorado, cuando nuestras canchas se llenaron con estrellas internacionales de primer nivel, provenientes de Argentina, Uruguay, Perú, Costa Rica e incluso algunos países europeos como Inglaterra y Hungría.
                            </p>
                            <p>
                                Tan masivo fue el fenómeno que el escenario de la calle 57 debió ser rápidamente ampliado llegando a una capacidad de 45 mil espectadores, en el año de 1951.  Doce años después, se construyó una gradería adicional para subir el aforo a más de 60 mil fanáticos y a partir de 1967, quedó habilitado para Juegos nocturnos con la adecuación del sistema de iluminación artificial.
                            </p>
                        </div>
                        <div class="col">
                            <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="">           
                        </div>
                    </div>

                    <h2 class="h2">El legado</h2>
                    <p>
                        El Campín se convirtió además en unidad deportiva debido a la construcción de la cancha alterna de El Campincito y en 1973, el estreno del Coliseo cubierto el Campín, que hoy en día pasó a ser el sitio de espectáculos musicales Movistar Arena. Para recibir el Mundial Juvenil de 2011, fue remodelada completamente la tribuna occidental y actualizados sus servicios tecnológicos, en detrimento de su capacidad, la cual quedó reducida a 39 mil espectadores.
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
                            <div id="map-default" class="map-canvas" style="max-height: 360px"></div>
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
        
{{--                                 @if ($stage->underStagesQty > 0) 
                                <hr style="margin-top: 20%">                     
                                    <div class="row justify-content-center ml--5">
                                        <div class="col-md-3">
                                            <a href="{{route('listUnderSt')}}" type="button" class="btn btn-primary">Sub escenarios</a>
                                        </div>
                                    </div>
                                @endif --}}
                            @else
{{--                                 @if ($stage->underStagesQty > 0) 
                                    <hr style="margin-top: 60%">                     
                                    <div class="row justify-content-center ml--5">
                                        <div class="col-md-3">
                                            <a href="{{route('listUnderSt', ['id'=>$stage->id])}}" type="button" class="btn btn-primary">Sub escenarios</a>
                                        </div>
                                    </div>
                                @endif --}}
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
