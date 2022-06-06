<div style="text-align: left">
    <h5>Generado por: {{ auth()->user()->name }}</h5>
    <h5>Fecha: {{ date("d/m/Y") }}</h5>
</div>

<div style="text-align: center">
    <h1>Reporte del sub escenario {{$stage->name_understg}}</h1>
</div>

<div style="text-align: center">
    <h2><strong>Información del sub escenario</strong></h2>
</div>
<div style="text-align: left">
    <h4>Nombre del escenario</h4>
    <h3>{{ $stage->name_understg }}</h3>
    <h4>Dirección</h4>
    <h3>{{ $stage->address_understg }}</h3>
    <h4>Tamaño</h4>
    <h3>{{ $stage->area_understg }} m<sup>2</sup></h3>
    <h4>Capacidad</h4>
    <h3>{{ $stage->capacity_understg }} personas</h3>
    <h4>Descripción</h4>
    <h3>{{ $stage->description_understg }}</h3>
    <h4>Descripción del estado del escenario</h4>
    <h3>{{ $stage->message_state_understg }}</h3>
    <h4>Disciplina</h4>
    <h3>{{ $stage->discipline_name }}</h3>
    <h4>Descripción de la disciplina</h4>
    <h3>{{ $stage->discipline_description }}</h3>
</div>

<div style="text-align: center">
    <h2><strong>Información del escenario principal</strong></h2>
</div>
<div style="text-align: left">
    <h4>Nombre del escenario principal</h4>
    <h3>{{ $stage->name }}</h3>
    <h4>Dirección</h4>
    <h3>{{ $stage->address }}</h3>
    <h4>Tamaño</h4>
    <h3>{{ $stage->area }} m<sup>2</sup></h3>
    <h4>Capacidad</h4>
    <h3>{{ $stage->capacity }} personas</h3>
    <h4>Descripción</h4>
    <h3>{{ $stage->descripcion }}</h3>
    <h4>Descripción del estado del escenario principal</h4>
    <h3>{{ $stage->message_state }}</h3>
</div>