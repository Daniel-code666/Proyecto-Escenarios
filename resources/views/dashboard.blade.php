@extends('layouts.app', [$menu, $submenu])

@section('content')

    @include('layouts.headers.sharedmargin')
    <div class="container m-2">
        <br>
        <div class="fondo carousel" data-ride="carousel">
            <div class="card fondo carousel-inner">
                <div class="card-body carousel-item active">
                    <h5 class="text-center card-title h2" style="color: antiquewhite">Escenarios</h5>
                    <div class="row">
                        <div class="col-7">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia ut vitae, necessitatibus quos corporis totam, ipsam optio voluptatum impedit, quod expedita quaerat incidunt error. Modi deserunt pariatur debitis voluptas assumenda?</p>
                        </div>
                        <div class="col-5 mt--6">
                            <a href="#"><img src="{{ asset('argon') }}/img/theme/estadio.jpg" style="max-height: 200px" class="rounded-circle" ></a>
                        </div>
                    </div>
                </div>
                <div class="card-body carousel-item">
                    <h5 class="text-center card-title h2" style="color: antiquewhite">Escenarios</h5>
                    <div class="row">
                        <div class="col-7">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia ut vitae, necessitatibus quos corporis totam, ipsam optio voluptatum impedit, quod expedita quaerat incidunt error. Modi deserunt pariatur debitis voluptas assumenda?</p>
                        </div>
                        <div class="col-5 mt--6">
                            <a href="#"><img src="{{ asset('argon') }}/img/theme/profile-cover.jpg" style="max-height: 200px" class="rounded-circle" ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-7">
                @if (Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <span class="alert-text">{{Session::get('mensaje')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
              <div class="card">
                <div class="card-body">
                    <div class="fondo">
                        <h5 class="text-center card-title h3" style="color: aliceblue; height:30px">Configuraciones iniciales</h5>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="card-text">Antes de manipular el sistema es necesario definir algunas parametrizaciones, para ello dirigirse al menu lateral izquierdo en la sección de configuraciones.</p>
                        </div>
                    </div>
                        <hr>

                        <div class="row">
                            <div class="col-9">
                                <p>En caso de no tener parametrizaciones específicas pondrás optar por dejar las parametrizaciones por defecto.</p>
                            </div>
                            <div class="col-3">
                                <a href="{{route('save_misclist')}}" class="btn btn-primary">Click aquí</a>
                            </div>
                        </div>
                    
                  

                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="card">
                <div class="card-body">
                    <div class="fondo">
                        <h5 class="text-center card-title h3" style="color: aliceblue; height:30px">Reportes</h5>
                    </div>
                  <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur vero enim corrupti ipsam cum quod delectus dolor sint sunt, nam eos, veritatis ab harum aliquid ea animi sapiente autem dolorum.</p>
                  <a href="#" class="btn btn-primary">Click aquí</a>
                </div>
              </div>
            </div>
          </div>

    </div>
    @include('layouts.footers.auth')

    <style>
        .fondo{
            background-color: #000000;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpolygon fill='%2311091b' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23221236' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23321a50' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%2343236b' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%23542C86' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
            color: antiquewhite;
            }
        </style>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>