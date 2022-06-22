@extends('layouts.app')

@section('content')
    @include('layouts.headers.sharedmargin')

    <div class="container">

        <div class="card" style="width: 100%;">
            <div class="card-body">
              <h2 class="card-title">Ver estado</h2>
              <hr>
             
              <form  action="{{ url('/states/'.$stateescenary->id) }} "method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                @include('pages.misclist.form')          
               
              </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX9zwgikaWFB_WuedqDIj9zJyz2zLWdAc"
></script>

@endpush