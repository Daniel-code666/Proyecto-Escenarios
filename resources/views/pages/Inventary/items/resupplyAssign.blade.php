@extends('layouts.app',[$menu = Session::get('menu') , $submenu = Session::get('submenu')])

@section('content')
@include('layouts.headers.sharedmargin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h2 class="card-title">Reabastecer recurso</h2>
            <hr>
            <form action="{{ url('/setresupply/'.$resource->idResource) }} " method="post">
                @csrf
                {{method_field('PUT')}}
                @include('pages.Inventary.items.resupplyForm')
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush