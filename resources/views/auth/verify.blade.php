@extends('layouts.appVerify', ['class' => 'bg-default'])

@section('content')

    @include('layouts.headers.guestVerify')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>
                                <strong>
                                    {{ __('Verifique su cuenta a través del link enviado a su correo') }}
                                </strong>
                            </small>
                        </div>
                        <div>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Un nuevo link ha sido enviado a su correo.') }}
                                </div>
                            @endif
                            
                            {{ __('
                                Para que pueda iniciar sesión es necesario que verifique su cuenta a 
                                través del link enviado a su cuenta de correo.
                                ') 
                            }}
                            
                            @if (Route::has('verification.resend'))
                                {{ __('Si no recibió el link') }}, <a href="{{ route('verification.resend') }}">{{ __('haga click aquí para solicitar otro') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
