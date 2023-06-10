<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competidores de la competencia
@endsection

@section('encabezado')
Gestion de Competidores de la competencia
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Estas viendo la <b>{{ $competencia->nombre }}</b></h3>
<a href="{{ route('asignar_poomsae_por_sorteo', ['id_competencia' => $competencia->idCompetencia]) }}" class="btn btn-outline-success">Sortear Poomsae</a>
<br/>
               
<table id="tabla_CompetenciaCompetidores" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>GAL</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Participa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competidoresCompetencia as $competidor)
        <tr>
            <td>{{ $competidor->competidor->gal }}</td>
            <td>{{ $competidor->competidor->nombre }}</td>
            <td>{{ $competidor->competidor->apellido }}</td>
            <td>{{ ($competidor->estado == 0) ? 'Sin Habilitar' : 'Habilitado' }}</td>
            <td>
                @if ($competidor->estado == 0)
                    <a href="{{ route('habilitar_competidor', ['id' => $competidor->idCompetenciaCompetidor ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Habilitar</a>
                @endif
                @if ($competidor->estado != 0)
                    <a href="{{ route('asignar_poomsae_competidor', ['id_competencia_competidor' => $competidor->idCompetenciaCompetidor ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Asignar Poomsae</a>
                    <a href="{{ route('ver_poomsae_competidor', ['idCompetenciaCompetidor' => $competidor->idCompetenciaCompetidor ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Ver Poomsaes Asignados</a>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
