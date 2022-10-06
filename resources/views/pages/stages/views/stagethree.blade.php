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
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <img src="{{isset($stage->photo)?asset('storage').'/'.$stage->photo:''}}" alt="">           
                        </div>
                        <div class="col">
                            <p>
                                El escenario también conocido por las siglas UDS cuenta con un área de 24,3 hectáreas para la práctica de las diferentes disciplinas deportivas de los habitantes de la localidad de Engativá. El Complejo Deportivo que se encuentra ubicado sobre la Avenida 68 con Calle 63, al interior del Parque Metropolitano Simón Bolívar y aledaño al Jardín Botánico, comenzó su historia durante el periodo de gobierno distrital comprendido entre los años 1970 y 1974, y fue inaugurado en 1973, contando con instalaciones para la práctica de diversos deportes, tanto de salón como de campo.
                            </p>
                            <ul>
                                <li><b>TELÉFONO:</b> 2310762</li>
                                <li><b>HORARIOS DE ATENCIÓN:</b> 5:30 a.m.  a  10:00 p.m.</li>
                            </ul>
                        </div>
                    </div>
                    <br>                    
                    <hr>
                    <h2 class="h2 text-center">OFERTA DE SERVICIOS Y CONDICIONES DE USO</h2>
                    <br>
                    <h3 class="h3" style="font-size: 25px">Equipamento deportivo</h3>
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%">#</th>
                                <th style="width: 15%">Nombre</th>
                                <th style="width: 5%">Cantidad</th>
                                <th style="white-space: pre-wrap; width: 75%">Descripción</th>
                            </tr>
                        </thead>
                        <tbody >

                            @foreach ($subStages as $substage)
                                <tr style="align-items: center">
                                    <td class="text-center" style="width: 5%">{{ $loop->index + 1 }}</td>
                                    <td style="width: 15%">{{$substage->name_understg}}</td>
                                    <td style="width: 5%">{{$substage->understageqty}}</td>
                                    <td style="white-space: pre-wrap; width: 75%">{{$substage->description_understg}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p style="font-size: 15px">
                        <b>NOTA:</b> No se debe jugar mientras este lloviendo, con tormentas eléctricas, o cuando la cancha se encuentre demasiado húmeda para evitar accidentes.
                    </p>

                    <h3 class="h3" style="font-size: 20px">Equipamento recreativo</h3>

                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%">#</th>
                                <th style="width: 15%">Nombre</th>
                                <th style="width: 5%">Cantidad</th>
                                <th style="white-space: pre-wrap; width: 75%">Condiciones de uso</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="align-items: center">
                                <td class="text-center" style="width: 5%">1</td>
                                <td style="width: 15%">Gimnasio de discapacidad</td>
                                <td style="width: 5%">1</td>
                                <td style="white-space: pre-wrap; width: 75%"> Habilitado únicamente para personas con discapacidad, debe ser utilizado con ropa deportiva adecuada y cómoda para la práctica de la gimnasia recreativa y de mantenimiento. Su uso se realiza a través de un coordinador del área de recreación y deporte del IDRD.</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 class="h3" style="font-size: 20px">Servicios adicionales</h3>

                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 5%">#</th>
                                <th style="width: 15%">Nombre</th>
                                <th style="width: 5%">Cantidad</th>
                                <th style="white-space: pre-wrap; width: 75%">Condiciones de uso</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="align-items: center; white-space: pre-wrap">
                                <td class="text-center" style="width: 5%">1</td>
                                <td style="width: 15%">Módulos de cafetería</td>
                                <td style="width: 5%">6</td>
                                <td style="white-space: pre-wrap; width: 75%">En estos módulos se ofrece productos de frutería, preempacados, bebidas frías y calientes, comidas rápidas, dulcería, empanadas, sándwiches y dulcería.</td>
                            </tr>
                            <tr style="align-items: center">
                                <td class="text-center" style="width: 5%">2</td>
                                <td style="width: 15%">Baterías Sanitarias</td>
                                <td style="width: 5%">5</td>
                                <td style="white-space: pre-wrap; width: 75%">Se encuentran ubicados en cercanías a los módulos de cafetería.</td>
                            </tr>
                        </tbody>
                    </table>

                    <p style="font-size: 15px">
                        <b>NOTA:</b> El uso de parques es gratuito, salvo que se desarrollen actividades con ánimo directo o indirecto de lucro, y aquellas que requieran exclusividad de uso en un periodo de tiempo determinado. Consultar trámites y servicios.
                    </p>
                    <hr>
                    <h3 class="h3" style="font-size: 25px">Normas de convivencia para nuestros visitantes:</h3>
                    <ul>
                        <li>Hacer uso de las canecas de basura instaladas, no desperdiciar el agua, y darle buen uso a los baños.</li>
                        <li>Respetar la señalización del parque.</li>
                        <li>Está prohibido el ingreso de vendedores ambulantes, bebidas alcohólicas y armas.</li>
                        <li>No está permitido hacer fogatas.</li>
                        <li>Debe tener en cuenta los puntos de encuentro en caso de alguna emergencia (información suministrada a la entrada del parque o en la administración).</li>
                        <li>Colaborar con el uso adecuado del parque informando al servicio de vigilancia sobre cualquier irregularidad o anomalía que se presente.</li>
                        <li>Se permite el ingreso de mascotas a las zonas verdes, las cuales deben estar con collar todo el tiempo y bozal si se trata de razas de cuidado especial. </li>
                        <li>Prohibido el ingreso de las mascotas a los escenarios, coliseos y estadios deportivos. </li>
                        <li>Todos los usuarios deberán mantener un alto espíritu cívico, buen comportamiento, respeto a las normas de seguridad, preservación de los árboles, prados y todos los elementos que se encuentren en las instalaciones.</li>
                    </ul>

                    <h3 class="h3" style="font-size: 25px">Datos de interes:</h3>
                    <p>
                        La Unidad Deportiva el Salitre ha sido eje de importantes torneos y competencias deportivas locales, nacionales e internacionales; además de ser el epicentro de la promoción del Deporte Capitalino a través de las Ligas que operan en los escenarios de las diferentes disciplinas deportivas. Uno de los escenarios más importantes de la UDS es el Velódromo Luís Carlos Galán Sarmiento, el cual, fue adecuado en 1995 para el Mundial de Ciclismo
                    </p>
                    <p>
                        También cabe destacar el estadio de atletismo producto de la necesidad de los atletas bogotanos de contar con un escenario con las condiciones óptimas para el desarrollo de todas las disciplinas que hacen parte del Atletismo, se construyó en 1978 y fue remodelado y convertido en pista sintética de alto rendimiento en 1999 con motivo del Suramericano celebrado en el mismo año.
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
