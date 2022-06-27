@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

@if (Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-text">{{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif

<h2 class="text-center fw-bold mt-2">Sub escenarios</h2>
<div class="row">
    <div class="col-md-4 ml-2">
        <a type="button" class="btn btn-primary" href="{{ url('/understage/create') }}">Crear subescenario</a>
    </div>
</div>
<hr>

