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
<h3>Competencia "  "</h3>
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
            <td>{{ ($competidor->estado == 0) ? 'Sin Verificar' : 'Verificado' }}</td>
            <td>
                @if ($competidor->estado == 0)
                <a href="{{ route('habilitar_competidor', ['id' => $competidor->idCompetenciaCompetidor ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Verificar</a>
                @endif
                <a class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
