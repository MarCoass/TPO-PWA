<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Jueces de la competencia
@endsection

@section('encabezado')
Gestion de Jueces de la competencia
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Estas viendo la <b>{{ $nombreCompetencia->nombre }}</b> <span class="badge bg-secondary">{{ count($juecesAceptados) .' de ' . $nombreCompetencia->cantidadJueces }}</span></h3>
<table id="tabla_CompetenciaCompetidores" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($CompetenciaJuez as $row)
        <tr>
            <td>{{ $row->juez->id }}</td>
            <td>{{ $row->juez->nombre }}</td>
            <td>{{ $row->juez->apellido }}</td>
            <td>{{ ($row->estado == 0) ? 'Sin Habilitar' : 'Habilitado' }}</td>
            <td>
                @if ($row->estado == 0) 
                    <a href="{{ route('habilitar_juez', ['id' => $row->idCompetenciaJuez ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Habilitar</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
