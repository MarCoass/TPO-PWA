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
<table id="tabla_competencia" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competencias as $row)
        <tr>
            <td>{{ $row->idCompetencia }}</td>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->fecha }}</td>
            <td>
                <a href="{{ route('edit_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('inscribir_competidor', ['id_competidor' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Inscribir Competidor</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ver inscriptos</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection