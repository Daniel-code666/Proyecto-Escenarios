<div style="text-align: left">
    <h5>Generado por: {{ auth()->user()->name }}</h5>
    <h5>Fecha: {{ date("d/m/Y") }}</h5>
</div>

<div style="text-align: center">
    <h1>Reporte del escenario {{$stage->name}}</h1>
</div>

<div style="text-align: left">
    <h4>Nombre del escenario</h4>
    <h3>{{ $stage->name }}</h3>
    <h4>Dirección</h4>
    <h3>{{ $stage->address }}</h3>
    <h4>Tamaño</h4>
    <h3>{{ $stage->area }} m<sup>2</sup></h3>
    <h4>Capacidad</h4>
    <h3>{{ $stage->capacity }} personas</h3>
    <h4>Descripción del escenario</h4>
    <h3>{{ $stage->descripcion }}</h3>
    <h4>Descripción del estado del escenario</h4>
    <h3>{{ $stage->message_state }}</h3>
    <h4>Disciplina</h4>
    <h3>{{ $stage->discipline_name }}</h3>
    <h4>Descripción de la disciplina</h4>
    <h3>{{ $stage->discipline_description }}</h3>

    @if($understages->isEmpty())
        <h4><strong>Este escenario no tiene sub escenarios asociados</strong></h4>
    @else
        <h4>Sub escenarios asociados </h4>
        <div style="text-align: center">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="name">Id</th>
                        <th scope="col" class="sort" data-sort="status">Foto</th>
                        <th scope="col" class="sort" data-sort="budget">Nombre</th>
                        <th scope="col" class="sort" data-sort="completion">Dirección</th>
                        <th scope="col" class="sort" data-sort="completion">Disciplina</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($understages as $understage)
                    <tr>
                    <td>{{$understage->idUnderstage}}</td>
                    <td><img src="{{asset('storage').'/'.$understage->photo_understg}}" alt="" width="100"></td>
                    <td>{{$understage->name_understg}}</td>
                    <td>{{$understage->address_understg}}</td>
                    <td>{{$understage->discipline_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>