@extends('layouts/layout')

@section('titulo')
    Tabla de competidores
@endsection

@section('encabezado')
    Tabla de competidores
@endsection

@section('contenido')

<!-- despliega mensaje cuando se crea la cuenta -->
@include('layouts.partials.messages')
    
<div class="my-3">
        <table id="competidores_tabla"
            class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
            <thead class="flip-content">
                <tr>
                    <th data-priority="1"> GAL </th>
                    <th data-priority="1"> Apellido </th>
                    <th data-priority="1"> Nombre </th>
                    <th data-priority="1"> DU </th>
                    <th data-priority="3"> Fecha de Nacimiento </th>
                    <th data-priority="3"> Pais</th>
                    <th data-priority="3"> Ranking </th>
                    <th data-priority="3"> Graduacion</th>
                    <th data-priority="3"> Email </th>
                    <th data-priority="3"> Genero </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competidores as $competidor)
                <tr>
                    <td>{{ $competidor->gal }}</td>
                    <td>{{ $competidor->apellido }}</td>
                    <td>{{ $competidor->nombre }}</td>
                    <td>{{ $competidor->du }}</td>
                    <td>{{ $competidor->fechaNacimiento }}</td>
                    <td>
                        <img
                        src="https://flagcdn.com/{{ strtolower($competidor->pais->nomenclatura) }}.svg"
                        width="30"
                        alt="{{ $competidor->pais->nomenclatura }}"
                        >
                        {{ $competidor->pais->nombrePais }}</td>
                    <td>{{ $competidor->ranking }}</td>
                    <td>{{ $competidor->graduacion->nombre }}, {{ $competidor->graduacion->color }}</td>
                    <td>{{ $competidor->email }}</td>
                    <td>{{ $competidor->genero }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>


@endsection