<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competencias
@endsection

@section('encabezado')
Gestion de Competencias
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Competencias</h3>
<a href="{{ route('create_competencia') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Competencia</a>

<div class="table-responsive">
<table id="tabla_competencia" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Inscripciones</th>
            <th>Cantidad de Jueces</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competencias as $row)
        <tr>
            <td>{{ $row->idCompetencia }}</td>
            <td>{{ $row->nombre }}</td>
            <td>
            @php $fecha = date('d/m/Y', strtotime($row->fecha)) @endphp
            {{ $fecha }}
            </td>
            <td>{{ ($row->estadoJueces) ? 'Abiertas a Competidores' : 'Abiertas a Jueces'}}</td>
            <td>{{$row->competencia_juez_count}} de {{ $row->cantidadJueces }}</td>
            <td>
                <a href="{{ route('edit_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ver Competidores inscriptos</a>
                <a href="{{ route('tabla_jueces', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ver Jueces inscriptos</a>
                <a href="{{ route('verPresentacion', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ir a presentacion.</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection