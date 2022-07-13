@extends('layouts.app')

@section('content')
@include('layouts.headers.sharedmargin')

<div class="container">

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h2 class="card-title">Editar recurso</h2>
            <hr>
            <form action="{{ url('/item/'.$resource->idResource) }} " method="post">
                @csrf
                {{method_field('PUT')}}
                @include('pages.Inventary.items.form')
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush